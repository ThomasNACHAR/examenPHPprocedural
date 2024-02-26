<?php
session_start();
if (!isset($_SESSION["username"])) header('Location: ?route=register');
// Page accessible uniquement aux personnes connectées
require_once('autoload.php');

require_once('smarty/libs/Smarty.class.php');
error_reporting(0);
$smarty = new Smarty();

$smarty->setTemplateDir('template/');
$smarty->setCompileDir('templates_c/');
$smarty->setConfigDir('configs/');
$smarty->setCacheDir('cache/');


require_once("inc/db.php");

$sql2 = "SELECT * FROM utilisateurs";
$stmt = $pdo->prepare($sql2);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$id = 0;
foreach ($users as $key => $value) {
    if ($_SESSION["username"] === $value["email"]) $id = $value["id"];
}
if ($id != 0) {
    $sql = "SELECT * FROM fichiers";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $files = array();
    foreach ($result as $value) {
        if ($value["id_utilisateur"] === $id) $files = [...$files, $value["fichier"]];
    }
    $smarty->assign('fichiers', $files);
    $smarty->display('index.tpl');
} else echo "Utilisateur introuvable <br>";


?>