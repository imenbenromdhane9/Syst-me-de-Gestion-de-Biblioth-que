<?php
session_start();
include("fonctionn.php");
connectMaBase();
?>
<html>
<head>
    <title>Connexion</title>
    <style>
        body {
            background-color: FFEBCD;
            padding: 20px;
        }

        h2 {
            color: CD5C5C;
        }

        form {
            background: white;
            padding: 15px;
            border-radius: 5px;
            width: 300px;
        }

        p {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Connexion</h2>
<form method="POST">
    Email: <input type="email" name="email"><br>
    Mot de passe: <input type="password" name="mot_de_passe"><br>
    <input type="submit" name="valider" value="Se connecter" style='background-color:Gray;'>
	    <input type="submit" name="insri" value="S'inscrire" style='background-color:Gray;'>

</form>


<?php
if (isset($_POST["insri"])) {
header("Location:inscription.php");
exit;
}

if (isset($_POST["valider"])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
	
	if (strpos($email, "@") === false || strpos($email, ".com") === false) {
    echo "<p style='color:red;'>L'adresse email doit contenir '@' et se terminer par '.com'.</p>";
	exit;
} 


    $res = mysql_query("SELECT * FROM utilisateurs WHERE email='$email'");
    $user = mysql_fetch_array($res);

    if ($user) {
        if ($user['mot_de_passe'] == $mot_de_passe) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];  
		header("Location: bibliotheque.php");

        } else {
            echo "<p style='color:red;'>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p style='color:red;'>Utilisateur non trouve.</p>";
    }
}
?>
</body>
</html>







































































    