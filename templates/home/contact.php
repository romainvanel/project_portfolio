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
    <?php
    //Si la variable $error existe, j'affiche son contenu
    if (isset($success)) {
        echo $success;
    }
    
    ?>

    <form method="post">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name">
        <label for="email">mail</label>
        <input type="email" id="email" name="email">
        <label for="content">Message</label>
        <textarea id="content" name="content"></textarea>
        <button>envoyer</button>
    </form>
</body>
</html>