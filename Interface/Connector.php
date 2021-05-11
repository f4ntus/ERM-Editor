<?php

include_once 'EntityController.php';
include_once 'ERMController.php';
session_start();

if (!isset($_SESSION['ERM-Model'])) {
    $ERMModel = ERMController::createModel();
    $_SESSION['ERM-Model'] = $ERMModel;
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'createEntity') {
        // diese Funktion muss natürlich noch angepasst werden
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addEntity($ERMModel, $_POST['xaxis'], $_POST['yaxis']);
        EntityController::setName($entity, $_POST['name']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
}

?>