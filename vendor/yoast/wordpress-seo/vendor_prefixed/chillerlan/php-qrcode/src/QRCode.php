<?php

/**
 * Class QRCode
 *
 * @filesource   QRCode.php
 * @created      26.11.2015
 * @package      chillerlan\QRCode
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode;

use YoastSEO_Vendor\chillerlan\QRCode\Data\AlphaNum;
use YoastSEO_Vendor\chillerlan\QRCode\Data\Byte;
use YoastSEO_Vendor\chillerlan\QRCode\Data\Kanji;
use YoastSEO_Vendor\chillerlan\QRCode\Data\MaskPatternTester;
use YoastSEO_Vendor\chillerlan\QRCode\Data\Number;
use YoastSEO_Vendor\chillerlan\QRCode\Data\QRCodeDataException;
use YoastSEO_Vendor\chillerlan\QRCode\Data\QRDataInterface;
use YoastSEO_Vendor\chillerlan\QRCode\Output\QRCodeOutputException;
use YoastSEO_Vendor\chillerlan\QRCode\Output\QRImage;
use YoastSEO_Vendor\chillerlan\QRCode\Output\QRMarkup;
use YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputInterface;
use YoastSEO_Vendor\chillerlan\QRCode\Output\QRString;
use YoastSEO_Vendor\chillerlan\QRCode\Traits\ClassLoader;
/**
 * Turns a text string into a Model 2 QR Code
 *
 * @link https://github.com/kazuhikoarase/qrcode-generator/tree/master/php
 * @link http://www.qrcode.com/en/codes/model12.html
 * @link http://www.thonky.com/qr-code-tutorial/
 */
