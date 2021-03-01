<?php // phpcs:ignore Internal.NoCodeFound ?>
{{schema name="yoast/job-base-salary" only-nested=true}}
{
	"@type": "MonetaryAmount",
	"currency": {{attribute name="currency"}},
	"value": {
		"@type": "QuantitativeValue",
		"value": {{attribute name="value"}},
		"unitText": {{attribute name="unit"}}
	}
}
