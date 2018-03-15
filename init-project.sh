#!/bin/sh

sass application/sass/site.scss:application/web/css/site.css
rm -rf application/web/css/*.css.map
