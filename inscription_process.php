<?php
try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=site_bennirah;charset=utf8', 'user', 'user');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

// take the data form

$user=$_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$username = [];

// check username

$userExist = $mysqlClient->prepare('SELECT * FROM utilisateur WHERE prenom = ?');
$userExist -> execute([$user]);


if ($userExist-> rowCount()>0){
    echo 'erreur name déja utilisé';
}else{
    // insert data in dataBase
    try {
        $insertUser= $mysqlClient->prepare("INSERT INTO utilisateur (prenom, password) VALUES (?, ?)");
        $insertUser->execute([$user, $password]);
        echo "Inscription réussie !";
        var_dump($user, $password);
        var_dump($insertUser->errorInfo());
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}





?>