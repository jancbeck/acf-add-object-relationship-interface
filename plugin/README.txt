=== ACF - Add posts via relationship interface ===
Contributors: jancbeck
Tags: acf, advanced custom fields, relationship, ajax
Requires at least: 4.0
Tested up to: 4.6
Stable tag: 1.0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

**Note of deprecation:** This plugin will no longer receive updates in the future. I recommend using [other plugins available](https://wordpress.org/plugins/quick-and-easy-post-creation-for-acf-relationship-fields/).

Create posts from the relationship interface of the advanced custom fields plugin if they do not exist yet.

== Installation ==

Install like any other plugin. 

Notice that the plugin only supports relationship fields with a single post type.

== Changelog ==

= 1.0.8 =
* Added deprecation notice

= 1.0.7 =
* Fixes a bug where the add-button would not align correctly when the field had no post-type filter

= 1.0.6 =
* Set correct text domain to enable translations

= 1.0.5 =
* This version contained a bug so it should not be used

= 1.0.4 =
* Added WP 4.5 compatibility

= 1.0.3 =
* Improved compatibility with latest ACF version

= 1.0.2 =
* Added WP 4.4 compatibility

= 1.0.1 =
* Enqueue scripts via acf hook to prevent admin js errors

= 1.0.0 =
* Initial plugin version