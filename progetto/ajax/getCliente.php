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

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);

    $mail = $_SESSION["mail"];

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per ricercare la stazione inserita dall'utente nel database
    $sql = "SELECT * FROM cliente WHERE email = ?";

    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);

    //controllo se la preparazione della query presenta errori
    if (!$stmt)
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);

    //inserimento del parametro all'interno della query preparata
    $stmt->bind_param("s", $mail); 

    //esecuzione della query creata
    if (!$stmt->execute())
        //comunicazione dell'errore nell'esecuzione della query
        throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

    //salvataggio risultati in apposita variabile
    $result = $stmt->get_result();

    //costruzione della tabella in cui si inseriranno tutte le stazioni presenti nel database
    $table = "<tr><th>Email</th><th>Nome</th><th>Cognome</th><th>Numero civico</th><th>Via</th><th>Paese</th><th>Provincia</th><th>Regione</th><th>Stato</th></tr>";

    //controllo se c'è una riga di risultato
    if ($result->num_rows == 1) {
        //salvataggio del risultato della query
        $row = $result->fetch_assoc();

        //completamento tabella con tutte le informazioni
        $table .= "<tr><td>$row[email]</td><td>$row[nome]</td><td>$row[cognome]</td><td>$row[civico]</td><td>$row[via]</td><td>$row[paese]</td><td>$row[provincia]</td><td>$row[regione]</td><td>$row[stato]</td><td><button onclick='modifica($row[ID])'>Modifica</button></td></tr>";

        //invio della tabella
        $arr = array("status" => "ok", "message" => $table);
        //conversione dell'array in formato json e return a js
        echo json_encode($arr);
    }
    else{
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "no", "message" => "Credenziali non valide");
        //conversione dell'array in formato json e return a js
        echo json_encode($arr);
    }