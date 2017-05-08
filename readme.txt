=== ESO Widgets ===
Tags: elder scrolls, eso, widgets, elder scrolls online, skyrim
Requires at least: 3.0.0
Tested up to: 4.7.4
Stable tag: 1.1
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

ESO Widgets enables ingame-like tooltips and skill bars for Elder Scrolls Online on your site.

== Description ==

Are you producing content for Elder Scrolls Online? With ESO Widgets you can add ingame-like skill and set tooltips directly into your site! For build guides you can show whole skill bars with tooltips in your posts.

= Embedding builds / skill bars =

1. Plan your build with this <a href="http://www.elderscrollsbote.de/planer/">Build Planner</a>.
2. Copy the url and paste it into a single line in your editor (like you would to embed a YouTube video).
3. Done. You should see the skill bars as a preview in your visual editor, too.

Please make sure to paste the url in a new line and don't make it clickable in your editor. Check the screenshot section for an example.

= Adding skill tooltips =

This plugin adds the tooltip script used on <a href="http://www.elderscrollsbote.de">ElderScrollsBote.de</a> to your site. The script is loaded asynchronously and is very lightweight. It has no dependencies like jQuery.

The tooltip script detects every link to a skill from the database of ElderScrollsBote.de and shows the corresponding tooltip on mouseover. To find the url to a specific skill you can use the search form <a href="http://www.elderscrollsbote.de/skills/">here</a>.

= Adding set tooltips =

It's exactly the same as skill tooltips. Every link to a set is detected and shows a tooltip on mouse over. To find the url to a specific set you can use the search form <a href="http://www.elderscrollsbote.de/sets/">here</a>.

= How to open links from skill bars in new tabs? =

To be able to show skill tooltips for your skill bars the widget has to add a link to the specific skill. You can force these links to open in new tabs by adding this snippet to the functions.php of your theme:

add_filter( 'eso_widgets_open_in_new_tabs', '__return_true' );

= Is this in German? =

All data is available in English and German. The script detects the browser language and shows all tooltips in English by default. You can set localStorage.lang to "en" or "de" to force a specific language on your site, but this shouldn't be neccessary.

== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'ESO Widgets'
3. Activate ESO Widgets from your plugins overview.

= From WordPress.org =

1. Download ESO Widgets.
2. Upload the 'eso-widgets' directory to your '/wp-content/plugins/' directory.
3. Activate ESO Widgets from your plugins overview.

== Screenshots ==

Just paste the URL to a <a href="http://www.elderscrollsbote.de/planer/">build planned with this tool</a> into your editor and suprise your visitors with nice skill bars and tooltips directly on your site!

== Changelog ==

= 1.1 =

Release Date: Mai 8th, 2017

* Providing a filter to force all links from skill bars to open in new tabs.
* The widget now shows the distribution of armor (e.g. 5/1/1) and attribute points (eg. 60/4/0) if available.

= 1.0 =

Release Date: April 21th, 2017

* Initial release.