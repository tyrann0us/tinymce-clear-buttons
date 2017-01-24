=== TinyMCE Clear Float ===
Contributors: Tyrannous
Donate link: 
Tags: clear, clear floats, formatting, tinymce, wordpress editor, wysiwyg
Requires at least: 4.0
Tested up to: 4.7.1
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a button to the WordPress TinyMCE editor to clear floats.

== Description ==

Adds a button to the WordPress TinyMCE editor to clear floats.

== Installation ==

1. Install the plugin through the WordPress “Plugins” screen
2. Activate the plugin

== Frequently Asked Questions ==

= Which HTML markup does the plugin use ? =

Until version 1.1, the following markup has been used: `<div style="clear: (left|right|both);"></div>`.
From version 1.2 on, the following markup is used: `<br style="clear: both;" />` (line breaks).
> Note: TinyMCE wrapps line breaks in paragraphs which may lead to additional margins depending on your theme. To prevent these margins paste the following in the “Custom CSS” part of the Customizer:
`p > br[style="clear: both;"]:only-child {
	content: '';
	display: block;
	margin-bottom: -1.5em;
}`
The value `1.5em` corresponds to your theme’s `margin-bottom` of `<p>` tags.

== Screenshots ==



== Changelog ==

= 1.2.0 =

* New maintainer; first update after seven years
* Feature: Removed clear left and clear right buttons (see [FAQ section](https://wordpress.org/plugins/tinymce-clear-buttons/faq/))
* Misc: Completely refactured plugin code

= 1.1 (05/10/2010) =
* Feature: Added HTML block in the style of WordPress

= 1.0 (04/28/2010)=
* Initial release