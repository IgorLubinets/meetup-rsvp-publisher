=== Plugin Name ===
Contributors: Igor Lubinets 
Donate link: http://igorcodes.com
Tags: meetup.com meetup rsvp publish events
Requires at least: 4.6.1
Tested up to: 4.6.1 
Stable tag: 4.6?
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows Meetup.com members to easily publish their RSVPed events for public consumption on their websites.

== Description ==

Meetup RSVP Publisher is a shortcode-based plugin.  It lets you pick meetup events that you want displayed by
selecting meetup groups.  At this time you cannot choose specific meetups, only their groups.  Individual meetups selection will be present in the future versions. 

The user is required to obtain an API key from the meetup.com in order for this to work.  You can do so by going to [this link](https://secure.meetup.com/meetup_api/key/)

Once you created your shortcode, you can use it anywhere shortcodes can be used.  The shortcode is replaced with HMTL containing your meetup info.

There is a handy builder for those that are not tech savvy.  If you can cut and paste, you can use this plugin.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `meetup-rsvp-publisher.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= BETA =
* Requires CURL to be installed.  wp_remote_get will be used in production 
*  

== Upgrade Notice ==


== Arbitrary section ==

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
