<?php

namespace Yoast\WP\SEO\Premium\Integrations;

use Yoast\WP\SEO\Conditionals\Open_Graph_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;

/**
 * Class Abstract_OpenGraph_Integration.
 */
abstract class Abstract_OpenGraph_Integration implements Integration_Interface {

	/**
	 * The name or prefix for the social title option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_TITLE = '';

	/**
	 * The name or prefix for the social description option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_DESCRIPTION = '';

	/**
	 * The name or prefix for the social image ID option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_IMAGE_ID = '';

	/**
	 * The name or prefix for the social image URL option.
	 *
	 * @var string
	 */
	const OPTION_TITLES_KEY_IMAGE = '';

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	protected $options;

	/**
	 * Integration constructor.
	 *
	 * @param Options_Helper $options The options helper.
	 */
	public function __construct( Options_Helper $options ) {
		$this->options = $options;
	}

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Open_Graph_Conditional::class ];
	}

	/**
	 * Retrieves the relevant social title from the options.
	 *
	 * @param string $title The default title.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_title( $title ) {
		$social_title = $this->options->get( $this::OPTION_TITLES_KEY_TITLE );

		if ( ! empty( $social_title ) ) {
			$title = $social_title;
		}

		return $title;
	}

	/**
	 * Retrieves the relevant social description from the options.
	 *
	 * @param string $description The default description.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_description( $description ) {
		$social_description = $this->options->get( $this::OPTION_TITLES_KEY_DESCRIPTION );

		if ( ! empty( $social_description ) ) {
			$description = $social_description;
		}

		return $description;
	}

	/**
	 * Retrieves the relevant social image ID from the options.
	 *
	 * @param int $id The default image ID.
	 *
	 * @return mixed|int The filtered value.
	 */
	public function filter_image_id( $id ) {
		$social_id = $this->options->get( $this::OPTION_TITLES_KEY_IMAGE_ID );

		if ( ! empty( $social_id ) ) {
			$id = $social_id;
		}

		return $id;
	}

	/**
	 * Retrieves the relevant social image URL from the options.
	 *
	 * @param string $url The default image URL.
	 *
	 * @return mixed|int The filtered value.
	 */
	public function filter_image( $url ) {
		$social_url = $this->options->get( $this::OPTION_TITLES_KEY_IMAGE );

		if ( ! empty( $social_url ) ) {
			$url = $social_url;
		}

		return $url;
	}

	/**
	 * Retrieves the relevant social title for the subtype from the options.
	 *
	 * @param string $title          The default title.
	 * @param string $object_subtype The subtype of the current indexable.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_title_for_subtype( $title, $object_subtype ) {
		$social_title = $this->options->get( $this::OPTION_TITLES_KEY_TITLE . $object_subtype );

		if ( ! empty( $social_title ) ) {
			$title = $social_title;
		}

		return $title;
	}

	/**
	 * Retrieves the relevant social description for the subtype from the options.
	 *
	 * @param string $description    The default description.
	 * @param string $object_subtype The subtype of the current indexable.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_description_for_subtype( $description, $object_subtype ) {
		$social_description = $this->options->get( $this::OPTION_TITLES_KEY_DESCRIPTION . $object_subtype );

		if ( ! empty( $social_description ) ) {
			$description = $social_description;
		}

		return $description;
	}

	/**
	 * Retrieves the relevant social image ID for the subtype from the options.
	 *
	 * @param int    $id             The default image ID.
	 * @param string $object_subtype The subtype of the current indexable.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_image_id_for_subtype( $id, $object_subtype ) {
		$social_id = $this->options->get( $this::OPTION_TITLES_KEY_IMAGE_ID . $object_subtype );

		if ( ! empty( $social_id ) ) {
			$id = $social_id;
		}

		return $id;
	}

	/**
	 * Retrieves the relevant social image URL for the subtype from the options.
	 *
	 * @param string $url            The default image URL.
	 * @param string $object_subtype The subtype of the current indexable.
	 *
	 * @return mixed|string The filtered value.
	 */
	public function filter_image_for_subtype( $url, $object_subtype ) {
		$social_url = $this->options->get( $this::OPTION_TITLES_KEY_IMAGE . $object_subtype );

		if ( ! empty( $social_url ) ) {
			$url = $social_url;
		}

		return $url;
	}
}
