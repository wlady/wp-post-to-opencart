=== FogBugz Update Notifier Plugin ===
Author: Vladimir Zabara
Tags: admin, updates, notifier, fogbugz
Requires at least: 3.8
Tested up to: 3.9.1
Stable tag: 1.1.2



FogBugz Update Notifier Plugin.


== Description ==
This plugin is an add-on to "WP Updates Notifier" plugin by Scott Cariss. It allows to add 
"X-FogBugz-Case" extra header to notification email. The purpose is to automate FogBugz case creation process.



== Installation ==


1. Upload `wp-fogbugz-notifier` to the `/wp-content/plugins/`  directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure 'FogBugz Case' option (the case number where update notification will be placed).
4. Configure 'Plugin Repository' to check plugin updates or leave it empty to disable this feature



== Screenshots ==

1. Settings Screen


== Changelog ==

= 1.1.2 =
* Add plugins repository domain for updates and change updates behavior

= 1.1.1 =
* Extended WP Updater integration.

= 1.1 =
* Case number is added to the end of email subject
