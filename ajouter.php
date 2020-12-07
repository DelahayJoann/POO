<?php
include 'class.php';

if(isset($_POST['title'],$_POST['content'])){
    $onePost = new Post(null,$_POST['title'],$_POST['content']);
    $onePost->addPost();
    $_POST = array();
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un post</title>
	<link rel="stylesheet" media="screen" title="Create post" charset="utf-8">
</head>
<body>
	<br><a href="./index.php">Return index</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="title">Title: </label>
			<input type="text" name="title" value="">
		</div>
		<div>
			<label for="content">Content: </label>
			<textarea name="content" rows="10" cols="30" value=""></textarea>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>