#!/bin/sh
clear

echo "Flat-File Markdown Server Installation/Creation Tool";
npm install -g bower
bower install
npm install marked --save
sudo mkdir /opt/md2html_jn/cache/
sudo cp config.sample.ini /opt/md2html_jn/cache/config.ini
echo "Modify that sample file with the appropriate settings to configure your site."
