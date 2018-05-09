=== Fight for the Future Alerts ===
Contributors: Ipstenu
Donate link: https://ko-fi.com/A236CEN/
Tags: eff, fight for the future, cat signal, activism
Requires at least: 4.8
Tested up to: 4.9
Stable tag: 1.3.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Show Fight for the Future alerts and actions on your website.

== Description ==

This plugin shows alerts from [Fight for the Future](https://fightforthefuture.org) on your WordPress site. You can show a modal windows for a specific day of action, or an event (some on ongoing).

**I do not support issues with the modals themselves!** If the javascript is loaded on your page, regardless of how wonky it looks, then the plugin works. If the boxes look black or cause weird errors, you'll have to take it up with Fight for the Future directly.

If you just want to use the Cat Signal, I recommend the [Cat Signal plugin](https://wordpress.org/plugins/cat-signal).

=== Pick your Battles ===

* [Cat Signal](https://www.internetdefenseleague.org) -- This will disable all others
* [Blackout Congress](https://blackoutcongress.org)
* [Battle for the Net](https://battleforthenet.com)
* [Break the Internet](https://www.battleforthenet.com/breaktheinternet/)
* [Red Alert for Net Neutrality](https://www.battleforthenet.com/redalert/)

=== Privacy Policy ===

By using this plugin, you load javascript remotely from [Fight for the Future](https://fightforthefuture.org). Please review [their official privacy policy](https://www.fightforthefuture.org/privacy/) for details.

== Installation ==

After installation:

1. Go to Tools -> FFTF
2. Select which battles you wish to wage

== Frequently Asked Questions ==

= Are you the official plugin? =

No, this is something I made for myself.

= The Cat Signal isn't an event. How does that work? =

The Cat Signal, by [the Internet Defense League](https://www.internetdefenseleague.org), automatically triggers whatever current issue is running. It's there for people who just want to run this all the time.

= If I pick Cat Signal, why can't I pick anything else? =

Because that would cause you to load scripts multiple times. If you pick Cat Signal, it de-selects everything else and only lets you use that.

= I picked the Cat Signal but it's not showing my event. =

Sometimes their servers get overloaded. When that happens, pick the specific event you're targeting _instead_ of the Cat Signal to force it.

= Can I test it? =

Some, yes.

* Blackout Congress - Enable `WP_DEBUG` on your site to show the modal to everyone
* Battle for the Net - Add `#ALWAYS_SHOW_BFTN_WIDGET` to the end of your URL to see the modal

= Will you add more fights? =

I plan to.

= Will this work on all websites? =

Probably not. If you have a ton of javascript, it may have issues.

= Why is the javascript is doing weird things? =

I can't help people debug why the javascript isn't working properly. If you view your page source and the code is there, then my job is done and you'll need to talk directly to Fight for the Future. Go to the linked page for the fight. They have 'more information' links on those pages and you can file an issue.

Sorry, but I have to spend my time fighting with my congresscritter. He's really annoying.

== Changelog ==

= 1.3.0 =
* December 2017
* [Break the Internet](https://www.battleforthenet.com/breaktheinternet/)

=1.2.1=
* November 2017
* Spaces and tabs
* Removing unused code

=1.2.0=
* November 2017
* Removed date/time check because the Cat Signal redirect sometimes breaks. Props @macmanx