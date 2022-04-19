<?php

/**
 * Class QROutputAbstract
 *
 * @filesource   QROutputAbstract.php
 * @created      09.12.2015
 * @package      chillerlan\QRCode\Output
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode\Output;

use YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix;
use YoastSEO_Vendor\chillerlan\QRCode\QROptions;
/**
 *
 */
abstract class QROutputAbstract implements \YoastSEO_Vendor\chillerlan\QRCode\Output\QROutputInterface
{
    /**
     * @var int
     */
    protected $moduleCount;
    /**
     * @param \chillerlan\QRCode\Data\QRMatrix $matrix
     */
    protected $matrix;
    /**
     * @var \chillerlan\QRCode\QROptions
     */
    protected $options;
    /**
     * QROutputAbstract constructor.
     *
     * @param \chillerlan\QRCode\QROptions     $options
     * @param \chillerlan\QRCode\Data\QRMatrix $matrix
     */
    public function __construct(\YoastSEO_Vendor\chillerlan\QRCode\QROptions $options, \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix $matrix)
    {
        $this->options = $options;
        $this->matrix = $matrix;
        $this->moduleCount = $this->matrix->size();
    }
    /**
     * @see file_put_contents()
     *
     * @param string $data
     * @return bool|int
     */
    protected function saveToFile($data)
    {
        return \file_put_contents($this->options->cachefile, $data);
    }
}
