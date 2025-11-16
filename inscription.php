<?php
include("fonctionn.php");
connectMaBase();
?>


<html>
<head>
    <title>Inscription</title>
    <style>
        body {

            background-color: #f0f0f0;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
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

<h2>Inscription</h2>
<form method="POST">
    Nom: <input type="text" name="nom"><br>
    Prenom: <input type="text" name="prenom"><br>
    Email: <input type="email" name="email"><br>
    Mot de passe: <input type="password" name="mot_de_passe"><br>
    <input type="submit" name="valider" value="S'inscrire"style='background-color:Gray;'>
    <input type="submit" name=" connecter" value="Se connecter"style='background-color:Gray;'>

</form>

<?php
if (isset($_POST["valider"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
	
	if (strpos($email, "@") === false || strpos($email, ".com") === false) {
    echo "<p style='color:red;'>L'adresse email doit contenir '@' et se terminer par '.com'.</p>";
	exit;
}
 
	

    $ress = "INSERT INTO utilisateurs VALUES ('', '$nom', '$prenom', '$email', '$mot_de_passe')";
    $result = mysql_query($ress);




    if ($result) {
        echo "<p style='color:green;'>Inscription reussie. <a href='connexion.php'>Connexion</a></p>";
		
		
    } else {
        echo "<p style='color:red;'>Erreur lors de l'inscription.</p>";
    }
}
if (isset($_POST["connecter"])) {

    header("Location: connexion.php");
    exit;
}

?>

</body>
</html>


