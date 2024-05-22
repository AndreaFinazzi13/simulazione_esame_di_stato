//verifica che la pagina sia stata caricata
document.addEventListener('DOMContentLoaded', function() {
    //coordinate di Brescia (città d'esempio per la simulazione)
    let longitudine = 10.2118;
    let latitudine = 45.5416;

    //inizializzazione mappa
    let mappa = L.map('mappaBrescia').setView([latitudine, longitudine], 13);

    //creazione del tile layer (immagine della mappa) che deve essere inserita nell'aposito div
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mappa);    //aggiunta dell'immagine alla mappa

    //inserimento delle coordinate di Brescia nella mappa
    L.marker([latitudine, longitudine]).addTo(mappa);
    
    //richiesta get
    $.get("./ajax/getCoordinate.php", {}, function(data) {
            
        //controllo che l'operazione sia andata a buon fine
        if(data["status"] == "ok"){
            //split per ';' dei record, si otterranno stringe del tipo: "via, numeroSlot, latitudine, longitudine"
            let records = data["message"].split(";");
            console.log(records)
            //scorrimento di tutti i record
            for (let i = 0; i < records.length; i++) {
                //split per ',' del singolo record
                let dati = records[i].split(",");
                
                //controllo che il numero di dati in ingressi sia giusto (evito di inserire record vuoti)
                if (dati.length != 4) 
                    //uscita dal ciclo
                    continue;

                //variabili ottenute
                let via = dati[0];
                let numeroSlot = dati[1];
                let latitudine = dati[2];
                let longitudine = dati[3];

                //creazione marker e inserimento nella mappa
                var marker = L.marker([latitudine, longitudine]).addTo(mappa);
                
                //visualizzazione popup che contrassegna il pin
                marker.bindPopup("<b> Via" + via + "</b><br>Numero slot: " + numeroSlot); 
            }
        }
    }, 'json');
});
