<?php // phpcs:ignore Internal.NoCodeFound ?>
{{schema name="yoast/job-salary-range" only-nested=true}}
{
	"@type": "MonetaryAmount",
	"currency": {{attribute name="currency"}},
	"value": {
		"@type": "QuantitativeValue",
		"minValue": {{attribute name="minValue"}},
		"maxValue": {{attribute name="maxValue"}},
		"unitText": {{attribute name="unit"}}
	}
}
