<?php
try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=site_bennirah;charset=utf8', 'user', 'user');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'INSERT INTO utilisateur(nom,prenom,email,password,is_enabled) VALUES(:nom, :prenom,:email,:password,:is_enabled)';

$insertUser = $mysqlClient->prepare($sqlQuery);

$insertUser->execute([
    'nom' => 'dupont',
    'prenom' => 'roger',
    'email' => 'roger@gmail.com',
    'password' => 'rogerpsd',
    'is_enabled' => 1,
]);


$sqQuery = 'SELECT * FROM utilisateur WHERE is_enabled = :is_enabled';
$userStatement = $mysqlClient->prepare($sqQuery);
$userStatement-> execute([
    'is_enabled' => 1
]);
$users = $userStatement->fetchALL()

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

if (!empty($users)){
    foreach ($users as $user){
        echo htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['email']) . '<br>';
    }
} else {
    echo '<p>Aucun utilisateur activé trouvé.</p>';
}

?>
</body>
</html>

