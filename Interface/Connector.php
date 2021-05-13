<?php

include_once '../Controller/EntityController.php';
include_once '../Controller/ERMController.php';
session_start();

if (!isset($_SESSION['ERM-Model'])) {
    $ERMModel = ERMController::createModel();
    $_SESSION['ERM-Model'] = $ERMModel;
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'createEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addEntity($ERMModel, $_POST['id'], $_POST['name'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
    }
}
if (isset($_POST['function2'])) {
    if ($_POST['function2'] == 'setName') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        $entity->setName($_POST['name']);
        echo $entity->getName();
    }
}
if (isset($_POST['function3'])) {
    if ($_POST['function3'] == 'addSingleValueAttributeToEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        $attribute = EntityController::addAttribute($entity, $_POST['name'], 1, $_POST['checked']);
    }
    if ($_POST['function3'] == 'addMultiValueAttributeToEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        $attribute = EntityController::addAttribute($entity, $_POST['name'], 2, false);
    }
    if ($_POST['function3'] == 'addRelatedAttribute') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        $attribute = EntityController::addRelatedAttribute($entity, $_POST['name'], $_POST['checked'], $_POST['subNames']);
    }
}

?>