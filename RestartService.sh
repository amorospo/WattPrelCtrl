#! /bin/sh

sudo rm /var/www/MyScripts/WattPrelCtrl/chkvar.txt
sleep 1
sudo service WattPrelCtrl restart
sleep 1
