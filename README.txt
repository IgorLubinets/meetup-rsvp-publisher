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
 
IMPORTANT NOTE:
This plugin is a very bare-bones version of what I had in mind initially.  So if it is missing something, it is only because I am limited on time.  Please submit your suggestions to me and if they are going to benefit the plugin, I will definitely include them in the future releases.



== Installation ==

In order to install this plugin, click the Clone or Download green button above.  I would recommend downloading it as a zip file and then activating it through the Plugins menu in WordPress. 

Navigate to Plugins -> Add New -> Upload Plugin

In order to use the plugin in WordPress, just go to the Shortcode Builder tab and after going through the builder, copy and paste it in the area that you want. 

e.g.

[meetup-rsvp-publisher /] will show all the rsvps with the default settings

If you want to limit which meetups will be displayed, you have to use the Shortcode Builder or do it manually:

e.g.
[meetup-rsvp-publisher show="all" hideGroups="12345 67890" display="slider" /] will give show all meetups except the ones from group id #12345 and #67890

e.g.
[meetup-rsvp-publisher hide="all" showGroups="12345 67890" /] will hide all meetups, but the ones belonging to groups #12345 and #67890

e.g.
[meetup-rsvp-publisher hide="all" showGroups="12345 67890" display="list" /] will do the same as above, only it will override the default display setting (under Settings tab) 




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
