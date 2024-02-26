<?php

session_start();
if (isset($_SESSION["username"])) header('Location: index.php');
// Page inaccessible si la personne est connecté
$file = file_get_contents('template/register.tpl');
echo $file;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validation = true;
    foreach ($_POST as $key => $input) {
        if (empty($input)) $validation = false;
    }
    if ($_POST['password'] !== $_POST['confirm-password']) $validation = false;
    if ($validation) {
        require_once("inc/db.php");
        $sql = "SELECT * FROM utilisateurs";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $verify = true;
        foreach ($result as $value) {
            if ($value["email"] = $_POST["username"]) $verify = false;
        }
        if ($verify) {
            $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO utilisateurs (email, password) VALUES (:email, :password)";
            $stmt = $pdo->prepare($sql2);
            $stmt->bindParam(':email', $_POST["username"]);
            $stmt->bindParam(':password', $hash);
            $stmt->execute();
            require_once('inc/functions.php');
            sendMail($_POST["username"]);
            header('Location: ?route=login');        
        } else echo "Compte déjà existant ! <br>";
    } else echo "Veuillez remplir tous les champs et/ou mettre des mots de passe identiques ! <br>";
}
?>