<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Liste des abonnés</title>
</head>

<body>
    <h1 class="display-1 text-center mb-5 p-3">Liste des abonnées</h1>
    <section class="container my-5">
        <form action="index.php" method="POST">
            <div class="row py-3">
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="surname" class="form-label">Prénom</label>
                    <input type="text" id="surname" name="prenom" class="form-control">
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" id="name" name="nom" class="form-control">
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="input col-xs-12 col-sm-6 col-md-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control">
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
                <tr>
                    <td>Jean</td>
                    <td>Dupont</td>
                    <td>jean.dupont@gmail.com</td>
                    <td>1234</td>
                    <td>04/11/2021 08:13</td>
                    <td>Aucune</td>
                    <td>
                        <button class="btn btn-secondary m-1">Acheter vidéo 1</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 2</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 3</button>
                    </td>
                </tr>
                <tr>
                    <td>Jean</td>
                    <td>Dupont</td>
                    <td>jean.dupont@gmail.com</td>
                    <td>1234</td>
                    <td>04/11/2021 08:13</td>
                    <td>Aucune</td>
                    <td>
                        <button class="btn btn-secondary m-1">Acheter vidéo 1</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 2</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 3</button>
                    </td>
                </tr>
                <tr>
                    <td>Jean</td>
                    <td>Dupont</td>
                    <td>jean.dupont@gmail.com</td>
                    <td>1234</td>
                    <td>04/11/2021 08:13</td>
                    <td>Aucune</td>
                    <td>
                        <button class="btn btn-secondary m-1">Acheter vidéo 1</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 2</button>
                        <button class="btn btn-secondary m-1">Acheter vidéo 3</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</body>

</html>