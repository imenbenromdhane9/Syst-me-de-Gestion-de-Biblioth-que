<?php

function connectMaBase() {
    $connexion = mysql_connect("localhost", "root", "");
    mysql_select_db("projet");
}

?>