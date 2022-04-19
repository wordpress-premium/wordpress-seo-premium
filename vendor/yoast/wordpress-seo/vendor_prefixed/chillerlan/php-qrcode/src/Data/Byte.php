<?php

/**
 * Class Byte
 *
 * @filesource   Byte.php
 * @created      25.11.2015
 * @package      chillerlan\QRCode\Data
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode\Data;

use YoastSEO_Vendor\chillerlan\QRCode\QRCode;
/**
 * Byte mode, ISO-8859-1 or UTF-8
 */
class Byte extends \YoastSEO_Vendor\chillerlan\QRCode\Data\QRDataAbstract
{
    /**
     * @inheritdoc
     */
    protected $datamode = \YoastSEO_Vendor\chillerlan\QRCode\QRCode::DATA_BYTE;
    /**
     * @inheritdoc
     */
    protected $lengthBits = [8, 16, 16];
    /**
     * @inheritdoc
     */
    protected function write($data)
    {
        $i = 0;
        while ($i < $this->strlen) {
            $this->bitBuffer->put(\ord($data[$i]), 8);
            $i++;
        }
    }
}
