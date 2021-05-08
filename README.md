# Yoast SEO Premium

This is the pre-activated version of the WordPress plugin mentioned above. It allows you to use all features available in the premium version without limitation. By meticulously testing and reviewing the source code of every version, this plugin is guaranteed free of malware, backdoors, adware, and other malicious code.

**If you like this plugin, please consider purchasing it from the developer to support the person's hard work and motivate them to continue developing.**

## Note

This repository is a clone of the same [repository on GitLab](https://gitlab.com/wordpress-premium) where the original files are being pushed. Sign up at GitLab to be immediately notified of new versions of this plugin.

## Installation

To get the plugin, you can either download it as a compressed .zip file or use `git clone <URL>` to retrieve the files.

**Because `git clone` includes a hidden *.git* directory that stores older versions and thus increases the file size, it's recommended to download it as a .zip file.**

### 1. As WordPress plugin

You can install the plugin the same two ways you install other plugins that aren't part of wordpress.org's official plugin repository.

1. Extract and upload the plugin directory into `/wp-content/plugins/`
2. Download the .zip file, go to *Plugins* -> *Upload Plugin*, choose the .zip file and hit *Install Now*.

Go to the plugin page and activate the plugin you've just added.


### 2. As PHP Composer dependency

If you plan to use this plugin as a dependency in PHP Composer (for example, when using [Bedrock](https://roots.io/bedrock/)), follow the steps below:

1. Open the file *composer.json* of your project
2. In the `repositories` array, add a new object:

```
{
	"type": "gitlab",
	"url": "https://gitlab.com/wordpress-premium/<PLUGIN REPOSITORY NAME>"
}
``` 

Replace `<PLUGIN REPOSITORY NAME>` with the slug of the plugin as shown in the example below:


![](https://i.imgur.com/M6gnOnv.png)

**Important**: Do not use GitHub as `type` or inside the `url` since these are just clones from GitLab.
