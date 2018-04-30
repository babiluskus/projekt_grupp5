<?php

/**
* 
*/
class Login_model extends Base_model
{
    
    public function login()
    {
        $User->loginUser([
                'username' => $_POST['username'],
                'password' => $_POST['password']
            );

        // kolla om alla fälten är ifyllda
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "Fyll i de tomma fälten";
        } else { // kolla så att alla fälten är korrekt ifyllda
            if (!preg_match('/^[a-zA-Z]*$/', $_POST['username'])) {
                echo "fel tecken";
        } else { // kolla så att det är rätt epostadress
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        echo "invalid email";
                    } else { //hasha och kolla om lösenord matchar
                        $username = $_POST['username'];
                        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $sql = "SELECT username, password FROM account WHERE username = '".$username."' AND  password = '".$hashedPassword."'");
                        $result = query($sql);
                        $resultCheck = mysql_fetch_row($result);
                        if ($resultCheck == 0) { //om det är fel så omdirigera användaren tillbaka till formuläret
                            echo "du finns inte i db, försök igen";
                        } else { //om det är rätt, logga in användaren
                            $this->controllerObj->login();
                    }
        }
    }
}