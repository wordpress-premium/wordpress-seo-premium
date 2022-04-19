<?php

/**
 * Class QRImage
 *
 * @filesource   QRImage.php
 * @created      05.12.2015
 * @package      chillerlan\QRCode\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode\Output;

use YoastSEO_Vendor\chillerlan\QRCode\QRCode;
use YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix;
/**
 * Converts the matrix into images, raw or base64 output
 */
class QRImage extends \YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputAbstract
{
    const transparencyTypes = [\YoastSEO_Vendor\chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG, \YoastSEO_Vendor\chillerlan\QRCode\QRCode::OUTPUT_IMAGE_GIF];
    protected $moduleValues = [
        // light
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DATA => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FINDER => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_SEPARATOR => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TIMING => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FORMAT => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_VERSION => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_QUIETZONE => [255, 255, 255],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TEST => [255, 255, 255],
        // dark
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DARKMODULE << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DATA << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FINDER << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TIMING << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FORMAT << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_VERSION << 8 => [0, 0, 0],
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TEST << 8 => [0, 0, 0],
    ];
    /**
     * @see imagecreatetruecolor()
     * @var resource
     */
    protected $image;
    /**
     * @var int
     */
    protected $scale;
    /**
     * @var int
     */
    protected $length;
    /**
     * @see imagecolorallocate()
     * @var int
     */
    protected $background;
    /**
     * @return string
     * @throws \chillerlan\QRCode\Output\QRCodeOutputException
     */
    public function dump()
    {
        if ($this->options->cachefile !== null && !\is_writable(\dirname($this->options->cachefile))) {
            throw new \YoastSEO_Vendor\chillerlan\QRCode\Output\QRCodeOutputException('Could not write data to cache file: ' . $this->options->cachefile);
        }
        $this->setImage();
        $moduleValues = \is_array($this->options->moduleValues[\YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DATA]) ? $this->options->moduleValues : $this->moduleValues;
        foreach ($this->matrix->matrix() as $y => $row) {
            foreach ($row as $x => $pixel) {
                $this->setPixel($x, $y, \imagecolorallocate($this->image, ...$moduleValues[$pixel]));
            }
        }
        $imageData = $this->dumpImage();
        if ((bool) $this->options->imageBase64) {
            $imageData = 'data:image/' . $this->options->outputType . ';base64,' . \base64_encode($imageData);
        }
        return $imageData;
    }
    /**
     * @return void
     */
    protected function setImage()
    {
        $this->scale = $this->options->scale;
        $this->length = $this->moduleCount * $this->scale;
        $this->image = \imagecreatetruecolor($this->length, $this->length);
        $this->background = \imagecolorallocate($this->image, ...$this->options->imageTransparencyBG);
        if ((bool) $this->options->imageTransparent && \in_array($this->options->outputType, $this::transparencyTypes, \true)) {
            \imagecolortransparent($this->image, $this->background);
        }
        \imagefilledrectangle($this->image, 0, 0, $this->length, $this->length, $this->background);
    }
    /**
     * @param $x
     * @param $y
     * @param $color
     * @return void
     */
    protected function setPixel($x, $y, $color)
    {
        \imagefilledrectangle($this->image, $x * $this->scale, $y * $this->scale, ($x + 1) * $this->scale - 1, ($y + 1) * $this->scale - 1, $color);
    }
    /**
     * @return string
     * @throws \chillerlan\QRCode\Output\QRCodeOutputException
     */
    protected function dumpImage()
    {
        \ob_start();
        try {
            \call_user_func([$this, $this->options->outputType !== null ? $this->options->outputType : \YoastSEO_Vendor\chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG]);
        } catch (\Exception $e) {
            throw new \YoastSEO_Vendor\chillerlan\QRCode\Output\QRCodeOutputException($e->getMessage());
        }
        // @codeCoverageIgnoreEnd
        $imageData = \ob_get_contents();
        \imagedestroy($this->image);
        \ob_end_clean();
        return $imageData;
    }
    /**
     * @return void
     */
    protected function png()
    {
        \imagepng($this->image, $this->options->cachefile, \in_array($this->options->pngCompression, \range(-1, 9), \true) ? $this->options->pngCompression : -1);
    }
    /**
     * Jiff - like... JitHub!
     * @return void
     */
    protected function gif()
    {
        \imagegif($this->image, $this->options->cachefile);
    }
    /**
     * @return void
     */
    protected function jpg()
    {
        \imagejpeg($this->image, $this->options->cachefile, \in_array($this->options->jpegQuality, \range(0, 100), \true) ? $this->options->jpegQuality : 85);
    }
}
