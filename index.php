<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Liste des abonnés</title>
</head>

<body>
    <h1 class="display-1 text-center mb-5 p-3">Liste des abonnées</h1>

    <?php
    // Connect to database
    $pdo = new PDO('mysql:dbname=pdo_test;host=127.0.0.1', 'root', '');

    // Delete data if a "Supprimer" button was clicked
    if (isset($_POST['delete'])) {
        $req_del = $pdo->prepare('DELETE FROM subscribers WHERE id=? LIMIT 1');
        $req_del->execute(array($_POST['delete']));
    }

    // Add $_POST data to database
    if (isset($_POST['surname'])) {
        $req_add = $pdo->prepare('INSERT INTO subscribers VALUES (NULL, ?, ?, ?, ?, NULL, \'\')');
        $req_add->execute(array($_POST['surname'], $_POST['lastname'], $_POST['email'], $_POST['password']));
    }

    // Store data retrieved in database into dbarray
    $req_disp = $pdo->prepare('SELECT * FROM subscribers');
    $req_disp->execute();
    $dbarray = $req_disp->fetchAll();
    ?>

    <!-- Forms to input new data into database -->
    <section class="container my-5">
        <form action="index.php" method="POST">
            <div class="row py-3">
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="surname" class="form-label">Prénom</label>
                    <input type="text" id="surname" name="surname" class="form-control" required>
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        Soumettre
                    </button>
                </div>
            </div>
        </form>
    </section>

    <!-- Display database content -->
    <section class="container my-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Date et heure d'inscription</th>
                    <th scope="col">Vidéos achetés</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop on each data row and display it inside html table -->
                <?php
                foreach ($dbarray as $row) { ?>
                    <tr>
                        <td><?= $row['surname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['timestamp'] ?></td>
                        <td><?= $row['videos'] ?></td>
                        <td>
                            <form action="index.php" method="post">
                                <button class="btn btn-danger m-1" name="delete" value=<?= $row['id']?>>Supprimer</button>
                                <button class="btn btn-secondary m-1" name="buy" value="1">Acheter vidéo 1</button>
                                <button class="btn btn-secondary m-1" name="buy" value="2">Acheter vidéo 2</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>

</html>