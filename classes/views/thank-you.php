<?php
/**
 * WPSEO Premium plugin file.
 *
 * @package WPSEO\Premium\Views
 */

?>
<img class="yoast-image" src="https://yoast.com/app/uploads/2021/06/premium_assistant_bubble.png" />
<h1><?php esc_html_e( 'Installation successful!', 'wordpress-seo-premium' ); ?></h1>
<p class="yoast-whats-next">
	<?php esc_html_e( 'So, what\'s next?', 'wordpress-seo-premium' ); ?>
</p>
<div class="yoast-grid yoast">
	<div>
		<h3>
			<?php esc_html_e( 'Rank with articles you want to rank with', 'wordpress-seo-premium' ); ?>
		</h3>
		<img width="256px" height="196px" src="https://yoast.com/shared-assets/images/wpseo_installation_successful/16-6/cornerstone.png" alt="Cornerstone" />
		<p>
			<?php
			echo sprintf(
				/* translators: %1$s: <strong>, %2$s: </strong> */
				esc_html__(
					'%1$sCornerstone content%2$s is the content on your site that’s most important. You want to rank highest in Google with these articles. Make sure your internal linking structure reflects what pages are most important. Want to know how?',
					'wordpress-seo-premium'
				),
				'<strong>',
				'</strong>'
			);
			?>
		</p>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpseo_workouts' ) ); ?>" class="yoast-button yoast-button--secondary" target="_blank">
			<?php esc_html_e( 'Do the cornerstone workout!', 'wordpress-seo-premium' ); ?>
		</a>
	</div>
	<div>
		<h3>
			<?php esc_html_e( 'Optimize your content further with our smart analysis', 'wordpress-seo-premium' ); ?>
		</h3>
		<img width="256px" height="196px" src="https://yoast.com/shared-assets/images/wpseo_installation_successful/16-6/analysis.png" alt="Analysis" />
		<p>
			<?php
			echo sprintf(
				/* translators: %1$s: <strong>, %2$s: </strong> */
				esc_html__(
					'Different people search with different search terms. With our %1$spremium analysis%2$s, you are free to use variations and synonyms of your keywords in your content, which will make your writing style far more natural.',
					'wordpress-seo-premium'
				),
				'<strong>',
				'</strong>'
			);
			?>
		</p>
		<a href="<?php echo esc_url( admin_url( 'edit.php?post_status=publish&post_type=post&seo_filter=na' ) ); ?>" class="yoast-button yoast-button--secondary" target="_blank">
			<?php esc_html_e( 'Score some more green bullets', 'wordpress-seo-premium' ); ?>
		</a>
	</div>
	<div>
		<h3>
			<?php esc_html_e( 'Keep your site well-organised so people won\'t get lost', 'wordpress-seo-premium' ); ?>
		</h3>
		<img width="256px" height="196px" src="https://yoast.com/shared-assets/images/wpseo_installation_successful/16-6/redirect-manager.png" alt="redirect-manager" />
		<p>
			<?php
			echo sprintf(
				/* translators: %1$s: Yoast SEO, %2$s: <strong>, %3$s: </strong> */
				esc_html__(
					'The %1$s %2$sRedirect Manager%3$s automatically prevents visitors from reaching a dead end whenever you move or delete content. It also makes managing your existing redirects easy.',
					'wordpress-seo-premium'
				),
				'Yoast SEO',
				'<strong>',
				'</strong>'
			);
			?>
		</p>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpseo_redirects' ) ); ?>" class="yoast-button yoast-button--secondary" target="_blank">
			<?php esc_html_e( 'Check out the Redirect Manager', 'wordpress-seo-premium' ); ?>
		</a>
	</div>
	<div>
		<h3>
			<?php esc_html_e( 'Master vital SEO skills with our online courses', 'wordpress-seo-premium' ); ?>
		</h3>
		<img width="256px" height="196px" src="https://yoast.com/shared-assets/images/wpseo_installation_successful/16-6/academy.png" alt="Academy" />
		<p>
			<?php
			echo sprintf(
				/* translators: %1$s: Yoast SEO Premium, %2$s: <strong>, %3$s: Yoast SEO, %4$s: </strong> */
				esc_html__(
					'%1$s grants you direct access to %2$sall premium %3$s academy courses%4$s. Learn all the ins and outs of holistic SEO from industry experts.',
					'wordpress-seo-premium'
				),
				'Yoast SEO Premium',
				'<strong>',
				'Yoast SEO',
				'</strong>'
			);
			?>

		</p>
		<a href="<?php echo esc_url( add_query_arg( [ 'screen' => 'wpseo_installation_successful' ], esc_url( WPSEO_Shortlinker::get( 'https://yoa.st/4em' ) ) ) ); ?>" class="yoast-button yoast-button--secondary" target="_blank">
			<?php esc_html_e( 'Browse our courses', 'wordpress-seo-premium' ); ?>
		</a>
	</div>
</div>
