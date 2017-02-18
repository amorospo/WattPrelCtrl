#!/usr/bin/python

# Electric consumption alarm system 

####################################################################################
#### Author: Alessandro Botta - amorospo@yahoo.it				####
####################################################################################

import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import linecache
import time
import os
from Variabili_WattPrelCTRL import *

def send_msg():
        server = smtplib.SMTP(smtp_S, smtp_P)    
        server.ehlo()
        server.starttls()
        server.login(from_addr, pwd)
        msg = MIMEMultipart()
        msg['From'] = from_addr
        msg['To'] = to_addrs
        msg['Subject'] = "%s - %s" % (site, msg_sbj)              
        msg.attach(MIMEText(msg_obj))
        time.sleep(1)
        server.sendmail(from_addr, to_addrs.split(','), msg.as_string())
        server.quit()
        time.sleep(lapse)                                 

def chk():
        linecache.checkcache(WattCons)
        linecache.checkcache(WattProd)

#Let MeterN write first data
time.sleep(10)
file_C = linecache.getline(WattCons,1)
file_P = linecache.getline(WattProd,1)

# Loop starts
while file_C.startswith(met_C) and file_P.startswith(met_P) is True:

	# Reading files and data
       	WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
       	WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
	time.sleep(0.2)
	WattPrel_num = WattProd_num - WattCons_num
	time.sleep(1)
       	chk()
        time.sleep(1)

	#Routine in case of SWITCH OFF
	if WattCons_num == Sw_Off:
        	msg_sbj = 'SWITCH OFF'		#Email subject
               	msg_obj = ('No current comsumption. Whitdrawal is now: {0:0.1f} Watt'.format(WattCons_num))	#Email text
		send_msg()
		while True: 
			if WattCons_num == Sw_Off:
                       		time.sleep(5)
				WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
				chk()
			else:
				#routine Power Outage end
				if WattPrel_num < HiW and WattPrel_num > LowW:	
		        		msg_sbj = 'SWITCH OFF ALARM ENDS'		#Email subject
                			msg_obj = ('Alarm ends. Power is up! Whitdrawal is now: {0:0.1f} Watt'.format(WattPrel_num))	#Email text
					send_msg()
					break
				else:
					time.sleep(2)
					WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
        				WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
				        time.sleep(0.2)
				        WattPrel_num = WattProd_num - WattCons_num
					chk()
                       	        	break

	#routine Low Whitdrawal alarm
	elif WattPrel_num > Sw_Off and WattPrel_num <= LowW:	
        	msg_sbj = 'Whitdrawal anomaly'			#Email subject
               	msg_obj = ('Warning! Whitdrawal is too low : {0:0.1f} Watt'.format(WattPrel_num))	#Email text
		send_msg()
		while True:
   	   		if WattPrel_num > Sw_Off and WattPrel_num <= LowW:				
	               		time.sleep(5)
				WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
        			WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
			        time.sleep(0.2)
			        WattPrel_num = WattProd_num - WattCons_num
				chk()
                        else:	
				#routine Low Whitdrawal alarm end
				if WattPrel_num < HiW and WattPrel_num > LowW:
                           		msg_sbj = 'Whitdrawal anomaly ends'		#Email subject
                                       	msg_obj = ('Anomaly ends. Whitdrawal is OK: {0:0.1f} Watt'.format(WattPrel_num))	#Email text
					send_msg()
                              		break
				else:
					time.sleep(2)
					WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
        				WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
        				time.sleep(0.2)
				        WattPrel_num = WattProd_num - WattCons_num
					chk()
                                       	break
	
	#routine High Whitdrawal alarm
	elif WattPrel_num >= HiW:
        	msg_sbj = 'Whitdrawal anomaly'			#Email subject
               	msg_obj = ('Warning! Whitdrawal is too high: {0:0.1f} Watt'.format(WattPrel_num))	#Email text
		send_msg()
		while True:
  			if WattPrel_num >= HiW:
				time.sleep(5)
				WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
        			WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
        			time.sleep(0.2)
			        WattPrel_num = WattProd_num - WattCons_num
				chk()
                        else:
				#routine High Whitdrawal alarm end
				if WattPrel_num < HiW and WattPrel_num > LowW:	
                               		msg_sbj = 'Whitdrawal anomaly ends'		#Email subject
             	                    	msg_obj = ('Anomaly ends. Whitdrawal is OK: {0:0.1f} Watt'.format(WattPrel_num))	#Email text
					send_msg()
                              		break
				else:
					time.sleep(2)
					WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
				        WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
				        time.sleep(0.2)
				        WattPrel_num = WattProd_num - WattCons_num
					chk()
	                               	break

	#Routine normal Whitdrawal
	else:	
		time.sleep(lapse)
		WattCons_num = float((linecache.getline(WattCons,1)).replace((''.join([met_C,"("]))," ").replace("*W)"," ").strip())
        	WattProd_num = float((linecache.getline(WattProd,1)).replace((''.join([met_P,"("]))," ").replace("*W)"," ").strip())
        	time.sleep(0.2)
	        WattPrel_num = WattProd_num - WattCons_num
		chk()

#Routine reading file error
else:	
	msg_sbj = 'Whitdrawal control fatal error'                #Email subject
       	msg_obj = ('Error reading files %s, %s. No usuful data to process' % (WattCons, WattProd))       #Email text
       	send_msg()
	while True:
		if file_C.startswith(met_C) and file_P.startswith(met_P) is False:	
			file_C = linecache.getline(WattCons,1)
			file_P = linecache.getline(WattProd,1)
			chk()
    			time.sleep(5)
		else:
			execfile(os.path.realpath(__file__))
