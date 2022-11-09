# README

Mybooking Templates Importer Plugin is a tool that imports ready to use reservation websites. It makes easy to create a site with a
reservation engine for a rental, accomodation or activities companies. 

It is a utility for designers and developers that are using MyBooking Reservation Engine and Mybooking theme and want to speed up the
site creation.

This plugin is based on [One Click Demo Import](https://wordpress.org/plugins/one-click-demo-import) and it has been adapted to import 
templates to mybooking theme for rental and accommodation sites.

## Description

*Version 1.0*

The **/inc/MyBookingTemplateSites.php** contains the function that calls the files needed to import a site. 

## Installation

* Donwload this repo as a .zip file
* Upload like a normal plugin

## Importing contents to a new site

*IMPORTANT*

Before importing a demo be sure that:
* You are using a fresh WordPress install or you will get duplication issues
* You have to install Mybooking theme, Mybooking Reservation Engine and Elementor Plugin

After you meet the requeriments go to Aperance/Mybooking Importer on your WordPress dashboard and follow the instructions.

## Adding a new template

First of all clone this repo to your machine.

To add a new site template to the plugin you need to have a site somewhere and generate the importing files.

1- Login to the demo you want to add and generate the importing files. These files we use three plugins that you need to install on such demo site:

* The native WordPress Importer Plugin, hat generates the content .xml file
* Customizer Export/Import plugin taht creates a .dat file
* Widget Importer & Exporter generates a .wie file (can be renamed as .json)

You need also to create a preview.png image file to show in plugin's demo list.

2- Once you have generated the importing files and the preview image you might to upload somewhere.

3- Now update /inc/MyBookingTemplateSites.php file and add a new block of code containing the new demo URLs:
```
    array(
      'import_file_name'             => 'TEMPLATE', // The name of the site template
      'categories'                   => array( 'CATEGORY' ), // Category tab where you want to show
      'local_import_file'            => trailingslashit(plugin_dir_path( __DIR__ ) ).'templates/my-template/content.xml', // Content file URL
      'local_import_widget_file'     => trailingslashit(plugin_dir_path( __DIR__ ) ).'templates/my-template/widgets.json', // Widgets file URL
      'local_import_customizer_file' => trailingslashit(plugin_dir_path( __DIR__ ) ).'templates/my-template/customizer.dat', // Customizer settings file URL
      'import_preview_image_url'     => plugin_dir_url(__DIR__).'templates/my-template/preview.png', // Preview image URL
      'import_notice'                => __( 'My Template', 'mybooking-templates-importer' ), // Message shown before start importing
      'preview_url'                  => 'https://demo-url.com' // Demo URL
    )
```

Please, mantain file names for consistency, just change templates folder name.
