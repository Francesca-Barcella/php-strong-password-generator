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
        //concateno il carattere scelto alla stringa della password
        if(!str_contains($password, $character) && !$_GET['duplicates']){
            $password .= $character;
        } else {
            $password .= $character;
        }
        //var_dump($character);
        //$password .= $character;
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