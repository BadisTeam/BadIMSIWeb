#!/bin/bash

wwwfolder=/var/www/badimsiweb
echo this script require root privilege
echo commands are execuded with sudo
sudo mkdir -p $wwwfolder/*
sudo cp -R ./* $wwwfolder/
sudo rm $wwwfolder/deploy_web.sh
sudo mv $wwwfolder/etc_apache2/badimsiweb.conf /etc/apache2/sites-available/badimsiweb.conf
sudo a2ensite badimsiweb.conf
sudo chmod +r -R $wwwfolder/ 
