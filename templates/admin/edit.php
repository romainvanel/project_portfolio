<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Edition projet</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <a href="/portfolio">Index</a>
        <a href="/portfolio/admin">admin</a>
        <a href="/portfolio/logout">logout</a>        
        <div class="container-fluid text-center">
            <h1 class="p-3">Editer votre projet</h1>


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
   

            <div class="w-50 m-auto border rounded p-3">
                <form method="post" enctype="multipart/form-data" class="d-flex flex-column w-100">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $projet->getTitle(); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="20"><?php echo $projet->getDescription() ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="preview" class="form-label">Image de couverture</label>
                        <input class="form-control" type="file" id="preview" name="preview">
                        <img src="../../<?php echo $projet->getFolderPreview(); ?>" alt="Image" class="img-fluid">
                    </div>
                    <button class="btn btn-primary">Editer</button>
                </form>
            </div>
        </div>
    </body>
</html>