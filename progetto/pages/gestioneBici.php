<!--controllo che la sessione sia partita-->
<?php 
    if (!isset($_SESSION)) {
        //inizializzazione sessione
        session_start();
    }
?>