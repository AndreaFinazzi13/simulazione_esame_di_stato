<?php
    //controllo che la sessione sia partita
    if (!isset($_SESSION)) 
        //inizializzazione sessione
        session_start();
    
    //settaggio della risposta in json 
    header('Content-Type: application/json');
    //inclusione delle credenziali
    require_once("../database/credenziali.php");

    //variabili per l'utilizzo del database (all'interno delle variabili ci sono già i dati salvati nelle medesime variabili all'interno di "credenziali")
    global $host, $user, $psw, $dbname;

    //recupero degli attributi della nuova bici
    $seriale=$_GET["seriale"];
    //appena si inserisce la bici essa è perforza libera
    $inMovimento=0;
    //appena si inserisce la bici essa ha perforza 0 km percorsi
    $distanzaPercorsa=0;
    $rfd=$_GET["rfd"];
    $gps=$_GET["gps"];

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per inserire una nuova bici nel database
    $sql= "INSERT INTO bici (numeroSeriale, inMovimento, distanzaPercorsa, rfd, gps) VALUES (?, ?, ?, ?, ?)";
    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);
    //controllo se la preparazione della query presenta errori
    if (!$stmt) 
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    
    //inserimento dei parametri all'interno della query preparata
    $stmt->bind_param("sidss", $seriale, $inMovimento, $distanzaPercorsa, $rfd, $gps);
    
    //esecuzione della query creata
    if ($stmt->execute()){
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "ok", "message" => "Inserimento bici effettuato");
        //conversione dell'array in formato json e visualizzazione
        echo json_encode($arr);
    }
    else{
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "no", "message" => "ERRORE! Operazione non riuscita");
        //conversione dell'array in formato json e return a js
        echo json_encode($arr);
    }

    //conclusione quey
    $stmt->close();