class QRCode
{
    use ClassLoader;
    /**
     * API constants
     */
    const OUTPUT_MARKUP_HTML = 'html';
    const OUTPUT_MARKUP_SVG = 'svg';
    #	const OUTPUT_MARKUP_XML   = 'xml'; // anyone?
    const OUTPUT_IMAGE_PNG = 'png';
    const OUTPUT_IMAGE_JPG = 'jpg';
    const OUTPUT_IMAGE_GIF = 'gif';
    const OUTPUT_STRING_JSON = 'json';
    const OUTPUT_STRING_TEXT = 'text';
    const OUTPUT_CUSTOM = 'custom';
    const VERSION_AUTO = -1;
    const MASK_PATTERN_AUTO = -1;
    const ECC_L = 0b1;
    // 7%.
    const ECC_M = 0b0;
    // 15%.
    const ECC_Q = 0b11;
    // 25%.
    const ECC_H = 0b10;
    // 30%.
    const DATA_NUMBER = 0b1;
    const DATA_ALPHANUM = 0b10;
    const DATA_BYTE = 0b100;
    const DATA_KANJI = 0b1000;
    const ECC_MODES = [self::ECC_L => 0, self::ECC_M => 1, self::ECC_Q => 2, self::ECC_H => 3];
    const DATA_MODES = [self::DATA_NUMBER => 0, self::DATA_ALPHANUM => 1, self::DATA_BYTE => 2, self::DATA_KANJI => 3];
    const OUTPUT_MODES = [\YoastSEO_Vendor\chillerlan\QRCode\Output\QRMarkup::class => [self::OUTPUT_MARKUP_SVG, self::OUTPUT_MARKUP_HTML], \YoastSEO_Vendor\chillerlan\QRCode\Output\QRImage::class => [self::OUTPUT_IMAGE_PNG, self::OUTPUT_IMAGE_GIF, self::OUTPUT_IMAGE_JPG], \YoastSEO_Vendor\chillerlan\QRCode\Output\QRString::class => [self::OUTPUT_STRING_JSON, self::OUTPUT_STRING_TEXT]];
    /**
     * @var \chillerlan\QRCode\QROptions
     */
    protected $options;
    /**
     * @var \chillerlan\QRCode\Data\QRDataInterface
     */
    protected $dataInterface;
    /**
     * QRCode constructor.
     *
     * @param \chillerlan\QRCode\QROptions|null $options
     */
    public function __construct(\YoastSEO_Vendor\chillerlan\QRCode\QROptions $options = null)
    {
        \mb_internal_encoding('UTF-8');
        $this->setOptions($options instanceof \YoastSEO_Vendor\chillerlan\QRCode\QROptions ? $options : new \YoastSEO_Vendor\chillerlan\QRCode\QROptions());
    }
    /**
     * Sets the options, called internally by the constructor
     *
     * @param \chillerlan\QRCode\QROptions $options
     *
     * @return \chillerlan\QRCode\QRCode
     * @throws \chillerlan\QRCode\QRCodeException
     */
    public function setOptions(\YoastSEO_Vendor\chillerlan\QRCode\QROptions $options)
    {
        if (!\array_key_exists($options->eccLevel, $this::ECC_MODES)) {
            throw new \YoastSEO_Vendor\chillerlan\QRCode\QRCodeException('Invalid error correct level: ' . $options->eccLevel);
        }
        if (!\is_array($options->imageTransparencyBG) || \count($options->imageTransparencyBG) < 3) {
            $options->imageTransparencyBG = [255, 255, 255];
        }
        $options->version = (int) $options->version;
        // clamp min/max version number
        $options->versionMin = (int) \min($options->versionMin, $options->versionMax);
        $options->versionMax = (int) \max($options->versionMin, $options->versionMax);
        $this->options = $options;
        return $this;
    }
    /**
     * Renders a QR Code for the given $data and QROptions
     *
     * @param string $data
     *
     * @return mixed
     */
    public function render($data)
    {
        return $this->initOutputInterface($data)->dump();
    }
    /**
     * Returns a QRMatrix object for the given $data and current QROptions
     *
     * @param string $data
     *
     * @return \chillerlan\QRCode\Data\QRMatrix
     * @throws \chillerlan\QRCode\Data\QRCodeDataException
     */
    public function getMatrix($data)
    {
        $data = \trim($data);
        if (empty($data)) {
            throw new \YoastSEO_Vendor\chillerlan\QRCode\Data\QRCodeDataException('QRCode::getMatrix() No data given.');
        }
        $this->dataInterface = $this->initDataInterface($data);
        $maskPattern = $this->options->maskPattern === $this::MASK_PATTERN_AUTO ? $this->getBestMaskPattern() : \max(7, \min(0, (int) $this->options->maskPattern));
        $matrix = $this->dataInterface->initMatrix($maskPattern);
        if ((bool) $this->options->addQuietzone) {
            $matrix->setQuietZone($this->options->quietzoneSize);
        }
        return $matrix;
    }
    /**
     * shoves a QRMatrix through the MaskPatternTester to find the lowest penalty mask pattern
     *
     * @see \chillerlan\QRCode\Data\MaskPatternTester
     *
     * @return int
     */
    protected function getBestMaskPattern()
    {
        $penalties = [];
        $tester = new \YoastSEO_Vendor\chillerlan\QRCode\Data\MaskPatternTester();
        for ($testPattern = 0; $testPattern < 8; $testPattern++) {
            $matrix = $this->dataInterface->initMatrix($testPattern, \true);
            $tester->setMatrix($matrix);
            $penalties[$testPattern] = $tester->testPattern();
        }
        return \array_search(\min($penalties), $penalties, \true);
    }
    /**
     * returns a fresh QRDataInterface for the given $data
     *
     * @param string                       $data
     *
     * @return \chillerlan\QRCode\Data\QRDataInterface
     * @throws \chillerlan\QRCode\Data\QRCodeDataException
     */
    public function initDataInterface($data)
    {
        $DATA_MODES = [\YoastSEO_Vendor\chillerlan\QRCode\Data\Number::class => 'Number', \YoastSEO_Vendor\chillerlan\QRCode\Data\AlphaNum::class => 'AlphaNum', \YoastSEO_Vendor\chillerlan\QRCode\Data\Kanji::class => 'Kanji', \YoastSEO_Vendor\chillerlan\QRCode\Data\Byte::class => 'Byte'];
        foreach ($DATA_MODES as $dataInterface => $mode) {
            if (\call_user_func_array([$this, 'is' . $mode], [$data]) === \true) {
                return $this->loadClass($dataInterface, \YoastSEO_Vendor\chillerlan\QRCode\Data\QRDataInterface::class, $this->options, $data);
            }
        }
        throw new \YoastSEO_Vendor\chillerlan\QRCode\Data\QRCodeDataException('invalid data type');
        // @codeCoverageIgnore
    }
    /**
     * returns a fresh (built-in) QROutputInterface
     *
     * @param string $data
     *
     * @return \chillerlan\QRCode\Output\QROutputInterface
     * @throws \chillerlan\QRCode\Output\QRCodeOutputException
     */
    protected function initOutputInterface($data)
    {
        if ($this->options->outputType === $this::OUTPUT_CUSTOM && $this->options->outputInterface !== null) {
            return $this->loadClass($this->options->outputInterface, \YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputInterface::class, $this->options, $this->getMatrix($data));
        }
        foreach ($this::OUTPUT_MODES as $outputInterface => $modes) {
            if (\in_array($this->options->outputType, $modes, \true)) {
                return $this->loadClass($outputInterface, \YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputInterface::class, $this->options, $this->getMatrix($data));
            }
        }
        throw new \YoastSEO_Vendor\chillerlan\QRCode\Output\QRCodeOutputException('invalid output type');
    }
    /**
     * checks if a string qualifies as numeric
     *
     * @param string $string
     *
     * @return bool
     */
    public function isNumber($string)
    {
        $len = \strlen($string);
        $map = \str_split('0123456789');
        for ($i = 0; $i < $len; $i++) {
            if (!\in_array($string[$i], $map, \true)) {
                return \false;
            }
        }
        return \true;
    }
    /**
     * checks if a string qualifies as alphanumeric
     *
     * @param string $string
     *
     * @return bool
     */
    public function isAlphaNum($string)
    {
        $len = \strlen($string);
        for ($i = 0; $i < $len; $i++) {
            if (!\in_array($string[$i], \YoastSEO_Vendor\chillerlan\QRCode\Data\AlphaNum::CHAR_MAP, \true)) {
                return \false;
            }
        }
        return \true;
    }
    /**
     * checks if a string qualifies as Kanji
     *
     * @param string $string
     *
     * @return bool
     */
    public function isKanji($string)
    {
        $i = 0;
        $len = \strlen($string);
        while ($i + 1 < $len) {
            $c = (0xff & \ord($string[$i])) << 8 | 0xff & \ord($string[$i + 1]);
            if (!($c >= 0x8140 && $c <= 0x9ffc) && !($c >= 0xe040 && $c <= 0xebbf)) {
                return \false;
            }
            $i += 2;
        }
        return !($i < $len);
    }
    /**
     * a dummy
     *
     * @param $data
     *
     * @return bool
     */
    protected function isByte($data)
    {
        return !empty($data);
    }
}
