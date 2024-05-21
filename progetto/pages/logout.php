<?php
//controllo se la sessione è presente
if(!isset($_SESSION)){
    //start sessione 
    session_start();
}
 
//eliminazione attributi sessione
session_unset();
//distruzione sessione
session_destroy();
 
header("Location: ../index.php");
exit();
?>