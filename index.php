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
            $emailText .= "Phone: $phone\n";
        }
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-moi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>Contactez-moi</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                    <div class="row">

                        <div class="col-md-6">
                            <label for="firstname">Prénom<span class="blue"> *</span></label>
                            <input type="text" id="firstname"  name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                            <p class="comment"><?php echo $firstnameError ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="name">Nom<span class="blue"> *</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>">
                            <p class="comment"><?php echo $nameError ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="email">Email<span class="blue"> *</span></label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>">
                            <p class="comment"><?php echo $emailError ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro" value="<?php echo $phone; ?>">
                            <p class="comment"><?php echo $phoneError ?></p>
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message<span class="blue"> *</span></label>
                            <textarea name="message" id="message" class="form-control" placeholder="votre message" rows="4"><?php echo $message ?></textarea>
                            <p class="comment"><?php echo $messageError ?></p>
                        </div>

                        <div class="col-md-12">
                            <p class="blue"><strong>* Ces informations sont requises</strong></p>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>
                        
                    </div>

                    <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">
                    Votre message a bien été envoyé, merci :)</p>

                </form>
            </div>
        </div>
    </div>

</body>
</html>