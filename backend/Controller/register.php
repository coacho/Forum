<?php
require '../vendor/autoload.php'; 
try{

    //$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $mongoClient = new MongoDB\Client("mongodb+srv://Mathieu:Des0urs!@cluster0.n9u83qq.mongodb.net/");
} catch (MongoDB\Driver\Exception\Exception $e){
    echo "MongoDB Connection Error: " . $e->getMessage();
    exit();
}

$database = $mongoClient->selectDatabase('Forum');
$collection = $database->selectCollection('Users');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userDocument = [
        'username' => $username,
        'password' => $hashedPassword
    ];

    $collection->insertOne($userDocument);
    header('Access-Control-Allow-Origin: http://localhost:8080');
    echo json_encode(['success' => true]);

    //header('Location: ../frontend/src/components/login.vue');
    exit();
}

?>
