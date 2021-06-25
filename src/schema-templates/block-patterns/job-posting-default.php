<?php
// phpcs:disable Yoast.NamingConventions.NamespaceName.Invalid
// phpcs:disable Yoast.NamingConventions.NamespaceName.MaxExceeded
namespace Yoast\WP\SEO\Schema_Templates\Block_Patterns;

/**
 * A default job posting, containing all the required and recommended blocks.
 */
class Job_Posting_Default extends Job_Posting_Base_Pattern {

	/**
	 * Gets the name of this block pattern.
	 *
	 * @return string The name of this block pattern.
	 */
	public function get_name() {
		return 'yoast/job-posting/default';
	}

	/**
	 * Gets the title of this block pattern.
	 *
	 * @return string The title of this block pattern.
	 */
	public function get_title() {
		return 'Job Posting (default)';
	}

	/**
	 * Gets the contents of this block pattern.
	 *
	 * @return string The contents of this block pattern.
	 */
	public function get_content() {
		return '<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:yoast/job-employment-type {"employmentType":"FULL_TIME"} -->
<div class="yoast-inner-container"><h3 data-id="title">Employment</h3><span data-id="employmentType" data-value="FULL_TIME">Full time</span></div>
<!-- /wp:yoast/job-employment-type --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:yoast/job-salary -->
<div class="yoast-inner-container"><!-- wp:yoast/job-salary-range {"currency":"USD","minValue":"1000","maxValue":"2000","unit":"MONTH"} -->
<div class="yoast-inner-container"><h3 data-id="title">Salary range</h3><div class="yoast-schema-flex"><span data-id="currency" data-value="USD">USD</span> 1000 - 2000 / <span data-id="unit" data-value="MONTH">month</span></div></div>
<!-- /wp:yoast/job-salary-range --></div>
<!-- /wp:yoast/job-salary --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:yoast/job-location -->
<div class="yoast-inner-container"><!-- wp:yoast/remote-location -->
<div class="yoast-inner-container"><h3 data-id="Location">Location</h3><p data-id="remote-location">This job is 100% remote.</p></div>
<!-- /wp:yoast/remote-location --></div>
<!-- /wp:yoast/job-location --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide"} -->
<hr class="wp-block-separator alignwide"/>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":24}}} -->
<p style="font-size:24px">We’re looking for a software architect or senior developer with a passion for software architecture to join our rapidly expanding business. Come help us make our development team even better!</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 id="h-about-the-job">About the job</h2>
<!-- /wp:heading -->

<!-- wp:yoast/job-description -->
<div class="yoast-inner-container"><p data-id="description">Technical leadership will be key in your role as a software architect. Our software architects solve big picture problems. You will be challenged by complex issues that require your smartly designed programs and systems to be tackled. So, software development is part of the job but will not be your primary task.</p></div>
<!-- /wp:yoast/job-description -->

<!-- wp:heading -->
<h2 id="h-about-you">About you</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Preferably you have some experience with (some of) the technology we use, like WordPress, PHP and (modern) JavaScript. You are familiar with design patterns and coding principles like SOLID and TDD and are able to explain and think in different programming paradigms (like functional vs OOP).</p>
<!-- /wp:paragraph -->

<!-- wp:yoast/job-requirements {"title_level":2} -->
<div class="yoast-inner-container"><h2 data-id="title">Requirements</h2><ul data-id="requirements"><li>Multiple years of software development experience.</li><li>The ability to clearly explain things to your colleagues.</li><li>The ability to learn fast.</li><li>Quickly familiarize yourself with new codebases and frameworks.</li></ul></div>
<!-- /wp:yoast/job-requirements -->

<!-- wp:yoast/job-benefits {"title_level":2} -->
<div class="yoast-inner-container"><h2 data-id="title">Benefits</h2><ul data-id="benefits"><li>A challenging job in a fast-growing, dynamic, ambitious and international atmosphere. Working at a company that impacts the web.</li><li>We have a great pension plan, which is fully paid by Yoast.</li><li>Exercise and stay fit! We have our own gym and a personal trainer!</li><li>The opportunity to learn a lot in a short time, at one of the leading SEO companies.</li></ul></div>
<!-- /wp:yoast/job-benefits -->

<!-- wp:paragraph -->
<p>Are you interested?<strong>&nbsp;Then respond before May 19, 2021.</strong>&nbsp;The application procedure consists of three interviews. Do you have questions? We\'ll be happy to answer them. Please send an email to jobs@yoast.com.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:yoast/job-apply-button {"placeholder":"Apply button (add a link)"} -->
<div class="yoast-inner-container"><div><a class="wp-block-button__link">Apply now</a></div></div>
<!-- /wp:yoast/job-apply-button --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:yoast/job-expiration {"expirationDate":"2021-05-19"} -->
<div class="yoast-inner-container"><strong data-id="title">Apply before</strong><div><time datetime="2021-05-19">May 19, 2021</time></div></div>
<!-- /wp:yoast/job-expiration --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide"} -->
<hr class="wp-block-separator alignwide"/>
<!-- /wp:separator -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->';
	}
}
