<?php

$course_type = "";
$message = false;

if (!empty($_GET)) {
    if ($_GET['course'] == "maneuver" || $_GET['course'] == "circulation" || $_GET['course'] == "braking" || $_GET['course'] == "maneuver_and_circulation") {
        $course_type = $_GET['course'];
    } elseif ($_GET['message'] == "success") {
        // Inscription successful
        $message = true;
    }
    /**else {
     * //header('Location: https://www.bienconduire.ch/type-de-cours/preparation-a-lexamen-moto/');
     * }*/
} /** else {
 * //header('Location: https://www.bienconduire.ch/type-de-cours/preparation-a-lexamen-moto/');
 * }*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <title>bienconduire.ch - Inscription</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <a class="navbar-brand img-responsive" target="_blank" href="https://bienconduire.ch">
            <img class="img-responsive rounded" src="assets/images/logo.png"
                 alt="Logo de STORAGEHOST - Hosting Services."/>
        </a>
        <span class="navbar-brand mb-0 h1">bienconduire.ch</span>
    </nav>
</header>
<main style="margin-top: 15px;" class="container-fluid text-center bg-light2 mt-3 mb-3">
    <section class="container">
        <h2 class="text-center mb-xl">Inscription au cours de
            préparation <?php if (!empty($_GET)) {
                echo "- " . treat_parameter($course_type);
            } ?></h2>
        <div class="container border-top mt-3">
            <form class="mt-3" action="index.php" method="post">
                <?php if ($message) {
                    echo "<p class='text-success mb-3 font-weight-normal'>Merci ! Votre inscription a bien été reçue. Consultez vos emails pour une confirmation.</p>";
                } else {
                    echo "<p class='mb-3 font-weight-normal'>Merci de bien vouloir remplir les champs ci-dessous pour vous
                    inscrire au cours.</p>";
                } ?>

                <div class="row form-signup text-left">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="Doe"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" class="form-control"
                                   placeholder="John"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" id="address" name="address" class="form-control"
                                   placeholder="Rue de la Sionge 23"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tel">Téléphone</label>
                            <input type="tel" id="tel" name="tel" class="form-control"
                                   placeholder="0791234567"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                   placeholder="john.doe@example.com"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course">Type de cours</label>
                            <select id="course" class="form-control" name="course" required>
                                <option class="form-select" disabled>Choisissez le type de cours...</option>
                                <option value="maneuver" class="form-select" <?= is_selected()['maneuver']; ?>>
                                    Manoeuvres
                                </option>
                                <option value="circulation" class="form-select" <?= is_selected()['circulation']; ?>>
                                    Circulation
                                </option>
                                <option value="braking" class="form-select" <?= is_selected()['braking']; ?>>Freinage
                                </option>
                                <option value="maneuver_and_circulation"
                                        class="form-select" <?= is_selected()['maneuver_and_circulation']; ?>>Manoeuvres
                                    et circulation
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire au cours</button>
                    </div>

                    <?= display_error(); ?>

                </div>
        </div>
    </section>
</main>
<footer class="footer">
    <div class="container">
        <span class="text-muted text-small">© <a href="https://storagehost.ch">STORAGEHOST - Hosting Services</a></span>
    </div>
</footer>
</body>
</html>