<?php

/**
 * Class QROptions
 *
 * @filesource   QROptions.php
 * @created      08.12.2015
 * @package      chillerlan\QRCode
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */
namespace YoastSEO_Vendor\chillerlan\QRCode;

use YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix;
use YoastSEO_Vendor\chillerlan\QRCode\Traits\Container;
/**
 * @property int    $version
 * @property int    $versionMin
 * @property int    $versionMax
 * @property int    $eccLevel
 * @property int    $maskPattern
 * @property bool   $addQuietzone
 * @property bool   $quietzoneSize
 *
 * @property string $outputType
 * @property string $outputInterface
 * @property string $cachefile
 *
 * @property string $eol
 * @property int    $scale
 *
 * @property string $cssClass
 * @property string $svgOpacity
 * @property string $svgDefs
 *
 * @property string $textDark
 * @property string $textLight
 *
 * @property bool   $imageBase64
 * @property bool   $imageTransparent
 * @property array  $imageTransparencyBG
 * @property int    $pngCompression
 * @property int    $jpegQuality
 *
 * @property array  $moduleValues
 */
class QROptions
{
    use Container;
    /**
     * QR Code version number
     *
     *   [1 ... 40] or QRCode::VERSION_AUTO
     *
     * @var int
     */
    protected $version = \YoastSEO_Vendor\chillerlan\QRCode\QRCode::VERSION_AUTO;
    /**
     * Minimum QR version (if $version = QRCode::VERSION_AUTO)
     *
     * @var int
     */
    protected $versionMin = 1;
    /**
     * Maximum QR version
     *
     * @var int
     */
    protected $versionMax = 40;
    /**
     * Error correct level
     *
     *   QRCode::ECC_X where X is
     *    L =>  7%
     *    M => 15%
     *    Q => 25%
     *    H => 30%
     *
     * @var int
     */
    protected $eccLevel = \YoastSEO_Vendor\chillerlan\QRCode\QRCode::ECC_L;
    /**
     * Mask Pattern to use
     *
     *  [0...7] or QRCode::MASK_PATTERN_AUTO
     *
     * @var int
     */
    protected $maskPattern = \YoastSEO_Vendor\chillerlan\QRCode\QRCode::MASK_PATTERN_AUTO;
    /**
     * Add a "quiet zone" (margin) according to the QR code spec
     *
     * @var bool
     */
    protected $addQuietzone = \true;
    /**
     *  Size of the quiet zone
     *
     *   internally clamped to [0 ... $moduleCount / 2], defaults to 4 modules
     *
     * @var int
     */
    protected $quietzoneSize = 4;
    /**
     * QRCode::OUTPUT_MARKUP_XXXX where XXXX = HTML, SVG
     * QRCode::OUTPUT_IMAGE_XXX where XXX = PNG, GIF, JPG
     * QRCode::OUTPUT_STRING_XXXX where XXXX = TEXT, JSON
     * QRCode::OUTPUT_CUSTOM
     *
     * @var string
     */
    protected $outputType = \YoastSEO_Vendor\chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG;
    /**
     * the FQCN of the custom QROutputInterface if $outputType is set to QRCode::OUTPUT_CUSTOM
     *
     * @var string
     */
    protected $outputInterface;
    /**
     * /path/to/cache.file
     *
     * @var string
     */
    protected $cachefile;
    /**
     * newline string [HTML, SVG, TEXT]
     *
     * @var string
     */
    protected $eol = \PHP_EOL;
    /**
     * size of a QR code pixel [SVG, IMAGE_*]
     * HTML -> via CSS
     *
     * @var int
     */
    protected $scale = 5;
    /**
     * a common css class
     *
     * @var string
     */
    protected $cssClass;
    /**
     * SVG opacity
     *
     * @var float
     */
    protected $svgOpacity = 1.0;
    /**
     * anything between <defs>
     *
     * @see https://developer.mozilla.org/docs/Web/SVG/Element/defs
     *
     * @var string
     */
    protected $svgDefs = '<style>rect{shape-rendering:crispEdges}</style>';
    /**
     * string substitute for dark
     *
     * @var string
     */
    protected $textDark = '🔴';
    /**
     * string substitute for light
     *
     * @var string
     */
    protected $textLight = '⭕';
    /**
     * toggle base64 or raw image data
     *
     * @var bool
     */
    protected $imageBase64 = \true;
    /**
     * toggle transparency, not supported by jpg
     *
     * @var bool
     */
    protected $imageTransparent = \true;
    /**
     * @see imagecolortransparent()
     *
     * @var array [R, G, B]
     */
    protected $imageTransparencyBG = [255, 255, 255];
    /**
     * @see imagepng()
     *
     * @var int
     */
    protected $pngCompression = -1;
    /**
     * @see imagejpeg()
     *
     * @var int
     */
    protected $jpegQuality = 85;
    /**
     * Module values map
     *
     *   HTML : #ABCDEF, cssname, rgb(), rgba()...
     *   IMAGE: [63, 127, 255] // R, G, B
     *
     * @var array
     */
    protected $moduleValues = [
        // light
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DATA => \false,
        // 4
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FINDER => \false,
        // 6
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_SEPARATOR => \false,
        // 8
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT => \false,
        // 10
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TIMING => \false,
        // 12
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FORMAT => \false,
        // 14
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_VERSION => \false,
        // 16
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_QUIETZONE => \false,
        // 18
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TEST => \false,
        // 255
        // dark
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DARKMODULE << 8 => \true,
        // 512
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_DATA << 8 => \true,
        // 1024
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FINDER << 8 => \true,
        // 1536
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_ALIGNMENT << 8 => \true,
        // 2560
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TIMING << 8 => \true,
        // 3072
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_FORMAT << 8 => \true,
        // 3584
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_VERSION << 8 => \true,
        // 4096
        \YoastSEO_Vendor\chillerlan\QRCode\Data\QRMatrix::M_TEST << 8 => \true,
    ];
}
