<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div><a href="/portfolio/login">Login</a></div>

    <!-- Affiche un  message si l'utilisateur est connecté -->
    <?php if($isLoggedIn): ?>
        <div class="alert alert-success">
            Bonjour <?php echo $_SESSION['user']->getUsername(); ?> !
        </div>
    <?php endif ?>

    <div class="d-flex flex-column justify-content-center">
            <?php foreach($projets as $projet): ?>
                <article class="border m-3">
                    <h2><?php echo $projet->getTitle() ?></h2>
                    <p><?php echo mb_strimwidth($projet->getDescription(), 0, 75, '...'); ?></p>
                    
                    <p>Crée le : <?php echo $projet->getCreatedAt()->format('d.m.Y'); ?></p>
                    <img src="<?php echo $_ENV['FOLDER_PROJECT'] .$projet->getPreview(); ?>" alt="<?php echo $projet->getTitle(); ?>">
                    <div>
                        <a href="/portfolio/projet/details?id=<?php echo $projet->getId(); ?>" class="btn btn-primary">Lire plus</a>
                    </div>
            </article>
        <?php endforeach ?>
    </div>
</body>
</html>