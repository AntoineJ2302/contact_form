<?php

    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "antoine.janssoone2302@gmail.com";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";

        if(empty($firstname))
        {
            $firstnameError = "Merci de compléter le champ prénom";
            $isSuccess = false;
        }
        else 
        {
            $emailText .= "FirstName: $firstname\n";
        }
        if(empty($name))
        {
            $nameError = "Merci de compléter le champ nom";
            $isSuccess = false;
        }
        else 
        {
            $emailText .= "Name: $name\n";
        }
        if(empty($message))
        {
            $messageError = "Merci de saisir votre message";
            $isSuccess = false;
        }
        else 
        {
            $emailText .= "Message: $message\n";
        }
        if(!isEmail($email)) 
        {
            $emailError = "Adresse invalide";
            $isSuccess = false;
        }
        else 
        {
            $emailText .= "Email: $email\n";
        }
        if(!isPhone($phone))
        {
            $phoneError = "que des chiffes";
            $isSuccess = false;
        }
        else 
        {
            $emailText .= "Phone: $phone\n"
        };
        if($isSuccess)
        {
           $headers = "From: $firstName $name <$email> \r\nReply-to: $email"; 
           mail($emailTo, "Un message a été envoyé", $emailText , $headers);
           $firstname = $name = $email = $phone = $message = "";
        }
    }


    function isPhone($var)
    {
        return preg_match("/^[0-9 ]*$/",$var);
    }

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

?>