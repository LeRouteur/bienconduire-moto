<?php

require_once "php/Model.php";

global $error;

get_form_data();

function get_form_data()
{
    global $error;

    if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['address']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['course'])) {
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        // Create valid array
        $valid_data = array();

        // Validate name and firstname
        if (filter_var($name, FILTER_SANITIZE_STRING)) {
            $valid_data['name'] = $name;
            if (filter_var($firstname, FILTER_SANITIZE_STRING)) {
                $valid_data['firstname'] = $firstname;
            } else {
                $error = "firstname";
                return;
            }
        } else {
            $error = "name";
            return;
        }

        // Add address in the array
        $valid_data['address'] = $address;

        // Validate phone number
        if (preg_match("/(\b(0041|0)|\B\+41)(\s?\(0\))?(\s)?[1-9]{2}(\s)?[0-9]{3}(\s)?[0-9]{2}(\s)?[0-9]{2}\b/", $tel) || preg_match("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", $tel)) {
            $valid_data['phone'] = $tel;
        } else {
            $error = "tel";
            return;
        }

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)) {
            $valid_data['email'] = $email;
        } else {
            $error = "email";
            return;
        }

        // Validate course
        if ($course == "maneuver" || $course == "circulation" || $course == "braking" || $course == "maneuver_and_circulation") {
            $valid_data['course'] = $course;
        } else {
            $error = "course";
            return;
        }

        // Send the email
        $result = (new Model())->send_mail();

        //var_dump($result);

        if ($result) {
            header('Location: http://localhost?message=success');
        } else {
            $error = $result['message'];
        }

    } else {
        $error = "Une erreur est survenue. Merci de contacter l'administrateur (code 1).";
    }
}

function treat_parameter(string $parameter)
{
    switch ($parameter) {
        case "maneuver":
            return "Manoeuvres";
        case "circulation":
            return "Circulation";
        case "braking":
            return "Freinage";
        case "maneuver_and_circulation":
            return "Manoeuvres et circulation";
    }
}

function is_selected()
{
    $maneuver = "";
    $circulation = "";
    $braking = "";
    $maneuver_and_circulation = "";

    if (!empty($_GET)) {
        switch ($_GET['course']) {
            case "maneuver":
                $maneuver = "selected";
                break;
            case "circulation":
                $circulation = "selected";
                break;
            case "braking":
                $braking = "selected";
                break;
            case "maneuver_and_circulation":
                $maneuver_and_circulation = "selected";
                break;
        }
    }

    return array(
        'maneuver' => $maneuver,
        'circulation' => $circulation,
        'braking' => $braking,
        'maneuver_and_circulation' => $maneuver_and_circulation
    );
}

function display_error()
{
    global $error;

    switch ($error) {
        default:
            echo "";
            break;
        case "name":
            echo "Le nom entré n'est pas valide.";
            break;
        case "firstname":
            echo "Le prénom entré n'est pas valide.";
            break;
        case "tel":
            echo "Le téléphone entré n'est pas valide.";
            break;
        case "email":
            echo "L'email entré n'est pas valide.";
            break;
        case "course":
            echo "Le type de cours entré n'est pas valide.";
            break;
        case "code1":
            echo "Une erreur est survenue. Merci de contacter l'administrateur (code 1).";
            break;
    }
}

require_once "php/view.php";
