<?php 
//funzione per generare la pwd
function generate_password($pwd_len)
{
    //lugnhezza pwd compresa tra 8 e 32

    if ($pwd_len < 8 || $pwd_len > 32) {
        //var_dump('La password deve essere compresa tra 8 e 32 caratteri');
        //return 'Errore! La password deve essere compresa tra 8 e 32 caratteri.';
        return ['class' => 'danger', 'result' => 'Errore! La password deve essere compresa tra 8 e 32 caratteri.'];
    }

    //variabile vuota per creare la pwd
    $password = '';

    $characters_list = generate_characters($pwd_len);
    //var_dump($characters_list);

    //ciclo fino a raggiungere la lunghezza della pwd_len

    while (strlen($password) < $pwd_len) {
        //ad ogni iterazione sceglie un carattere della lista
        $character = $characters_list[rand(0, strlen($characters_list))];
        //se password non contiene il carattere e non voglio duplicati
        if(!str_contains($password, $character) && $_GET['duplicates'] === 'false'){
            //concateno un carattere nuovo e non ripetuto alla stringa della password
            $password .= $character;
        //altrimenti se password accetta duplicati
        } elseif ($_GET['duplicates'] === 'true') {
            //concateno un carattere che può essere sia doppio sia no alla stringa della password
            $password .= $character;
        }
    }
    return ['class' => 'info', 'result' => $password];
}

//genero lista completa di caratteri - numeri  - simboli e poi li metto in una funzione a sestante rispetto a quella sopra
function generate_characters()
{
    $letters = 'abcdefghilmnopqrstuvz';
    $letter_uppercase = strtoupper($letters);
    $numbers = '1234567890';
    $symbols = '#+-_?![]{}%&$*<>=';
    return $letters . $letter_uppercase . $numbers . $symbols;
}


?>