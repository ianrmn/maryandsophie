=== Companion Auto Update ===
Contributors: Papin
Donate link: https://www.paypal.me/dakel/1
Tags: auto, automatic, background, update, updates, updating, automatic updates, automatic background updates, easy update, wordpress update, theme update, plugin update, up-to-date, security, update latest version, update core, update wp, update wp core, major updates, minor updates, update to new version, update core, update plugin, update plugins, update plugins automatically, update theme, plugin, theme, advance, control, mail, notifations, enable
Requires at least: 3.5.0
Tested up to: 4.7
Stable tag: 2.7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin automatically updates all plugins, all themes and the wordpress core in the background.

== Description ==

= Keep your website safe! =
We understand that you might not always be able to check if your wordpress site has any updates that need to be installed, especially when you maintain multiple websites keeping them up-to-date can be a lot of work.
This plugin enables background auto-updating for all plugins, all themes and the wordpress core (both major and minor updates). 
We give you full control over what is updated and what isn't, via the settings page you can easily disallow auto-updating for either plugins, themes or wordpress core.

= Available settings =
1. Enable/disable updates for plugins (Enabled by default).
1. Enable/disable updates for themes (Enabled by default).
1. Enable/disable updates for minor WordPress updates (Enabled by default).
1. Enable/disable updates for major WordPress updates (Enabled by default).

= Email Notifications (Disabled by default) =
Email notifications are send once a day, right now two notifications are available:

1. Update Available: Sends an email when an update is available and you've disabled auto-updates
1. Successful Update: Sends an email when something has been updated (only works for plugins right now)

== Installation ==

= Manual install =
1. Download Companion Auto Update.
1. Upload the 'Companion Auto Update' directory to your '/wp-content/plugins/' directory.
1. Activate Companion Auto Update from your Plugins page.

= Via WordPress =
1. Search for 'Companion Auto Update'.
1. Click install.
1. Activate.

= Settings =
1. Configure this plugin via Tools > Auto updater.

== Screenshots ==

1. Easily configure what you'd like to auto-update and what not
2. If you have disabled one or multiple auto-updates, we can email you when an update is available.

== Changelog ==

= 2.7.4 =
* Fixed: Double e-mail notifications [Read support topic here](https://wordpress.org/support/topic/double-e-mail-notifications/)

= 2.7.3 =
* Fixed: Notifications sending when nothing was updated

= 2.7.2 =
* Fixed: Notifications settings not always updating

= 2.7.0 =
* Better updating: How ironic, this plugin did not handle it's own updates so well (required re-activation etc.) this has been fixed.
* Fixed bug: WordPress updates could not be disabled, this should work now.
* Update Notifications: You can now get an email notification when an plugin has been updated (right now this only works with plugins, themes coming up).
* Minor perfomance improvements.

= 2.5.0 =
* New: If you have disabled one or multiple auto-updates, we can email you when an update is available.

= 2.0 / 2.0.2 / 2.0.4 =
* Fully migrated translations to translate.wordpress.org
* Fixed issue where setting would show up multiple times when re-activating multiple times
* Added settings link to plugin list
* You can now select what to update and what not (plugins, themes, major and minor core updates)

= 1.0 =
* Initital release