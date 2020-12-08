<?php
include 'class.php';  

$myConnexion = new Connexion("localhost", "becode", "Joann", "becode");

echo "Nombre d'entrée dans la table «blog» de la DB «becode»: ".$myConnexion->countTable("SELECT * FROM blog;");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><a href="./ajouter.php">Add post</a><br>
    <table class="table" style="border: 1px solid black">
        <thead>
            <tr>
                <th style="border: 1px solid black">id</th>
                <th style="border: 1px solid black">title</th>
                <th style="border: 1px solid black">content</th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach(Post::findAllPost() as $post){
        echo '<tr>';
            echo '<td style="border: 1px solid black">'.$post->getId().'</td>';
            echo '<td style="border: 1px solid black">'.$post->getTitle().'</td>';
            echo '<td style="border: 1px solid black">'.$post->getContent().'</td>';
        echo '</tr>';
    }
?>
        </tbody>
    </table>


    <br><br><a href="./generateHTML.php">GenerateHTML</a><br>
    <br><br><a href="./parc_voitures.php">Parc Voiture</a><br>
    <br><br><a href="./database_test.php">database user</a><br>
</body>
</html>