<html>
    <head>
        <!--titolo della pagina-->
        <title> Pagina admin </title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/accesso.js"></script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formLogin">
            <!--titolo interno alla pagina-->
            <h1> Pagina admin </h1>

            <!--bottone per gestire le stazioni-->
            <button class="b" type="button" onclick="gestioneStazioni()"> Gestione stazioni </button>

            <!--bottone per gestire le bici-->
            <button class="b" type="button" onclick="gestioneBici()"> Gestione biciclette </button>

            <!--bottone per effettuare la logout-->
            <button class="b" type="button" onclick="logout()"> Logout </button>
        </div>
    </body>
</html>