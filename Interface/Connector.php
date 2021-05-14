<?php

include_once '../Controller/EntityController.php';
include_once '../Controller/ERMController.php';
include_once '../Controller/RelationshipController.php';
include_once '../Controller/GeneralisationController.php';

session_start();

if (!isset($_SESSION['ERM-Model'])) {
    $ERMModel = ERMController::createModel();
    $_SESSION['ERM-Model'] = $ERMModel;
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'addEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addEntity($ERMModel, $_POST['id'], $_POST['name'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'addRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addRelationship($ERMModel, $_POST['id'], $_POST['name'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'addGeneralisation') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addGeneralisation($ERMModel, $_POST['id'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'changePositionEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        EntityController::changePosition($entity, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'changePositionRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationship($ERMModel, $_POST['id']);
        RelationshipController::changePosition($relationship, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($relationship);
    }
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'changePositionIsA') {
        $ERMModel = $_SESSION['ERM-Model'];
        $isA = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        GeneralisationController::changePosition($isA, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($isA);
    }
}


?>