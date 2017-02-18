<?php
include '/var/www/MyScripts/WattPrelCtrl/VarOld.php';
?>
<form method="post" action="formvar.php">
  TUTTI I VALORI SONO OBBLIGATORI (il valore "0" non è ammesso in nessun campo. Per inserire valori decimali usare il punto, non la virgola):<br><br>
  1 Inserisci il nome del luogo dove è attivo il monitoraggio che comparirà nell'oggetto delle email (default "Mio sito")<br>
  <input type="text" name="site" size="60" value="<?php echo $site;?>"><br><br>
  2 Inserisci il percorso completo del file temporaneo creato dalla lettura del contatore SDM per il consumo (default: /dev/shm/metern2.txt)<br>
  <input type="text" name="WattCons" size="60" value="<?php echo $WattCons;?>"><br><br>
  2a Inserisci l'id della riga realtiva alla tensione del file temporaneo creato dalla lettura del contatore SDM per il consumo (default: 2)<br>
  <input type="text" name="met_C" size="60" value="<?php echo $met_C;?>"><br><br>
  3 Inserisci il percorso completo del file temporaneo creato dalla lettura del contatore SDM per la produzione (default: /dev/shm/metern1.txt)<br>
  <input type="text" name="WattProd" size="60" value="<?php echo $WattProd;?>"><br><br>
  3a Inserisci l'id della riga realtiva alla tensione del file temporaneo creato dalla lettura del contatore SDM per la produzione (default: 1)<br>
  <input type="text" name="met_P" size="60" value="<?php echo $met_P;?>"><br><br>
  4 Inserisci i dati del server smtp che usi per inviare le email (default: smtp.gmail.com)<br>
  <input type="text" name="smtp_S" size="60" value="<?php echo $smtp_S;?>"><br><br>
  5 Inserisci la porta di ascolto del server smtp che usi per inviare le email (default: 587)<br>
  <input type="text" name="smtp_P" size="60" value="<?php echo $smtp_P;?>"><br><br>
  6 Inserisci l'indirizzo dell'account che usi per inviare le email<br>
  <input type="text" name="from_addr" size="60" value="<?php echo $from_addr;?>"><br><br>
  7 Inserisci la password dell'account che usi per inviare le email (N.B.: se si usa un'autenticazione forte tipo quella a due fattori è necessario creare una password ad hoc nel proprio account di email. Ad esempio per gmail bisogna andare alla pagina https://security.google.com/settings/security/apppasswords e crearla da lì)<br>
  <input type="text" name="pwd" size="60" value="<?php echo $pwd;?>"><br><br>
  8 Inserisci gli indirizzi email dei destinatari dei messaggi di allarme (per inserire più indirizzi utilizzare la virgola senza spazi. Ad es.: email1@email.com,email2@email.com,ecc)<br>
  <input type="text" name="to_addrs" size="60" value="<?php echo $to_addrs;?>"><br><br>
  9 Inserisci il valore in Watt sotto il quale inviare un messaggio di allarme impianto spento (default: 0 NON MODIFICABILE)<br>
  <!--input type="text" name="Sw_Off" size="60" value="<?php echo $Sw_Off;?>"><br--!><br>
  10 Inserisci il valore in Watt sotto il quale inviare un messaggio di allarme prelievo basso (default: 100)<br>
  <input type="text" name="LowW" size="60" value="<?php echo $LowW;?>"><br><br>
  11 Inserisci il valore in Watt sotto il quale inviare un messaggio di allarme prelievo alto (default: 3000)<br>
  <input type="text" name="HiW" size="60" value="<?php echo $HiW;?>"><br><br>
  12 Inserisci il valore in secondi del tempo di refresh dello script (default: 30)<br>
  <input type="text" name="lapse" size="60" value="<?php echo $lapse;?>"><br><br>
  <input type="submit" value="Salva i dati">  
  <input type="reset" value="Ripristina valori">
</form>
