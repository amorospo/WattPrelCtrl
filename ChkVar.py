#!/usr/bin/python

# Checking for variables changes 

####################################################################################
#### Author: Alessandro Botta - amorospo@yahoo.it                               ####
####################################################################################

import linecache
import time
import subprocess

while True:

	chk_var_file = linecache.getline("/var/www/MyScripts/WattPrelCtrl/chkvar.txt",1)

	if chk_var_file.startswith("This file is created just to let php restart WattPrelCtrl service") is True:
		subprocess.call("/var/www/MyScripts/WattPrelCtrl/RestartService.sh", shell=True)
		linecache.clearcache()
	else:
		linecache.clearcache()
		time.sleep(59)
