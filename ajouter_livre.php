<html>
<head>
    <title>Livre</title>
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
<?php
include("fonctionn.php");
connectMaBase();

if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $annee = $_POST["annee"];
    $disponible = $_POST["disponible"];

    $req = "INSERT INTO livres VALUES ('','$titre', '$auteur', $annee, '$disponible')";
    
    if (mysql_query($req)) {
        echo "<p style='color:green;'>Livre ajouté avec succes.</p>";
    } else {
        echo "<p style='color:red;'>Erreur lors de l'ajout.</p>";
    }
}
?>

<h2>Ajouter un livre</h2>
<form method="POST">
    Titre : <input type="text" name="titre" ><br><br>
    Auteur : <input type="text" name="auteur" ><br><br>
    Annee : <input type="number" name="annee"><br><br>
    Disponible :
    <select name="disponible">
        <option value="Oui">Oui</option>
        <option value="Non">Non</option>
    </select><br><br>

    <input type="submit" name="ajouter" value="Ajouter le livre">
</form>
</body>
</html>
