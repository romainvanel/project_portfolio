<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <h1>Test</h1>

    <?php
    //Si la variable $error existe, j'affiche son contenu
    if (isset($error)) {
        echo $error;
    }
    
    ?>
    <form method="post">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name">
        <label for="avis">avis</label>
        <textarea id="avis" name="avis"></textarea>
        <button>envoyer</button>
    </form>
</body>
</html>