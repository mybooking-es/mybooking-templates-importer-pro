=== Mybooking Templates Importer ===
Contributors: juanmiqueo
Tags: import, content, demo, data, widgets, settings, redux, theme options
Requires at least: 5.2
Tested up to: 5.8
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv3 or later

Mybooking Templates Importer is a tool to importing ready to use reservation engine web site templates.

== Description ==

Mybooking Templates Importer Plugin is a tool that imports ready to use reservation websites. It makes easy to create a site with a
reservation engine for a rental, accomodation or activities companies. 

It is a utility for designers and developers that are using MyBooking Reservation Engine and Mybooking theme and want to speed up the
site creation.

This plugin is based on [One Click Demo Import](https://wordpress.org/plugins/one-click-demo-import) and it has been adapted to import 
templates to mybooking theme for rental and accommodation sites.

== Installation ==

It is necessary to install [MyBookingReservationEngine](https://wordpress.org/plugins/mybooking-reservation-engine), 
[MyBooking Theme](https://wordpress.org/themes/mybooking/) and Elementor first, because we have used it as page composer.

**From your WordPress dashboard**

1. Visit 'Plugins > Add New',
2. Search for 'MyBooking Templates Importer' and install the plugin,
3. Activate 'MyBooking Templates Importer' from your Plugins page.

**From WordPress.org**

1. Download 'MyBooking Templates Importer'.
2. Upload the 'mybooking-templates-importer' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate 'MyBooking Templates Importer' from your Plugins page.

Then in Appearance menu a new option will be shown, Mybooking Importer, that allows to import sites.

== Frequently Asked Questions ==

= How can I import via the WP-CLI? =

You can use the following WP-CLI commands:

* `wp mybooking-templates-importer list` - Which will list any predefined demo imports currently active theme might have,
* `wp mybooking-templates-importer import` - which has a few options that you can use to import the things you want (content/widgets/customizer/predefined demos). Let's look at these options below.

`wp mybooking-templates-importer import` options:

`wp mybooking-templates-importer import [--content=<file>] [--widgets=<file>] [--customizer=<file>] [--predefined=<index>]`

* `--content=<file>` - will run the content import with the WP import file specified in the `<file>` parameter,
* `--widgets=<file>` - will run the widgets import with the widgets import file specified in the `<file>` parameter,
* `--customizer=<file>` - will run the customizer settings import with the customizer import file specified in the `<file>` parameter,
* `--predefined=<index>` - will run the theme predefined import with the index of the predefined import in the `<index>` parameter (you can use the `wp mybooking-templates-importer list` command to check which index is used for each predefined demo import)

The content, widgets and customizer options can be mixed and used at the same time. If the `predefined` option is set, then it will ignore all other options and import the predefined demo data.

== Screenshots ==

1. Select template page.
2. Template Rent Standard Selector Elementor - Home
3. Template Rent Standard Selector Elementor - Contact page

== Changelog ==

= 1.0.0 =

*Release Date - 04 Setember 2021*

* Initial release!
