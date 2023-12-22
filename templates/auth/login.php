<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion à l'administration</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid text-center">
            <h1 class="p-3">Connexion à l'administration</h1>
            <div class="w-50 m-auto border rounded p-3">
                <form method="post" class="d-flex flex-column w-100">
                    <div class="mb-3">
                        <label for="username" class="form-label">Identifiant</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button class="btn btn-primary">Se connecter</button>

                    <!-- Mes erreurs -->
                    <!-- Si la variable $error existe, j'affiche son contenu -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3">
                            
                            <?php echo $error; ?>
                        </div>                              
                    <?php endif ?>
                </form>
            </div>
        </div>
    </body>
</html>