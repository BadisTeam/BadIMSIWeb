#!/bin/bash
if [ "$(id -u)" != "0" ]; then
	echo "Sorry, you are not root."
	exit 1
fi
wwwfolder=/var/www/badimsiweb
sudo mkdir -p $wwwfolder/*
sudo cp -R ./* $wwwfolder/
sudo rm $wwwfolder/deploy_web.sh
sudo mv $wwwfolder/etc_apache2/badimsiweb.conf /etc/apache2/sites-available/badimsiweb.conf
sudo a2ensite badimsiweb.conf
sudo chmod +r -R $wwwfolder/ 
