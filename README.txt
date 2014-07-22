=== Sunny ===
Contributors: tangrufus
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=tangrufus%40gmail%2ecom&lc=HK&item_name=Sunny%20%28CloudFlare%20Management%29%20Plugin%20Donation&item_number=sunny%2edonation%2ewp%2eorg&amount=10%2e00&currency_code=USD&button_subtype=products&no_note=0&add=1&bn=PP%2dShopCartBF%3abtn_cart_LG%2egif%3aNonHostedGuest
Tags: cloudflare, cache, CDN, performance
Requires at least: 3.8.0
Tested up to: 3.9.1
Stable tag: 1.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically clear CloudFlare cache. And, manage your CloudFlare settings within WordPress.

== Description ==

Sunny automatically clears CloudFlare cache. And, manage your CloudFlare settings within WordPress (Comming Soon).

= How does Sunny different from CloudFlare's [offical plugin](https://wordpress.org/plugins/cloudflare/)? =

At the time of writting, CloudFlare's [offical plugin](https://wordpress.org/plugins/cloudflare/) doesn't purge anything for WordPress. It provides the real IP of your visitors and notify CloudFlare when you marking an IP as SPAM. However, it does not include a way to clear the cache or make adjustments to how it works. Here comes Sunny! Sunny focus on cache purging.

Features:

* Automatically clears corresponding CloudFlare cache whenever a post is updated.
* Purge your entire CloudFlare cache manually
* Test your CloudFlare API key

Planned features:

* Purge homepage, tag pages and category pages cache during post update.
* Purge images during post update.
* Turn on develop mode when login
* Purge CloudFlare when Super Cache purge
* Blacklist an IP when WP Better Secuity lockdown it

Things you need to know:

* You need a CloudFlare account.
* This plugin was not built by CloudFlare.

Who make this plugin:

[Tang Rufus](http://tangrufus.com), a freelance developer for hire.

== Installation ==

1. Download the plugin.
1. Go to the WordPress Plugin menu and activate it.
1. Go to "Settings" --> "Sunny"
1. Fill in your CloudFlare account info
1. That's it!


== Frequently Asked Questions ==

= Is this plugin written by CloudFlare, Inc.? =

No.
Sunny is written by [Tang Rufus](http://tangrufus.com)

= Can I install Sunny and CloudFlare's [offical plugin](https://wordpress.org/plugins/cloudflare/) at the same time? =

Yes.

= When should I install Sunny and CloudFlare's [offical plugin](https://wordpress.org/plugins/cloudflare/) at the same time? =

Install Sunny if you want to purge CloudFlare cache automatically.
Install the offical plugin if you can't see the real IP from visitors.

= When does Sunny purge my cache? =

Every time a *published* post is updated.

= What page does it purge when a post is updated? =

So far, only the post itself.
See planned features on the Description section.

= Dose it support mulitsite? =

Never tested. However, I am is planning to written one. [Drop me a note](http://tangrufus.com/hire-rufus/) if you want early asscess.


== Screenshots ==

1. Sunny Settings Page


== Changelog ==


= 1.1.0 =
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
Use the Connection Tester on Sunny settings page.