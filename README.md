# Yoast SEO Premium

**Yoast SEO Premium** is a powerful plugin that helps you optimize your WordPress website for search engines. With its intuitive interface and robust features, it makes it easy to improve your website's visibility, drive more traffic, and increase conversions.

## Features

* **Keyword research and optimization**: Identify and optimize for the most relevant keywords for your content
* **Content analysis**: Get actionable feedback on your content's readability, structure, and SEO
* **Technical SEO**: Improve your website's crawl ability, indexability, and page speed
* **XML sitemaps**: Generate and submit sitemaps to search engines
* **Breadcrumbs**: Create and manage breadcrumbs for better site navigation
* **Social media integration**: Optimize your social media presence and engagement
* **Local SEO**: Improve your local search visibility with Google My Business integration
* **News SEO**: Optimize your news articles for Google News
* **Video SEO**: Optimize your videos for Google Videos
* **Schema.org integration**: Add schema markup to your website for better search engine understanding

## What's New in 23.4

***Released:** September 3, 2024*

> [!NOTE]  
> To avoid disruptive PHP warning messages like `PHP Warning: Undefined property: stdClass::$url` to be shown all over your screen and destroy your layout, this modified version **deactivated all checks for updates of Yoast SEO addons**. The addons themselves **still work as expected**, though.
>
> The changes were made in the file `wp-seo-premium.php` between lines `48` and `68`.

### Enhancements

- Adds support for discarding the changes when switching to a post, using the Top bar feature in Elementor.
- Adds *так* to the words recognized by the *transition words* assessment in Russian. Props to @pavelmai83.
- Improves the schema output by following the specification for the *SearchAction* more strictly.
- Re-enables the script concatenation that was disabled to prevent a bug with WordPress 5.5.
- Improves the look of the Yoast SEO metabox in the block editor by centering it and making it stand out more by using a background color.

### Bugfixes

- Fixes a bug where an image caption inside a classic block would be considered the introduction when using the *keyphrase in introduction* assessment in the default editor.
- Fixes a bug where the first tag instead of the primary tag would be shown in a permalink when adding a link in the Classic editor.
- Fixes a bug where the Yoast tab would disappear when opening and closing the Site Settings in Elementor.
- Fixes a bug where the Yoast user settings would be wiped out after a user profile update when the respective global settings were disabled.
- Fixes a bug where two admin links would not be resolvable when using a custom admin URL.

### Other

- Adds a learn more link to the primary category picker.
- Deprecates some functions in the `Yoast_Input_Validation` class.
- Deprecates the `Disable_Concatenate_Scripts_Integration` class.
- Deprecates the `Duplicate_Post_Integration` class.
- Deprecates the `WPSEO_Admin_User_Profile::user_profile()` method and the `admin/views/user-profile.php` file.

## System Requirements

* **WordPress**: `v6.4` or later
* **PHP**: `v7.2.5` or later
* **MySQL:** `v5.6` or later
* **Yoast SEO:** `v23.4`

## Installation

1. Upload the `yoast-seo-premium` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure the plugin by going to the Yoast SEO Premium settings page.

## Documentation

For detailed documentation and tutorials, please visit the [Yoast SEO Premium documentation](https://yoast.com/seo-plugin/premium-documentation/).

## Support

If you need help or have questions, please refer to the [Yoast SEO Premium support page](https://yoast.com/seo-plugin/premium-support/).
