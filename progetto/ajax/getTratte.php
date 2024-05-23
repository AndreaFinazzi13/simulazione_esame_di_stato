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

    $id = $_SESSION["id"];

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per ricercare le tratte percorse al cliente loggato
    $sql = "SELECT * FROM operazione WHERE IDCliente = ?";

    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);

    //controllo se la preparazione della query presenta errori
    if (!$stmt)
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);

    //inserimento del parametro all'interno della query preparata
    $stmt->bind_param("i", $id); 

    //esecuzione della query creata
    if (!$stmt->execute())
        //comunicazione dell'errore nell'esecuzione della query
        throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

    //salvataggio risultati in apposita variabile
    $result = $stmt->get_result();

    //costruzione della tabella in cui si inseriranno le tratte percorse dall'utente loggato
    $table = "<tr><th>Operazione</th><th>Orario</th><th>Prezzo</th><th>Distanza percorsa</th></tr>";

    //controllo se c'è una riga di risultato
    while ($row = $result->fetch_assoc()){

        //completamento tabella con tutte le informazioni
        $table .= "<tr><td>$row[tipoOperazione]</td><td>$row[orario]</td><td>$row[prezzo]</td><td>$row[distanzaPercorsa]</td></tr>";
    }
    //invio della tabella
    $arr = array("status" => "ok", "message" => $table);
    //conversione dell'array in formato json e return a js
    echo json_encode($arr);