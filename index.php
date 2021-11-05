<!DOCTYPE html>
<!-- TODO: refactor code -->
<!-- TODO: include a file with SQL instructions to build the initial databases -->
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Liste des abonnés</title>
</head>

<body>
    <h1 class="display-1 text-center mb-5 p-3">Liste des abonnées</h1>

    <?php
    // Connect to database
    $pdo = new PDO('mysql:dbname=pdo_test;host=127.0.0.1', 'root', '');

    // Delete a subscriber 
    if (isset($_POST['delete'])) {
        $req_del = $pdo->prepare('DELETE FROM subscribers WHERE id=? LIMIT 1');
        $req_del->execute(array($_POST['id']));
        $req_del = $pdo->prepare('DELETE FROM purchases WHERE id_subscriber=?');
        $req_del->execute(array($_POST['id']));
    }

    // Add a subscriber 
    if (isset($_POST['button'])) {
        $req_add = $pdo->prepare('INSERT INTO subscribers VALUES (NULL, ?, ?, ?, ?, NULL)');
        $req_add->execute(array($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']));
    }

    // Delete a purchase
    if (isset($_POST['sell'])) {
        $req_sell = $pdo->prepare('DELETE FROM purchases WHERE id_subscriber = ? AND id_video = ? LIMIT 1');
        $req_sell->execute(array($_POST['id'], $_POST['sell']));
    }

    // Add a purchase 
    if (isset($_POST['buy'])) {
        // List videos already bought
        $req_purchase = $pdo->prepare('SELECT id_video FROM purchases WHERE id_subscriber=?');
        $req_purchase->execute(array($_POST['id']));
        $purchases = $req_purchase->fetchAll(PDO::FETCH_COLUMN, 0); // purchase is an array whose values are the ids of the videos already bought

        // If video has not already been purchased, add a line to the "purchases" database
        if (!in_array($_POST['buy'], $purchases)) {
            $req_buy = $pdo->prepare('INSERT INTO purchases VALUES (NULL, ?, ?, NULL)');
            $req_buy->execute(array(($_POST['id']), $_POST['buy']));
        }
    }
    ?>

    <!-- Forms to input new data into database -->
    <section class="container my-5">
        <form action="index.php" method="POST">
            <div class="row py-3">
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" id="firstname" name="firstname" class="form-control">
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" id="lastname" name="lastname" class="form-control">
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
                    <button type="submit" class="btn btn-primary w-100" name="button" value="">
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
                <?php
                // Request the database to get all the data needed to display the web page
                $req_disp = $pdo->prepare('SELECT subscribers.id, subscribers.firstname, subscribers.lastname, subscribers.email, subscribers.password, subscribers.timestamp, GROUP_CONCAT(purchases.id_video ORDER BY purchases.id_video ASC) AS id_video FROM subscribers LEFT JOIN purchases ON subscribers.id = purchases.id_subscriber GROUP BY subscribers.id');
                $req_disp->execute();
                $subscribers_array = $req_disp->fetchAll(pdo::FETCH_ASSOC); // Store all data to be displayed in an array
                foreach ($subscribers_array as $row) { ?>

                    <tr>
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['timestamp'] ?></td>
                        <td><?= $row['id_video'] ?></td>
                        <td>
                            <form action="index.php" method="post">

                                <input type="hidden" name="id" value=<?= $row['id'] ?>>
                                <button class="btn btn-danger btn-fixed-width m-1" name="delete" value=''>Supprimer</button>

                                <?php
                                for ($id_video = 1; $id_video <= 2; $id_video++) {
                                    if (!in_array(strval($id_video), explode(",", $row['id_video']), true)) {
                                ?>
                                        <button class="btn btn-secondary btn-fixed-width m-1" name="buy" value=<?= $id_video ?>>Acheter vidéo <?= $id_video ?></button>

                                    <?php } else { ?>

                                        <button class="btn btn-warning btn-fixed-width m-1" name="sell" value=<?= $id_video ?>>Supprimer vidéo <?= $id_video ?></button>
                                <?php }
                                } ?>

                            </form>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </section>
</body>

</html>