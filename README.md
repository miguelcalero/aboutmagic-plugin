aboutmagic-plugin
=================

Plugin for Wordpress. It create simple people gallery from about.me profiles

## REQUISITES

0. linux server (yes)
1. curl_init library for PHP enable
2. imagemagick

## INSTALLATION

1. Install plugin as normally, from ZIP generated code or uploading to wp-content/plugins folder
2. Execute in plugin folder from console: php composer.phar install
3. Enable plugin
4. Set 777 to folder cache in plugin folder (wp-content/plugins/aboutmagic-plugin/cache)
5. Configure plugin from wp-admin, set about.me key and profiles

## FAQ

Errors, No run?

- check curl_init library
- check 777 for cache directory
