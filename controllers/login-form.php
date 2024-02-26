<?php
session_start();
if (isset($_SESSION["username"])) header('Location: index.php');
// Page inaccessible si la personne est connecté
$fichier = file_get_contents('template/login.tpl');
echo $fichier;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validation = true;
    foreach ($_POST as $key => $input) {
        if (empty($input)) $validation = false;
    }
    if ($validation) {
        require_once("inc/db.php");
        $sql = "SELECT * FROM utilisateurs";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $verify = false;
        foreach ($result as $value) {
            if ($value["email"] = $_POST["username"] && password_verify($_POST["password"], $value["password"])) $verify = true;
        }
        if ($verify) {
            setcookie('username', $_POST["username"], time() + 900, "/");
            $_SESSION["username"] = $_COOKIE["username"];
            header("Location: index.php");  
        } else echo "Identifiants incorrects ! <br>";
    } else echo "Veuillez remplir tous les champs et/ou mettre des mots de passe identiques ! <br>";
}
?>

