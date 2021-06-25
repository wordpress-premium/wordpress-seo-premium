<?php // phpcs:ignore Internal.NoCodeFound ?>
{{schema name="yoast/office-location" only-nested=true }}
{
	"@type": "Place",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": {{inner-blocks allowed-blocks=[ "yoast/job-location-address" ] only-first=true }},
		"addressLocality": {{inner-blocks allowed-blocks=[ "yoast/job-location-city" ] only-first=true }},
		"addressRegion": {{inner-blocks allowed-blocks=[ "yoast/job-location-region" ] only-first=true }},
		"postalCode": {{inner-blocks allowed-blocks=[ "yoast/job-location-postal-code" ] only-first=true }},
		"addressCountry": {{inner-blocks allowed-blocks=[ "yoast/job-location-country" ] only-first=true }}
	}
}
