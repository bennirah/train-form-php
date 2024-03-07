<?php

session_start();

// connect database

    try{
        $mysqlClient = new PDO('mysql:host=localhost;dbname=site_bennirah;charset=utf8', 'user', 'user');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    // take info in the form

$username = $_POST['username'];
$password = $_POST['password'];

// control information connect

$sUser = $mysqlClient->prepare("SELECT * FROM utilisateur WHERE (prenom) = ?");
$sUser->execute([$username]);
 $user = $sUser->fetch();

 if ($user && password_verify($password,$user['password'])){
    // Good
     $_SESSION['user_id'] = $user['id'];
     $_SESSION['username'] = $user['username'];
     header("Location: index.php");
 }else {
     // Authentification échouée
     echo "Nom d'utilisateur ou mot de passe incorrect.";

 }
?>