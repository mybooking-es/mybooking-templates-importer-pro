# README

Mybooking Importer Plugin is a tool for importing Mybooking demo content and complete base sites into a new fresh WordPress installation. Is for internal use of Mybooking staff but you can use it under your responsability.

## Description

*Version 1.1*

Mybooking Importer Plugin is a fork of One Click Demo Import plugin created to speed up site developement based on Mybooking demos. We mantained both license and authorship and only did some minor additions: some text strings and a new file at /inc folder that contains demo file's URLs.

The new file is **/inc/DemoContentList.php** and contains the function that calls the files needed by demos. Is so simple and is the only file to update in order to add new demos.

## Installation

* Donwload this repo as a .zip file and rename it
* Upload like a normal plugin

## Importing contents to a new site

*IMPORTANT*

Before importing a demo be sure that:
* You are using a fresh WordPress install or you will get duplication issues
* You have same plugins and theme that demo or it will break your site

After you meet the requeriments go to Aperance/Mybooking Importer on your WordPress dashboard and follow the instructions.

## Adding a new demo

First of all clone this repo to your machine.

To add a new demo site to the plugin you need to have a demo site
somewhere and generate the importing files.

1- Login to the demo you want to add and generate the importing files. These files we use three plugins that you need to install on such demo site:

* The native WordPress Importer Plugin, hat generates the content .xml file
* Customizer Export/Import plugin taht creates a .dat file
* Widget Importer & Exporter generates a .wie file (should be renamed as .json)

You need also to create a preview.png image file to show in plugin's demo list.

2- Once you have generated the importing files and the preview image you might to upload somewhere or pack in a zip.

3- Now update /inc/DemoContentList.php file and add a new block of code containing the new demo URLs:
```
array(
  'import_file_name'           => 'Demo Name', // The name of the demo
  'categories'                 => array( 'Category name' ), // Category tab where you want to show
  'import_file_url'            => 'https://somedomain.com/demo-name/content.xml', // Content file URL
  'import_widget_file_url'     => 'https://somedomain.com/demo-name/widgets.json', // Widgets file URL
  'import_customizer_file_url' => 'https://somedomain.com/demo-name/customizer.dat', // Customizer settings file URL
  'import_preview_image_url'   => 'https://somedomain.com/demo-name/preview.png', // Preview image URL
  'import_notice'              => __( 'Text message or advice', 'mybooking' ), // Message shown before start importing
  'preview_url'                => 'https://demodomain.com', // Demo URL
),
```

Please, mantain file names for consistency, just change demo-name, Demo Name and demodomain.
