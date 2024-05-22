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

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per ricercare la stazione inserita dall'utente nel database
    $sql = "SELECT * FROM bici";

    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);

    //controllo se la preparazione della query presenta errori
    if (!$stmt)
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);

    //esecuzione della query creata
    if (!$stmt->execute())
        //comunicazione dell'errore nell'esecuzione della query
        throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

    //salvataggio risultati in apposita variabile
    $result = $stmt->get_result();

    //costruzione della tabella in cui si inseriranno tutte le stazioni presenti nel database
    $table = "<tr><th>Numero seriale</th><th>Disponibile</th><th>Km totali percorsi</th><th>rfd</th><th>gps</th></tr>";

    //scorrimento delle stazioni presenti nel database
    while ($row = $result->fetch_assoc()){
        //controllo sullo stato della bici
        //controllo se è in movimento
        if($row["inMovimento"] == 1)
            //non è disponibile
            $disponibile="no";
        //non è in movimento
        else
            //è disponibile
            $disponibile="si";
        
        //completamento tabella con tutte le stazioni
        $table .= "<tr><td>$row[numeroSeriale]</td><td>$disponibile</td><td> $row[distanzaPercorsa]</td><td>$row[rfd]</td><td> $row[gps]</td><td><button onclick='modifica($row[ID], $row[numeroSeriale])'>Modifica</button></td><td><button onclick='elimina($row[ID])'>Elimina</button></td></tr>";
    }
    //invio della tabella
    $arr = array("status" => "ok", "message" => $table);
    //conversione dell'array in formato json e return a js
    echo json_encode($arr);
