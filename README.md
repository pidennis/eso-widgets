_ESO Widgets_ is a WordPress plugin that allows you to add skill and set tooltips from **Elder Scrolls Online** to your site. Additionally you can embed complete skill builds with tooltips directly into your posts. Check <a href="https://ps.w.org/eso-widgets/assets/screenshot-1.png">this screnshot</a> as an example.

**How embedding builds / skill bars work**

1. Plan your build with this <a href="http://www.elderscrollsbote.de/planer/">Build Planner</a>.
2. Copy the url and paste it into a single line in your editor (like you would to embed a YouTube-Video).
3. Done. You should see the skill bars as a preview in your visual editor, too.

Please make sure to paste the url in a new line and don't convert it to a link.

**How skill tooltips work**

This plugin adds the tooltip script used on <a href="http://www.elderscrollsbote.de">ElderScrollsBote.de</a> to your site. The script is loaded asynchronously and is very lightweight (it has no dependencies like jQuery).

The tooltip script detects every link to a skill from the database of ElderScrollsBote.de and shows the corresponding tooltip on mouseover. To find the url to a specific skill you can use the search form <a href="http://www.elderscrollsbote.de/skills/">here</a>.

**How set tooltips work**

It's exactly the same as skill tooltips. Every link to a set is detected and shows a tooltip on mouse over. To find the url to a specific set you can use the search form <a href="http://www.elderscrollsbote.de/sets/">here</a>.

**Is this in German?**

All data is available in English and German. The script detects the browser language and shows all tooltips in English by default. You can set localStorage.lang to "en" or "de" to force a specific language on your site, but this shouldn't be neccessary.