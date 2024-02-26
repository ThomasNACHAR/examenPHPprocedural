<?php
$fichier = file_get_contents('template/upload.tpl');
echo $fichier;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($_FILES["files"]["name"][0] !== "") {
        session_start();
        require_once("inc/db.php");
        $sql2 = "SELECT * FROM utilisateurs";
        $stmt = $pdo->prepare($sql2);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = 0;
        foreach ($users as $key => $value) {
            if ($_SESSION["username"] === $value["email"]) $id = $value["id"];
        }
        if ($id>0) {
            $i = 0;
            while ($i < count($_FILES["files"]["name"])) {
                $nom = $_FILES["files"]["name"][$i];
                $nom = time().'-'.$nom;
                $destination = "upload/$nom";
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $destination)) {
                    echo "Fichier $i envoyé ! <br>";
                    $sql = "INSERT INTO fichiers (id_utilisateur, fichier) VALUES (:id, :fichier)";
                    $statement = $pdo->prepare($sql);
                    $statement->bindParam(':id', $id);
                    $statement->bindParam(':fichier', $nom);
                    $statement->execute();
                } else echo "Erreur d'envoi du fichier $i ! <br>";
                $i++;
            }
        } else echo "Utilisateur non trouvé ! <br>";
        
        

    } else echo "Veuillez envoyer des fichiers ! <br>";
    // if (count($_FILES["files"]) > 0) {
    //     foreach ($_FILES["files"] as $key => $file) {
    //         $nom = $file["name"];
    //         $nom = time().'-'.$nom;
    //         $destination = "upload/$nom";
    //         if (move_uploaded_file($file["tmp_name"], $destination)) echo "Fichier $key envoyé ! <br>";
    //         else echo "Erreur d'envoi du fichier $key ! <br>";
    //     }
    // } else echo "Veuillez envoyer des fichiers ! <br>";
}

?>