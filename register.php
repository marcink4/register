<?php
    include('header.html');

    if( isset($_REQUEST['login'])
        && isset($_REQUEST['password'])
        ){
        if(!isset($_REQUEST['tos'])){
            echo "nie wyraziles akceptacji regulaminu";
            exit();
        }
        //otrzymalismy dane rejestracyjne
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        //polaczenie z baza danych
        $db = new mysqli('localhost', 'root', '', 'forms');
        //stworz kwerede podsawiajac pwartosci
        $q = "INSERT INTO user (id, login, password) VALUES (NULL, \"$login\", \"$password\")";
        //wyslij kwerede
        $db->query($q);
        //weryfikacja poprawnosci danych
        switch($db->errno){
            case 0:
              echo " dodano poprawnie uzytkownika z ID = " . $db->insert_id;  
              break;
            case 1062:
                echo "taki uzytkownik juz istnieje";
                break;
            default :
                echo "wystapil blad numer: " . $db->errno . "komunikat bledu: " . $db->error;
                break;
        }
        

        //rozlaczenie z baza
        $db->close();
    }else{
        //nie otrzymalismy danych - wyswietl formularz
        include('registerForm.html');
    }

    include('footer.html');
?>