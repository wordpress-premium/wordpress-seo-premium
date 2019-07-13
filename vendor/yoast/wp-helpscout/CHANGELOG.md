# Change Log

All notable changes to this project will be documented in this file.
We follow [Semantic Versioning](http://semver.org/).

## 2.0.5: Apr 18th, 2019

* Gives the HelpScout beacon modal a higher Z-index to make sure the WordPress admin bar does not overlap it on smaller screens.

## 2.0.4: Oct 31st, 2018

* Wraps php_uname call in a function_exists to prevent errors on certain server configurations.

## 2.0.3: Aug 3th, 2017

* Show subject field by default in HelpScout form

## 2.0.2: Jan 19th, 2017

* Fixes a bug where the default value of the "Your name" field was a whitespace if the user hasn't filled in a first or last name in his/her account information.

## 2.0.1: Jun 14th, 2016

* Revert a backwards incompatible change because we are in a WordPress
context.

## 2.0.0: May 31st, 2016

* Added interface function to supply configuration to the beacon.

## 1.0.1: April 14th, 2016

### Bugfixes

* Replaces deprecated `get_currentuserinfo` with `wp_get_current_user`.

## 1.0: February 26th, 2016

### Features

* Introduces the wp HelpScout package that can be used to add the HelpScout beacon to the admin pages of WordPress.
