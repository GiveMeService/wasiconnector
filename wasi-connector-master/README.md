# Wasi Connector #
**Tested up to:** 5.7.2

Plugin that allows you to connect and display a list of real estate properties from Wasi.co

## Description ##

This plugin allows a WordPress website to connect to the [https://wasi.co]() API and turn it into a specialized website to offer real estate.

For this you need to have an account in Wasi and obtain the "API Credentials" in the menu "Configuration > General Settings", if you do not find how to generate them please contact us at [support@wasi.co]()

This plugin is not made directly by Wasi, it is an external contribution to help other programmers to connect Wasi to websites with Wordpress, so it does not have support from Wasi.


## Installation ##

1. Upload the plugin `wasi-connector` to the folder `/wp-content/plugins/`
2. Activate the plugin through the `Plugins` side menu in WordPress
3. **Create the pages for**: Complete list of properties and for a single Property
4. In these pages add the necessary shortcodes (See shortcodes section)
5. In the Settings menu, go to Wasi settings and configure all the values.


## API Key Configuration ##

In the "Settings" menu, go to the "Wasi.co API" submenu and save the two main values there: ID Company and Wasi Token. Both must be generated from your own Wasi account in the menu "Configuration> General Settings".

You can learn more about the API here: [https://api.wasi.co/guide/es/first_steps/access.html]()


## Main plugin settings ##

In the WP menu of Settings, submenu of `API Wasi.co`, in addition to the API, there are the following settings:

- The numerical value of the total properties to show for each page when there are search results.

- A drop-down list that allows you to define which page will be where the complete list of properties and search results will be displayed. This page must be created previously and must have in its content the shortcode `[wasi-properties]` (See shortcode configurations).

- Another list of pages to select the page in charge of displaying the information of each property independently. The content of this page will be completely ignored and the property information passed from the property list will be displayed.
- A checkbox to allow you to select if you want to load the “Bootstrap 3.6” graphic library, which contains the graphic classes necessary to display the plugin layout correctly. Activate this option only if your template / theme does not already have this graphic library active by default.
- The duration (in days) of the plugin's temporary cache. By default it comes from 1 days, but it can change to a value between 1 and 365. This will take effect only if after saving the value, the cache is cleared with the "Clear Plugin Cache" button to delete the current data and refresh all the cache.

## Shortcodes and Widgets Settings ##

The plugin has several important shortcodes and widgets for its operation. The most important ones are the shortcode to show the properties and the shortcode or widget to show the property search engine. Below are the details of each one.


### Property shortcode ###

The most important is the shortcode `[wasi-properties]` which is in charge of displaying the complete list of wasi properties. This shortcode has several customization attributes that allow you to modify its add filters and modify its layout.
Example: `[wasi-properties layout="grid" featured="true" limit="9" btn-class="search-btn" tags-bg-color="#db2723"]`

### Search shortcode ###
btype: "for_rent", "for_sale", "for_tranfer"

Example:
`[wasi-search formClass="row" submitClass="btn btn-primary" filtro="keyword,btype,type,bedrooms,bathrooms,country,region,city,zone,prange,arange" countries="CO,USA" btype="for_rent"]`


Estos atributos son:

These attributes are:

**- layout**: which can be "list" or "grid" (the grid is always 3 columns). By default it is type "list"

**- featured**: which can be "true" or "false". It is used to show only the properties marked as featured. By default it is false.

**- limit**: It is optional, it defines how many properties it will show. The default value to apply is the one defined in the initial settings of the plugin (Initially 10)

**- btn-class**: Defines the CSS class that will be applied to the more information button. By default it is "btn btn-primary" (which are the classes compatible by default with Bootstrap) If any theme wants to change it as in the example, it can do so.

**- tags-bg-color**: Defines the background color of the tags above the image when using the grid type layout. If you don't wear anything, the default is wasi blue: # 194C9A


### Shortcode and Widget for Search Engine ###

The property search can be shown through a Widget or through a shortcode on a separate page. Both the Widget and the shortcode contain the same attributes:

**- formClass**: CSS class that is applied to the main form to control its layout. By default: "row"

**- submitClass**: CSS class that is applied to the search button. By default: "btn btn-primary"

The most recommended way to display the search engine is through a widget in some sidebar of the theme.

### Widget for the Contact form ###

Cada propiedad tiene un formulario de contacto propio. El cual permite que los visitantes diligencien un formulario y sus datos sean asignados al Agente Inmobiliario a cargo de la propiedad, además de que le llegará un e-mail con la respectiva notificación.
Este widget cuenta con los mismos atributos del widget del buscador:

**- formClass:** Clase CSS que se aplica al formulario principal para controlar su layout. Por defecto: “row”  
**- submitClass:** Clase CSS que se aplica al botón de búsqueda. Por defecto: “btn btn-primary”

## Sobreescribir plantilla de Detalles de Propiedad ##

One of the advanced options of the plugin is to allow the editing of the property details view template. This can be done by creating a new file in the root of the theme and calling `itsingle-property-wasi.php`

The HTML content of this file must be copied from the plugin's own template found in the file `public/views/single-property.php` inside the plugin's folder. The modifications that are made in the file copied in the theme will be read and will be used instead of the default view of the plugin.

## Plugin translation ##

By default the plugin comes in English, but it has the string template and all the support to add any language, either through a plugin or with a string editing program.

The most recommended method of translating this plugin is to use a translation plugin. The most recommended is Loco Translate ( https://wordpress.org/plugins/loco-translate/ ). When installing this plugin, the Wasi plugin will be active in the plugins section to be translated. There you can see all the text strings and add the necessary translations for each one.

## Changelog ##

### 1.0 ###
* Initial version

