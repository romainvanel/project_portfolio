<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <h1>Administration</h1>
        <a href="/portfolio">Index</a>
        <a href="/portfolio/logout">logout</a>
        <!-- Message de succès -->
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        

        <div class="d-flex justify-content-end">
            <a href="/portfolio/admin/projet/add" class="btn btn-primary fw-bold">Nouveau Projet</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Date de publication</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($projects === false): ?>
                    <h2>Il n'y a aucun projet</h2>
                <?php else:
                    foreach($projects as $project): 
                    ?>
                        <tr>
                            <td>
                                <?php echo $project->getId();?>
                            </td>
                            <td>
                                <?php echo $project->getTitle();?>
                            </td>
                            <td>
                                <?php echo $project->getCreatedAt()->format('d.m.Y');?> 
                            </td>                  
                            <td>
                                <a href="/portfolio/admin/edit/projet?id=<?php echo $project->getId();?>" class="btn btn-outline-success fw-bold">Editer</a>
                            </td>
                            <td>
                                <a href="/portfolio/admin/delete/projet?id=<?php echo $project->getId();?>" class="btn btn-outline-danger fw-bold">Supprimer</a>
                            </td>
                            <td>

                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif ?>
            </tbody>
        </table>
    </body>
</html>