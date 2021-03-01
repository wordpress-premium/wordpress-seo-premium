<?php // phpcs:ignore Internal.NoCodeFound ?>
{{schema name="yoast/office-location" only-nested=true }}
{
	"@type": "Place",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": {{html name="address"}},
		"addressLocality": {{html name="city"}},
		"addressRegion": {{html name="region"}},
		"postalCode": {{html name="postal-code"}},
		"addressCountry": {{html name="country"}}
	}
}
