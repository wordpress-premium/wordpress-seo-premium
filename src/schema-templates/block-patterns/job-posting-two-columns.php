<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A job posting containing all the required and recommended blocks, shown in two columns (with a two-column header).
 *
 * @phpcs:disable Yoast.NamingConventions.ObjectNameDepth.MaxExceeded
 */
class Job_Posting_Two_Columns extends Job_Posting_Base_Pattern {

	/**
	 * Gets the name of this block pattern.
	 *
	 * @return string The name of this block pattern.
	 */
	public function get_name() {
		return 'yoast/job-posting/two-columns';
	}

	/**
	 * Gets the title of this block pattern.
	 *
	 * @return string The title of this block pattern.
	 */
	public function get_title() {
		return 'Two-column header and two columns of text';
	}

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @return string The contents of this block pattern.
	 */
	public function get_content() {
		return '<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:html -->
		<strong>Employment</strong>
		<!-- /wp:html -->

		<!-- wp:yoast/job-employment-type {"employmentType":"FULL_TIME"} -->
		<div class="yoast-job-block__employment "><div><span data-id="employmentType" data-value="FULL_TIME">Full time</span></div></div>
		<!-- /wp:yoast/job-employment-type --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:html -->
		<strong>Salary range</strong>
		<!-- /wp:html -->

		<!-- wp:yoast/job-salary -->
		<div class=""><!-- wp:yoast/job-salary-range {"currency":"USD","minValue":"1000","maxValue":"2000","unit":"MONTH"} -->
		<div class="yoast-job-block__salary "><div class="yoast-schema-flex"><span data-id="currency" data-value="USD">USD</span> 1000 - 2000 / <span data-id="unit" data-value="MONTH">month</span></div></div>
		<!-- /wp:yoast/job-salary-range --></div>
		<!-- /wp:yoast/job-salary --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:html -->
		<strong>Location</strong>
		<!-- /wp:html -->

		<!-- wp:yoast/job-location -->
		<div class=""><!-- wp:yoast/office-location -->
		<div class="yoast-job-block__location "><!-- wp:yoast/job-location-address -->
		<div class="yoast-job-block__location__address "><span data-id="address">350 5th Avenue</span></div>
		<!-- /wp:yoast/job-location-address -->

		<!-- wp:yoast/job-location-postal-code -->
		<div class="yoast-job-block__location__postal-code "><span data-id="postal-code">10118</span></div>
		<!-- /wp:yoast/job-location-postal-code -->

		<!-- wp:yoast/job-location-city -->
		<div class="yoast-job-block__location__city "><span data-id="city">New York</span></div>
		<!-- /wp:yoast/job-location-city -->

		<!-- wp:yoast/job-location-region -->
		<div class="yoast-job-block__location__region "><span data-id="region">NY</span></div>
		<!-- /wp:yoast/job-location-region -->

		<!-- wp:yoast/job-location-country -->
		<div class="yoast-job-block__location__country "><span data-id="country">United States of America</span></div>
		<!-- /wp:yoast/job-location-country --></div>
		<!-- /wp:yoast/office-location --></div>
		<!-- /wp:yoast/job-location --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->

		<!-- wp:separator {"align":"wide"} -->
		<hr class="wp-block-separator alignwide"/>
		<!-- /wp:separator -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":24}}} -->
		<p style="font-size:24px">Our company is growing! And we’re searching for an ambitious employee! Do you believe that a hard work is fundamental for your business? If you do, we’re probably looking for you!</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading -->
		<h2 id="h-about-the-job">About the job</h2>
		<!-- /wp:heading -->

		<!-- wp:yoast/job-description -->
		<div class="yoast-job-block__description "><p data-id="description">You’ll be part of a interdisciplinary team and together you’ll work on challenging, varied projects. You’ll get the freedom and responsibility to reach your full potential!</p></div>
		<!-- /wp:yoast/job-description -->

		<!-- wp:heading -->
		<h2 id="h-about-you">About you</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Do you you have a passion for your job? Are you aware of current trends in your field? Do you love diving into details?</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>We’re looking for someone who is proactive, patient and smart, has an eye for details, and is a great communicator and motivator. If you also have a sense of humor and an enthusiasm for participating in discussions, you’re probably a fit!</p>
		<!-- /wp:paragraph -->

		<!-- wp:yoast/job-requirements {"title_level":2} -->
		<h2 data-id="title">Requirements</h2><div class="yoast-job-block__requirements "><ul data-id="requirements"><li>You enjoy working in a fast-paced team environment.</li><li>You don’t ever think “good enough” is good enough.</li><li>You are available for 40 hours per week.</li><li>You speak and write English fluently (preferably with at least proficiency level C1).</li></ul></div>
		<!-- /wp:yoast/job-requirements -->

		<!-- wp:yoast/job-benefits {"title_level":2} -->
		<h2 data-id="title">Benefits</h2><div class="yoast-job-block__benefits "><ul data-id="benefits"><li>A challenging job in a fast-growing, dynamic, ambitious and international atmosphere.</li><li>25 vacation days (on the base of 40 hours).</li><li>You’ll be able to spend 10% of your salary on education.</li><li>We have a really fun company culture with lots of team building activities.</li></ul></div>
		<!-- /wp:yoast/job-benefits -->

		<!-- wp:paragraph -->
		<p>Are you interested? Then please send your application to this@emailaddress.com before January 1, 2022. Do you have any questions? We’ll be happy to answer them.</p>
		<!-- /wp:paragraph -->

		<!-- wp:yoast/job-application-closing-date {"closingDate":"2022-01-01"} -->
		<div class="yoast-job-block__application-closing-date "><span data-id="title">Apply before</span> <time datetime="2022-01-01">January 1, 2022</time></div>
		<!-- /wp:yoast/job-application-closing-date -->

		<!-- wp:separator {"align":"wide"} -->
		<hr class="wp-block-separator alignwide"/>
		<!-- /wp:separator -->

		<!-- wp:paragraph -->
		<p></p>
		<!-- /wp:paragraph -->';
	}
}
