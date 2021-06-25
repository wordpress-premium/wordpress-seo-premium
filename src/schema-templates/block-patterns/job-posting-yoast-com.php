<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
// phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A job posting as seen on Yoast.com.
 */
class Job_Posting_Yoast_Com extends Job_Posting_Base_Pattern {

	/**
	 * Gets the name of this block pattern.
	 *
	 * @return string The name of this block pattern.
	 */
	public function get_name() {
		return 'yoast/job-posting/yoast';
	}

	/**
	 * Gets the title of this block pattern.
	 *
	 * @return string The title of this block pattern.
	 */
	public function get_title() {
		return 'Job Posting (yoast.com)';
	}

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @return string The contents of this block pattern.
	 */
	public function get_content() {
		return '<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:yoast/job-employment-type {"title_level":2,"employmentType":"FULL_TIME"} -->
<div class="yoast-inner-container"><h2 data-id="title">Employment</h2><span data-id="employmentType" data-value="FULL_TIME">Full time</span></div>
<!-- /wp:yoast/job-employment-type --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:yoast/job-salary -->
<div class="yoast-inner-container"><!-- wp:yoast/job-base-salary {"currency":"USD","value":"4000","unit":"MONTH"} -->
<div class="yoast-inner-container"><h3 data-id="title">Base salary</h3><div class="yoast-schema-flex"><span data-id="currency" data-value="USD">USD</span> 4000 / <span data-id="unit" data-value="MONTH">month</span></div></div>
<!-- /wp:yoast/job-base-salary --></div>
<!-- /wp:yoast/job-salary --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide"} -->
<hr class="wp-block-separator alignwide"/>
<!-- /wp:separator -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph {"style":{"typography":{"fontSize":24}}} -->
<p style="font-size:24px">Yoast is growing! And we’re searching for an ambitious UX designer! Do you want to work on software that is used by over 12 million people worldwide? Do you believe that good design can make the complex field of SEO more accessible to an even larger audience? If you do, then we’re looking for you!</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="h-about-the-job">About the job</h2>
<!-- /wp:heading -->

<!-- wp:yoast/job-description -->
<div class="yoast-inner-container"><p data-id="description">As UX designer, you’ll be part of a multidisciplinary squad, consisting of developers, a tester, and a product owner. Together you’ll work on pushing Yoast SEO forward. Your squad will be partly based in the Netherlands, and partly in other places within a similar time zone.<br><br>Besides working within a squad on a daily basis, you’re also part of our UX tribe, consisting of other UX designers and - researchers. As part of this tribe you help improve our design system and our design processes. You contribute to develop a shared vision.</p></div>
<!-- /wp:yoast/job-description -->

<!-- wp:heading -->
<h2 id="h-about-you">About you</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Do you love diving into details? And do you care deeply about creating visually appealing experiences? But are you also convinced that creativity is found in truly understanding a problem and in finding the right solution?</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>We encourage out-of-the-box thinking (we love new ideas!), but we also value a pragmatic attitude. You respect the scope of the project, how your choices impact others and what possible trade-offs are. You understand that your designs are not a work of art, but a means to building a product. A product that you build together with your teammates.</p>
<!-- /wp:paragraph -->

<!-- wp:yoast/job-requirements {"title_level":2} -->
<div class="yoast-inner-container"><h2 data-id="title">Requirements</h2><ul data-id="requirements"><li>You enjoy working as part of a close-knit team. Together with your squad members, you’re responsible for fleshing out product ideas, bringing them to life and shipping them to our users.</li><li>You are passionate about information architecture and are comfortable working with design systems and - patterns.</li><li>You are able to create highly detailed designs and prototypes, but also fast proof of concepts.</li><li>You are comfortable with modern design tools (Sketch is the tool we use).</li><li>If you have experience with HTML, CSS and JS, we consider that a bonus.</li><li>If you have experience with WordPress and the field of SEO, we also consider that a bonus.</li></ul></div>
<!-- /wp:yoast/job-requirements -->

<!-- wp:yoast/job-benefits {"title_level":2} -->
<div class="yoast-inner-container"><h2 data-id="title">Benefits</h2><ul data-id="benefits"><li>A challenging job in a fast-growing, dynamic, ambitious and international atmosphere.</li><li>Working at a company that impacts the web.</li><li>Exercise and stay fit! We have our own gym and a personal trainer!</li><li>We have a really fun (slightly crazy) company culture with lots and lots of team building activities. The know-your-colleagues-quiz, lots of celebrations and LEGO-building days. Because of Covid a lot of these things are online now!</li><li>The opportunity to learn a lot in a short time, at one of the leading SEO companies.</li></ul></div>
<!-- /wp:yoast/job-benefits -->

<!-- wp:paragraph -->
<p>Are you interested?<strong>&nbsp;Then respond before May 19, 2021.</strong>&nbsp;The application procedure consists of three interviews. Do you have questions? We\'ll be happy to answer them. Please send an email to jobs@yoast.com.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:yoast/job-location -->
<div class="yoast-inner-container"><!-- wp:yoast/office-location -->
<div class="yoast-inner-container"><h3 data-id="Location">Location</h3><!-- wp:yoast/job-location-address -->
<div class="yoast-job-block__location__address yoast-inner-container"><span data-id="address">Dierenstraat 2021</span></div>
<!-- /wp:yoast/job-location-address -->

<!-- wp:yoast/job-location-postal-code -->
<div class="yoast-job-block__location__postal-code yoast-inner-container"><span data-id="postal-code">1234 AB</span></div>
<!-- /wp:yoast/job-location-postal-code -->

<!-- wp:yoast/job-location-city -->
<div class="yoast-job-block__location__city yoast-inner-container"><span data-id="city">Wijchen</span></div>
<!-- /wp:yoast/job-location-city -->

<!-- wp:yoast/job-location-country -->
<div class="yoast-job-block__location__country yoast-inner-container"><span data-id="country">Netherlands</span></div>
<!-- /wp:yoast/job-location-country --></div>
<!-- /wp:yoast/office-location --></div>
<!-- /wp:yoast/job-location -->

<!-- wp:yoast/job-apply-button {"placeholder":"Apply button (add a link)"} -->
<div class="yoast-inner-container"><div><a class="wp-block-button__link">Apply now</a></div></div>
<!-- /wp:yoast/job-apply-button -->

<!-- wp:yoast/job-expiration {"expirationDate":"2021-05-21"} -->
<div class="yoast-inner-container"><strong data-id="title">Closes on</strong><div><time datetime="2021-05-21">May 21, 2021</time></div></div>
<!-- /wp:yoast/job-expiration --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->';
	}
}
