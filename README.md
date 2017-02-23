# WattPrelCtrl
Electric power withdrawal monitoring

Sistema di monitoraggio del prelievo elettrico tramite invio di avvisi e allarmi via email. Basato sull'utilizzo di meterN e contatori SDM.

Topic di riferimento: http://www.flanesi.it/forum/viewtopic.php?f=4&t=1916
*******************************************************************************************************************
N.B.: 
Prima di installare e far partire lo script bisogna settare meterN per creare anche il file temporaneo della produzione istantanea oltre a quello già creato dei consumi istantanei. Per farlo basta editare il file /var/www/comapps/pool123s.php aggiungendo verso la fine dello stesso la riga:

file_put_contents("/dev/shm/prodpower$METERID.txt", "$METERID($GP*W\n");<br><br>
tra la riga______________________: if ($argv[1] == 'power') {<br>
e la riga________________________: echo "$METERID($GP*W)\n";<br><br>
Per installare lo script:

sudo -s<br>
cd /var/www/MyScripts<br>
git clone https://github.com/amorospo/WattPrelCtrl.git<br>
mv WattPrelCtrl/WattPrelCtrl.service /etc/systemd/system/WattPrelCtrl.service<br>
chmod -R 755 WattPrelCtrl<br>
chown -R www-data:www-data WattPrelCtrl<br>

Una volta installato per prima cosa occorre modificare le variabili a proprio uso e consumo accedendo alla pagina web:<br>
http://localhost/MyScripts/WattPrelCtrl/Modulo.php<br>
e seguire le istruzioni a video

Successivamente bisogna abilitare e far partire il servizio all'avvio del sistema:

sudo systemctl enable WattPrelCtrl<br>
sudo systemctl start WattPrelCtrl<br>

e poi un bel riavvio del sistema (non necessario, giusto per vedere se tutto funziona al riavvio)

shutdown -r now<br>

*******************************************************************************************************************
Al riavvio controlliamo il service se viene caricato e funziona correttamente.

sudo service WattPrelCtrl status

l'output dovrebbe essere qualcosa del genere:

● WattPrelCtrl.service - Electric power consumption monitoring<br>
   Loaded: loaded (/etc/systemd/system/WattPrelCtrl.service; enabled)<br>
   Active: active (running) since lun 2017-02-13 11:03:55 CET; 1s ago<br>
 Main PID: 26322 (StartService.sh)<br>
   CGroup: /system.slice/WattPrelCtrl.service<br>
           ├─26322 /bin/sh /var/www/MyScripts/WattPrelCtrl/StartService.sh<br>
           ├─26330 python /var/www/MyScripts/WattPrelCtrl/ChkVar.py<br>
           └─26331 python /var/www/MyScripts/WattPrelCtrl/WattPrelCTRL.py<br>

feb 13 11:03:55 raspberrypi systemd[1]: Started Electric power consumption monitoring.

