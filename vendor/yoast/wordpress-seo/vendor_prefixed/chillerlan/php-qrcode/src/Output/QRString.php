<?php

/**
 * Class QRString
 *
 * @filesource   QRString.php
 * @created      05.12.2015
 * @package      chillerlan\QRCode\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode\Output;

use YoastSEO_Vendor\chillerlan\QRCode\QRCode;
/**
 * Converts the matrix data into string types
 */
class QRString extends \YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputAbstract
{
    /**
     * @return string
     * @throws \chillerlan\QRCode\Output\QRCodeOutputException
     */
    public function dump()
    {
        $data = $this->options->outputType === \YoastSEO_Vendor\chillerlan\QRCode\QRCode::OUTPUT_STRING_JSON ? \json_encode($this->matrix->matrix()) : $this->toString();
        if ($this->options->cachefile !== null) {
            if (!\is_writable(\dirname($this->options->cachefile))) {
                throw new \YoastSEO_Vendor\chillerlan\QRCode\Output\QRCodeOutputException('Could not write data to cache file: ' . $this->options->cachefile);
            }
            $this->saveToFile($data);
        }
        return $data;
    }
    /**
     * @return string
     */
    protected function toString()
    {
        $str = [];
        foreach ($this->matrix->matrix() as $row) {
            $r = [];
            foreach ($row as $col) {
                $col = $this->options->moduleValues[$col];
                // fallback
                if (\is_bool($col) || !\is_string($col)) {
                    $col = $col ? $this->options->textDark : $this->options->textLight;
                }
                $r[] = $col;
            }
            $str[] = \implode('', $r);
        }
        return \implode($this->options->eol, $str);
    }
}
