<?php
//session_start();
echo("<pre>");
//require_once './User.php';
include_once './DBC.php';

if (empty($_POST["email"]) || empty($_POST["password"])) 
{
    $_SESSION["error"] = "Email or Password is empty";
    header('Location: /index.php');
    exit();
}

if(insertUser($_POST["email"], $_POST["password"]))
{
    header("Location: /home.php");
    exit();
} 
else 
{
    $_SESSION["error"] = "Unexpected error just happened!";
    header('Location: /index.php');
}

/**
 * @param string $email
 * @param string $password
 * @return bool
 */
function insertUser(string $email, string $password): bool
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $connection = DBC::getConnection();
    $statement = $connection -> prepare("INSERT INTO User (email, password) VALUES (:email, :password);");
    $statement -> bindParam(":email", $email);
    $statement -> bindParam(":password", $hashedPassword);
    return $statement -> execute();
}
