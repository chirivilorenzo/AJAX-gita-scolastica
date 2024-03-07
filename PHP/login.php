<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $classeDB = new CDatabase();
        $classeDB->connessione();

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query = "SELECT * FROM utenti WHERE username = ? AND password = ?";
        $result = $classeDB->seleziona($query, $username, $password);

        if($result != "errore" && $result != "vuoto"){
            if($result[0]["admin"] == 1){
                $_SESSION["admin"] = true;
                echo "admin";
            }
            else{
                $_SESSION["username"] = $username;
                echo "200";
            }
        }
        else{
            echo "300";
        }
    }
    else{
        echo "404";
    }