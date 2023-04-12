<?php
/* TRACCIA

Dobbiamo creare una pagina che permetta ai nostri utenti di utilizzare il nostro generatore di password (abbastanza) sicure.
L’esercizio è suddiviso in varie milestone ed è molto importante svilupparle in modo ordinato.

MILESTONE 1
Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php

MILESTONE 2
Verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php che includeremo poi nella pagina principale

MILESTONE 3 (BONUS)
Gestire ulteriori parametri per la password: quali caratteri usare fra numeri, lettere e simboli.
Possono essere scelti singolarmente (es. solo numeri) oppure possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre insieme). Dare all’utente anche la possibilità di permettere o meno la ripetizione di caratteri uguali.

MILESTONE 4 (BONUS - OPZIONALE)
Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION (documentazione) recupererà la password da mostrare all’utente.

*/

//var_dump($_GET);

include __DIR__ . '/functions.php';


if (isset($_GET['pwdLen'])) {
    //var_dump('funziona');
    $length = $_GET['pwdLen'];
    $password = generate_password($length);
    //var_dump($password);
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pwd generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <header class="mb-2"></header>

    <main>
        <!-- MILESTONE 1
        Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente. Scriviamo tutto (logica e layout) in un unico file index.php 
        -->
        <div class="container p-4">
            <div class="text-center">
                <h1>Strong Passaword Generator</h1>
                <h3>Genera una password sicura</h3>
            </div>
            <form action="index.php" method="GET" class="p-5 my-5 rounded-2">
                <!-- lunghezza password -->
                <div class="mt-3 d-flex justify-content-around">
                    <div class="col-6">
                        <label for="lunghezza_pwd" class="form-label">Lunghezza password (tra 8 e 32 caratteri):</label>
                    </div>
                    <div class="col-4">
                        <input type="number" name="pwdLen" id="pwdLen" class="form-control">
                    </div>
                </div>
                <!-- ripetizioni caratteri SI/NO password -->
                <div class="my-3 d-flex justify-content-around">
                    <div class="col-6">
                        <label for="criteri_caratteri" class="form-label">Consenti ripetizioni di uno o più caratteri:</label>
                    </div>

                    <div class="col-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="duplicates" id="duplicates" value="true">
                            <label class="form-check-label" for="duplicates">Si</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="duplicates" id="radio_no" value="false" checked>
                            <label class="form-check-label" for="duplicates">No</label>
                        </div>
                    </div>
                </div>

                <!-- ripetizioni caratteri LETTERE/NUMERI/CARATTERI password -->
                <div class="my-3 d-flex justify-content-around">
                    <div class="col-6"><label for="criteri_caratteri" class="form-label"></label></div>
                    <div class="col-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="si" name="lettere" id="lettere">
                            <label class="form-check-label" for="lettere">Lettere</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="si" name="numeri" id="numeri">
                            <label class="form-check-label" for="numeri">Numeri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="si" name="simboli" id="simboli">
                            <label class="form-check-label" for="simboli">Simboli</label>
                        </div>
                    </div>
                </div>

                <!-- pulsanti INVIA e ANNULLA-->
                <div class="d-flex justify-content-around">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary me-2">Invia</button>
                        <button type="reset" class="btn btn-secondary">Annulla</button>
                    </div>
                    <div class="col-4"></div>
                </div>
            </form>
            <?php if (isset($_GET['pwdLen'])) : ?>
                <div class="alert alert-<?= $password['class']; ?>" role="alert">
                    <strong>Password = </strong> <?= $password['result']; ?>
                </div>
            <?php endif; ?>
            <!-- MILESTONE 4 (BONUS - OPZIONALE)
            Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION (documentazione) recupererà la password da mostrare all’utente. 
                IPOTESI PROCEDIMENTO:
                - if result contine errore allorastampo il div  per l'errore
                - else resul non contiene allora mando alla thankyou page
                IPOTESI 2:
                - if mail è settata o valida?
                - redirect thankyou page
                - else
                - il div che c'è sopra solo con esito neagativo
        -->
        <?php if (str_contains($password, 'Errore!')) : ?>
            <div class="alert alert-<?= $password['class']; ?>" role="alert">
                    <strong>Password 2= </strong> <?= $password['result']; ?>
                </div>

        <?php endif; ?>

        

        </div>
    </main>


    <footer></footer>
</body>

</html>