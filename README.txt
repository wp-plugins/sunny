=== Sunny (Connecting CloudFlare and WordPress) ===
Contributors: tangrufus
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=tangrufus%40gmail%2ecom&lc=HK&item_name=Sunny%20%28CloudFlare%20Management%29%20Plugin%20Donation&item_number=sunny%2edonation%2ewp%2eorg&amount=10%2e00&currency_code=USD&button_subtype=products&no_note=0&add=1&bn=PP%2dShopCartBF%3abtn_cart_LG%2egif%3aNonHostedGuest
Tags: cloudflare, cache, CDN, performance, security, spam
Requires at least: 3.6.0
Tested up to: 3.9.2
Stable tag: 1.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically clear CloudFlare cache. And, protect your WordPress site at DNS level.

== Description ==

Sunny automatically clears CloudFlare cache. And, protect your WordPress site at DNS level.

= Features =

* Blacklist IP if attempt to login with bad username, e.g.: `Admin` & `Administrator`
* Automatically clears corresponding CloudFlare caches whenever a post is updated, commented or trashed.
* Purge your entire CloudFlare cache manually
* Purge your a URL cache manually
* Test your CloudFlare API key

= How does Sunny different from CloudFlare's offical plugin? =

At the time of writting, CloudFlare's [offical plugin](https://wordpress.org/plugins/cloudflare/) doesn't purge anything for WordPress. It provides the real IP of your visitors and notify CloudFlare when you marking an IP as SPAM. However, it does not include a way to clear the cache or make adjustments to how it works. Here comes Sunny! Sunny focus on cache purging.

= Planned features =

* Blacklist an IP when WP Better Secuity lockdown it

= Things you need to know =

* You need a CloudFlare account.
* This plugin was not built by CloudFlare.

= How others talking about Sunny? =

* [Sunny: A Plugin to Automatically Clear CloudFlare Cache and Manage Settings in WordPress](http://wptavern.com/sunny-a-plugin-to-automatically-clear-cloudflare-cache-and-manage-settings-in-wordpress)


= Who make this plugin? =

[Tang Rufus](http://tangrufus.com), a freelance developer for hire.

== Installation ==

1. Download the plugin.
1. Go to the WordPress Plugin menu and activate it.
1. Go to "Settings" --> "Sunny"
1. Fill in your CloudFlare account info
1. Test it with Connection Tester (via Settings Page)
1. That's it!


== Frequently Asked Questions ==

= Is this plugin written by CloudFlare, Inc.? =

No.
Sunny is written by [Tang Rufus](http://tangrufus.com)

= Can I install both Sunny and CloudFlare's offical plugin at the same time? =

Yes.

= When should I install Sunny and CloudFlare's offical plugin at the same time? =

Install Sunny if you want to purge CloudFlare's cache automatically.
Install the offical plugin if you can't see the real IP from visitors.

= When does Sunny purge my cache? =

Every time a *published* post is updated or commented.

= What pages does it purge when a post is updated? =

The post itself, homepage and its catories, tags and taxonomies archive.
Use the URL purger in `Purger` tab to check what will be cleared for a particular URL.
You can disable this behavior via the `Settings` tab.

= What if Sunny blacklisted my IP? =

1. Login [CloudFlare](http://cloudflare.com).
2. Release you IP on the threat control dashborad.

= Dose it support mulitsite? =

Never tested. However, I am planning to written one. [Drop me a note](http://tangrufus.com/hire-rufus/) if you want early asscess.


== Screenshots ==

1. CloudFlare Account Settings & Connection Tester
1. More Settings
1. Purgers


== Changelog ==

= 1.4.0 =
* Code Rewrite & File Organization
* Ban IP if Login As `Administrator`
* Bug Fix: IP being banned twice
* Bug Fix: Admin bar always been hided

= 1.3.0 =
* Ban IP if Login As `Admin`

= 1.2.6 =
* Bug Fix

= 1.2.5 =
* Mailing List Signup Form

= 1.2.4 =
* Improve Performance

= 1.2.3 =
* Support Special Type Top Level Domains


= 1.2.2 =
* Ready for Localization
* Resovle Class 'Parent' Not Found Fatal Error

= 1.2.1 =
* Bug Fix

= 1.2.0 =
* Admin Bar Hider
* Code Rewrite
* UI Improvement
* Performance Improvement
* Remove GitHub Updater

= 1.1.1 =
* Fix Wrong Version Number

= 1.1.0 =
* Add URL Purger
* Purge Related URLs during Post Update
* Better Description and Documents

= 1.0.4 =
* Tidy Up Source Code According to WordPress Coding Standard

= 1.0.3 =
* Tidy ReadMe

= 1.0.2 =
* Add PayPal Donation Link

= 1.0.1 =
* Submit to WordPress Plugin Directory

= 1.0.0 =
Initial Release

* Add Readme.txt
* Add Screenshots

= 0.0.2 =
* Support GitHub Updater

= 0.0.1 =
* Initial Alpha Test

== Upgrade Notice ==

= 1.3.0 =
You can ban an IP with Sunny now!