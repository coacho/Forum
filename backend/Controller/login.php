<?php
require '../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb+srv://Mathieu:Des0urs!@cluster0.n9u83qq.mongodb.net/");

$database = $mongoClient->selectDatabase('Forum');
$collection = $database->selectCollection('Users');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userDocument = $collection->findOne(['username' => $username]);

    if ($userDocument && password_verify($password, $userDocument['password'])) {
        echo 'Login successful';
        header('Location: ../frontend/src/components/Success.html');
        exit();
    } else {
        echo 'Invalid credentials';
        header('Location: .../frontend/src/components/login.html?error=1');
        exit();
    }
}

?>
