<?php // phpcs:ignore Internal.NoCodeFound ?>
{{schema name="yoast/job-posting" }}
{
	"@type": "JobPosting",
	"title": "{{attribute name="job-title" }}",
	"description": {{inner-blocks-html blocks={ "yoast/job-description": "description" } null-when-empty=true allowed-tags=[ "h1","h2","h3","h4","h5","h6","br","a","p","b","strong","i","em", "ul", "ol", "li" ] }},
	"datePosted": "%%post_date%%",
	"validThrough": {{inner-blocks allowed-blocks=[ "yoast/job-expiration" ] only-first=true }},
	"employmentType": {{inner-blocks allowed-blocks=[ "yoast/job-employment-type" ] only-first=true }},
	"hiringOrganization": {
		"@id": "%%organization_id%%"
	},
	"mainEntityOfPage": {
		"@id": "%%main_schema_id%%"
	},
	"jobLocation": {{inner-blocks allowed-blocks=[ "yoast/office-location" ] only-first=true }},
	"jobLocationType": {{inner-blocks allowed-blocks=[ "yoast/remote-location" ] only-first=true }},
	"experienceRequirements": {{inner-blocks allowed-blocks=[ "yoast/job-requirements" ] only-first=true }},
	"jobBenefits": {{inner-blocks allowed-blocks=[ "yoast/job-benefits" ] only-first=true }},
	"baseSalary": {{inner-blocks allowed-blocks=[ "yoast/job-base-salary", "yoast/job-salary-range" ] only-first=true }}
}
