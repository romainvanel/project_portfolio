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
    <div class="d-flex flex-column justify-content-center">
                <article class="border m-3">
                    <h2><?php echo $projet->getTitle() ?></h2>
                    <p><?php echo $projet->getDescription() ?></p>
                    
                    <p>Crée le : <?php echo $projet->getCreatedAt() ?></p>
                    <p>Mis à jour le : <?php echo $projet->getUpdatedAt() ?></p>
                    <img src="<?php echo $projet->getPreview() ?>" alt="">

                    <a href="" class="btn btn-primary">Lire plus</a>
            </article>
    </div>
</body>
</html>