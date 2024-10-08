<?php
//session_start();
echo("<pre>");
include_once './DBC.php';

if (empty($_POST["email"]) || empty($_POST["password"])) 
{
    $_SESSION["error"] = "Email or Password is empty";
    header('Location: /index.php');
    exit();
}

verifyUser($_POST["email"], $_POST["password"]);


/**
 * @param string $email
 * @param string $password
 * @return void
 */
function verifyUser(string $email, string $password): void
{
    $connection = DBC::getConnection();
    $statement = $connection -> prepare("SELECT id, email, password FROM User WHERE email = :email LIMIT 1");
    $statement -> execute([":email" => $email]);
    $result = $statement -> fetch(PDO::FETCH_ASSOC);
    
    if ($result && password_verify($password, $result["password"])) 
    {
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = $result["email"];
        header("Location: /home.php");
    } 
    else 
    {
        $_SESSION["error"] = "Invalid login";
        header("Location: /index.php");
    }
}


