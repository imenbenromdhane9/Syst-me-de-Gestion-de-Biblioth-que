
<html>
<head>
    <title>Bibliotheque</title>
    <style>
        body {

            background-color: #FFE4C4;
            padding: 20px;
        }

        h2 {
            color: #D2691E;
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
session_start();
include("fonctionn.php");
connectMaBase();

?>

<h2>Bibliotheque - Livres disponibles</h2>
<h2>Bienvenue <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?> !</h2>

<form method="POST">
    Rechercher par :
    <select name="critere">
        <?php
		
        $reponse1 = mysql_query("SHOW FIELDS FROM livres");
        while ($donnees1 = mysql_fetch_array($reponse1)) {
            $champ = $donnees1['Field'];
            echo "<option value='$champ'>$champ</option>";
        }
        ?>
    </select><br><br>

    <input type="text" name="valeur">
    <input type="submit" name="chercher" value="Rechercher"style='background-color:Gray;'> 
	<button type="submit" name="etat" style='background-color:Gray;'>Etat Livres </button>
	<button type="submit" name="logout" style='background-color:Gray;'>Deconnexion</button>

</form>


<?php
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit;
}
if (isset($_POST["chercher"])) {
    $critere = $_POST["critere"];
    $valeur = $_POST["valeur"];

    echo "<h3>Resultat de la recherche</h3>";

    if (!empty($valeur)) {
        $req = "SELECT * FROM livres WHERE $critere LIKE '%$valeur%'";
    } else {
        echo "<h3>Livres disponibles</h3>";
        $req = "SELECT * FROM livres WHERE disponible='Oui'";
    }

    $res = mysql_query($req);
	

    if (mysql_num_rows($res) > 0) {
        echo "<table border='4' style='border-color: violet;'>";
        echo "<tr><th>Titre</th>
		<th>Auteur</th>
		<th>Annee</th>
		<th>Disponibilite</th>
		<th>Action</th></tr>";
        while ($livre = mysql_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $livre['titre'] . "</td>";
            echo "<td>" . $livre['auteur'] . "</td>";
            echo "<td>" . $livre['annee'] . "</td>";
            echo "<td>" . $livre['disponible'] . "</td>";

            if ($livre['disponible'] == 'Oui') {
                echo "<td>
  
							<form method='POST'>
                            <button type='submit' name='emprunter_id' value=' " . $livre['id'] . "' style='background-color:Gray;'>Emprunter</button>
                            </form>
                      </td>";
            } else {
                echo "<td><p>Indisponible</p></td>";
            }

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:red;'>Aucun resultat trouve.</p>";
    }
}

if (isset($_POST['emprunter_id'])) {
    $id = $_POST['emprunter_id'];

        $update = mysql_query("UPDATE livres SET disponible='Non' WHERE id='$id'");
        if ($update) {
            echo "<p style='color:green;'>Livre emprunte avec succes.</p>";
        } else {
            echo "<p style='color:red;'>Erreur lors de l'emprunt.</p>";
        }
    
}
?>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: connexion.php");
    exit;
}
if (isset($_POST['etat'])) {
	$req = "SELECT * FROM livres";
	$res = mysql_query($req);
	   if (mysql_num_rows($res) > 0) {
        echo "<table border='4' style='border-color: violet;'>";
        echo "<tr><th>Titre</th>
		<th>Auteur</th>
		<th>Annee</th>
		<th>Disponibilite</th>";
        while ($livre = mysql_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $livre['titre'] . "</td>";
            echo "<td>" . $livre['auteur'] . "</td>";
            echo "<td>" . $livre['annee'] . "</td>";
            echo "<td>" . $livre['disponible'] . "</td>";

         

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:red;'>Aucun resultat trouve.</p>";
    }
}
?>
</body>
</html>