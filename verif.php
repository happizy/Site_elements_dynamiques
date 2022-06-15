<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <title>Document</title>
</head>
<body>
    <div>
        <?php

            $link = mysqli_connect('localhost', 'root', 'lannion') or die ('Error connecting to mysql: ' . mysqli_error($link).'\r\n');
            $ID = mysqli_query($link, "select ID from site.userTemp where login = '".$_SESSION['login']."'");

            function genererChaineAleatoire($longueur){
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueurMax = strlen($caracteres);
            $chaineAleatoire = '';
            for ($i = 0; $i < $longueur; $i++)
            {
                $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
            }
            return $chaineAleatoire;
            }

            $lienConnexion = "localhost/" . genererChaineAleatoire(10) . "A" . $ID;

            echo '<form method="post" action=""><input type="text" name="mail" value="abc" style="display: none;"><input type="submit" value="'.$lienConnexion.'" class="btn"></form>';
        ?>
    </div>
    
</body>
</html>

<?php
    if (isset($_POST['mail'])){
        $link = mysqli_connect('localhost', 'root', 'lannion') or die ('Error connecting to mysql: ' . mysqli_error($link).'\r\n');
        $login = htmlspecialchars($_SESSION['login']);

        $use="use site";
        if (mysqli_query($link,$use)) {
            printf(mysqli_error($link));
        }
        
        $add1 = mysqli_query($link, "select * from usertemp where login = '".$login."'");
        $row = mysqli_fetch_assoc($add1);
        $add2 = mysqli_query($link, "insert into user values ('".$row['nom']."','".$row['prenom']."','".$row['mail']."','".$row['login']."','".$row['mdp']."')");

        echo "<script type='text/javascript'>document.location.replace('index_all.php');</script>";
    }
?>