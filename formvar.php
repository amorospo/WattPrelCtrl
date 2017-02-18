<?php
// Recupero i valori inseriti nel form
$site = $_POST['site'];
$WattCons = $_POST['WattCons'];
$met_C = $_POST['met_C'];
$WattProd = $_POST['WattProd'];
$met_P = $_POST['met_P'];
$smtp_S = $_POST['smtp_S'];
$smtp_P = $_POST['smtp_P'];
$from_addr = $_POST['from_addr'];
$pwd = $_POST['pwd'];
$to_addrs = $_POST['to_addrs'];
$Sw_Off = "0";
$LowW = $_POST['LowW'];
$HiW = $_POST['HiW'];
$lapse = $_POST['lapse'];

// verifico che tutti i cWattPreli siano stati compilati
if (!$site || !$WattCons || !$met_C || !$WattProd || !$met_P || !$smtp_S || !$smtp_P || !$from_addr || !$pwd || !$to_addrs || !$LowW || !$HiW || !$lapse) {
  echo 'Tutti i campi del modulo sono obbligatori!'; 
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e compila i campi vuoti</a>";
}
// verifico che i campi compilati non contengano caratteri nocivi
elseif (!preg_match('/^[A-Za-z0-9_.,@ \'-]+$/i',$site)) {
  echo 'il primo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
//elseif (!preg_match('/^[A-Za-z0-9_. \'-]+$/i',$WattCons)) {
//  echo 'il secondo campo contiene caratteri non ammessi';
//}
elseif (!preg_match('/^[A-Za-z0-9_., \'-]+$/i',$met_C)) {
  echo 'il secondo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
//elseif (!preg_match('/^[A-Za-z0-9_. \'-]+$/i',$WattProd)) {
//  echo 'il secondo campo contiene caratteri non ammessi';
//}
elseif (!preg_match('/^[A-Za-z0-9_., \'-]+$/i',$met_P)) {
  echo 'il terzo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_., \'-]+$/i',$smtp_S)) {
  echo 'il quarto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9 \'-]+$/i',$smtp_P)) {
  echo 'il quinto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[A-Za-z0-9_.@, \'-]+$/i',$from_addr)) {
  echo 'il sesto campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
//elseif (!preg_match('/^[A-Za-z0-9_.@, \'-]+$/i',$pwd)) {
//  echo 'il settimo campo contiene caratteri non ammessi';
//  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
//}
elseif (!preg_match('/^[A-Za-z0-9_.,@ \'-]+$/i',$to_addrs)) {
  echo 'il ottavo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
//elseif (!preg_match('/^[0-9. \'-]+$/i',$Sw_Off)) {
//  echo 'il nono campo contiene caratteri non ammessi';
//  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
//}
elseif (!preg_match('/^[0-9. \'-]+$/i',$LowW)) {
  echo 'il decimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9. \'-]+$/i',$HiW)) {
  echo 'il undicesimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}
elseif (!preg_match('/^[0-9. \'-]+$/i',$lapse)) {
  echo 'il dodicesimo campo contiene caratteri non ammessi';
  echo "<br><a href=\"javascript:history.go(-1)\">Torna indietro e correggi i dati immessi</a>";
}else{

//controllo che il file sia accessibile
if (!$apriw = fopen ("Variabili_WattPrelCTRL.py","w+")) {
echo 'Impossibile accedere al file di configurazione. <br><a href=\"javascript:history.go(-1)\">Controlla le impostazione del server e reinvia il modulo</a>';
}else{
$apriw = fopen ("Variabili_WattPrelCTRL.py","w+");

// Scrivo il file con le variabile che leggerà lo script
fputs($apriw,'site = "' . $site . '"' . "\n");
fputs($apriw,'WattCons = "' . $WattCons . '"' . "\n");
fputs($apriw,'met_C = "' . $met_C . '"' . "\n");
fputs($apriw,'WattProd = "' . $WattProd . '"' . "\n");
fputs($apriw,'met_P = "' . $met_P . '"' . "\n");
fputs($apriw,'smtp_S = "' . $smtp_S . '"' . "\n");
fputs($apriw,'smtp_P = ' . $smtp_P . "\n");
fputs($apriw,'from_addr = "' . $from_addr . '"' . "\n");
fputs($apriw,'pwd = "' . $pwd . '"' . "\n");
fputs($apriw,'to_addrs = "' . $to_addrs . '"' . "\n");
fputs($apriw,'Sw_Off = ' . $Sw_Off . "\n");
fputs($apriw,'LowW = ' . $LowW . "\n");
fputs($apriw,'HiW = ' . $HiW . "\n");
fputs($apriw,'lapse = ' . $lapse . "\n");

//chiudo il file
fclose($apriw);
}

//creo il file variabili php per precompilare i moduli
if (!$apriw = fopen ("VarOld.php","w+")) {
echo 'Impossibile accedere al file di configurazione. <br><a href=\"javascript:history.go(-1)\">Controlla le impostazione del server e reinvia il modulo</a>';
}else{
$apriw = fopen ("VarOld.php","w+");
fputs($apriw,'<?php' . "\n");
fputs($apriw,'$site = "' . $site . '";' . "\n");
fputs($apriw,'$WattCons = "' . $WattCons . '";' . "\n");
fputs($apriw,'$met_C = "' . $met_C . '";' . "\n");
fputs($apriw,'$WattProd = "' . $WattProd . '";' . "\n");
fputs($apriw,'$met_P = "' . $met_P . '";' . "\n");
fputs($apriw,'$smtp_S = "' . $smtp_S . '";' . "\n");
fputs($apriw,'$smtp_P = ' . $smtp_P . ";\n");
fputs($apriw,'$from_addr = "' . $from_addr . '";' . "\n");
fputs($apriw,'$pwd = "' . $pwd . '";' . "\n");
fputs($apriw,'$to_addrs = "' . $to_addrs . '";' . "\n");
fputs($apriw,'$Sw_Off = ' . $Sw_Off . ";\n");
fputs($apriw,'$LowW = ' . $LowW . ";\n");
fputs($apriw,'$HiW = ' . $HiW . ";\n");
fputs($apriw,'$lapse = ' . $lapse . ";\n");
fputs($apriw,'?>' . "\n");
fclose($apriw);
}

// Mostro un messaggio di conferma all'utente
echo 'File di configurazione correttamente aggiornato.<br><br>';

//riavvio il servizio per rendere le modifiche effettive
echo 'Devi riavviare il servizio WattPrelCtrl per rendere effettive le modifiche. Clicca sul pulsante qui sotto per riavviarlo.<br>';
echo "<input type=\"button\" onclick=\"location.href='RestartService.php'\" value=\"Riavvia il servizio adesso\"/>";
echo "<br><br><a href=\"javascript:history.go(-1)\">Torna indietro</a>";
}

?>
