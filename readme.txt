=== TinyMCE Clear Float ===
Contributors: Tyrannous
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=T5JM3KRTUBEZA
Tags: clear, clear floats, formatting, tinymce, wordpress editor, wysiwyg
Requires at least: 4.6
Tested up to: 4.7.3
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a button to the WordPress TinyMCE editor to clear floats.

== Description ==

Adds a button to the WordPress TinyMCE editor to clear floats.

== Screenshots ==

1. Before: Floated images in the editor. The second image overlaps the first.
2. After: Added clear tag (see new icon in second toolbar).
3. Markup in the Text Editor (notice `<br style="clear: both;" />`).

== Frequently Asked Questions ==

= Which HTML markup does the plugin use ? =

Until version 1.1, the following markup has been used: `<div style="clear: (left|right|both);"></div>`.
From version 1.2.0 on, the following markup is used: `<br style="clear: both;" />` (line breaks).
> Note: TinyMCE wrapps line breaks in paragraphs which may lead to additional margins depending on your theme. To prevent these margins paste the following in the “Custom CSS” part of the Customizer:
`p > br[style="clear: both;"]:only-child {
	content: '';
	display: block;
	margin-bottom: -1.5em;
}`
The value `1.5em` corresponds to your theme’s `margin-bottom` of `<p>` tags.

== Changelog ==

= 1.2.2 (05/25/2017) =
* Fix: Rare bug that caused TinyMCE to remove the `<br style="clear: both;" />`
* Fix: Bug that prevented the plugin from beeing [translatable](https://translate.wordpress.org/projects/wp-plugins/tinymce-clear-buttons) (finally)
* Misc: Bumped "Requires at least" to WordPress 4.6


= 1.2.1 (03/30/2017) =
* Fix: Bug that prevented the plugin from beeing [translatable](https://translate.wordpress.org/projects/wp-plugins/tinymce-clear-buttons)

= 1.2.0 (01/26/2017) =
* New maintainer; first update after seven years
* Feature: Removed clear left and clear right buttons (see [FAQ section](https://wordpress.org/plugins/tinymce-clear-buttons/#faq))
* Misc: Completely refactured plugin code

= 1.1 (05/10/2010) =
* Feature: Added HTML block in the style of WordPress

= 1.0 (04/28/2010) =
* Initial release
