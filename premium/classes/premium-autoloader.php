<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Classes
 */

_deprecated_file( __FILE__, 'WPSEO 9.4' );

/**
 * Class WPSEO_Premium_Autoloader.
 *
 * @deprecated 9.4
 */
class WPSEO_Premium_Autoloader {

	/**
	 * The part of the class we wanted to search.
	 *
	 * @var string
	 */
	private $search_pattern;

	/**
	 * The directory where the classes are located.
	 *
	 * @var string
	 */
	private $directory;

	/**
	 * This piece will be added.
	 *
	 * @var string
	 */
	private $file_replace;

	/**
	 * Additional sub-patterns of $suffix_pattern => $subdirectory pairs.
	 *
	 * @var array
	 */
	private $suffix_patterns;

	/**
	 * Regular expression for matching a class name against sub-patterns.
	 *
	 * @var string
	 */
	private $suffix_patterns_regex = '';

	/**
	 * Setting up the class.
	 *
	 * @param string $search_pattern  The pattern to match for the redirect.
	 * @param string $directory       The directory where the classes could be found.
	 * @param string $file_replace    Optional. The replacement for the file. Default empty string.
	 * @param array  $suffix_patterns Optional. Sub-patterns that determine a more specific location for classes
	 *                                ending in the respective suffix. The associative array hould contain
	 *                                $suffix_pattern => $subdirectory pairs. Default empty array.
	 */
	public function __construct( $search_pattern, $directory, $file_replace = '', $suffix_patterns = array() ) {
		_deprecated_constructor( 'WPSEO_Premium_Autoloader', 'WPSEO 9.4' );

		$this->search_pattern        = $search_pattern;
		$this->directory             = $directory;
		$this->file_replace          = ( $file_replace === '' ) ? $search_pattern : $file_replace;
		$this->suffix_patterns       = $suffix_patterns;
		$this->suffix_patterns_regex = $this->generate_suffix_patterns_regex( $this->suffix_patterns );

		spl_autoload_register( array( $this, 'load' ) );
	}

	/**
	 * Autoloader load method. Load the class.
	 *
	 * @param string $class The requested class name.
	 */
	public function load( $class ) {
		// Check & load file.
		if ( $this->contains_search_pattern( $class ) ) {
			$found_file = $this->find_file( $class );
			if ( $found_file !== false ) {
				require_once $found_file;
			}
		}
	}

	/**
	 * Does the filename contains the search pattern.
	 *
	 * @param string $class The classname to match.
	 *
	 * @return bool
	 */
	private function contains_search_pattern( $class ) {
		return 0 === strpos( $class, $this->search_pattern );
	}

	/**
	 * Searching for the file in the given directory.
	 *
	 * @param string $class The class to search for.
	 *
	 * @return bool|string
	 */
	private function find_file( $class ) {
		// Format file name.
		$file_name = $this->get_file_name( strtolower( $class ) );

		// Full file path.
		$class_path = dirname( __FILE__ ) . '/' . $this->directory;

		// Match against suffix patterns, if any are present.
		if ( ! empty( $this->suffix_patterns_regex ) && preg_match( $this->suffix_patterns_regex, $class, $matches ) ) {
			if ( isset( $this->suffix_patterns[ $matches[1] ] ) ) {
				$class_path .= trim( $this->suffix_patterns[ $matches[1] ], '/' ) . '/';
			}
		}

		// Append file name to class path.
		$full_path = $class_path . $file_name;

		// Check & load file.
		if ( file_exists( $full_path ) ) {
			return $full_path;
		}

		// This might be an interface.
		$full_path = str_replace( '.php', '-interface.php', $full_path );
		if ( file_exists( $full_path ) ) {
			return $full_path;
		}

		return false;
	}

	/**
	 * Parsing the file name.
	 *
	 * @param string $class The classname to convert to a file name.
	 *
	 * @return string
	 */
	private function get_file_name( $class ) {
		return str_ireplace( '_', '-', str_ireplace( $this->file_replace, '', $class ) ) . '.php';
	}

	/**
	 * Generates the regular expression to check for suffix patterns in a class name.
	 *
	 * @param array $suffix_patterns Sub-patterns as $suffix_pattern => $subdirectory pairs.
	 *
	 * @return string Regular expression, or empty string if no suffix patterns provided.
	 */
	private function generate_suffix_patterns_regex( $suffix_patterns ) {
		if ( empty( $suffix_patterns ) ) {
			return '';
		}

		$suffixes = array_map(
			'preg_quote',
			array_keys( $suffix_patterns ),
			array_fill( 0, count( $suffix_patterns ), '/' )
		);

		return '/(' . implode( '|', $suffixes ) . ')$/';
	}
}
