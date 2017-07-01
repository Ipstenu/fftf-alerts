=== Fight for the Future Alerts ===
Contributors: Ipstenu
Donate link: https://store.halfelf.org/donate/
Tags: eff, fight for the future, cat signal, activism
Requires at least: 4.8
Tested up to: 4.8
Stable tag: 1.0.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Show Fight for the Future alerts and actions on your website.

== Description ==

This plugin shows alerts from [Fight for the Future](https://fightforthefuture.org) on your WordPress site.

You can show a modal windows for a specific day of action.

**I do not support issues with the modals themselves!** If the javascript is loaded on your page, regardless of how wonky it looks, then the plugin works. If the boxes look back or cause weird errors, you'll have to take it up with Fight for the Future directly.

=== Pick your Battles ===

* [Blackout Congress (ongoing)](https://blackoutcongress.org)
* [Battle for the Net (2017 July 12)](https://battleforthenet.com)

== Installation ==

After installation:

1. Go to Tools -> FFTF
2. Select which battles you wish to wage

== Frequently Asked Questions ==

= Are you the official plugin? =

No, this is something I made for myself.

= Can I test it? =

Yes.

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

= 1.0.1 =
* June 30, 2017
* Hopefully temporary patch for [#19 Mixed content error](https://github.com/fightforthefuture/battleforthenet-widget/issues/19)

= 1.0.0 =
* June 30, 2017
* Initial Release