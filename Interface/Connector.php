<?php

include_once '../Controller/EntityController.php';
include_once '../Controller/ERMController.php';
include_once '../Controller/RelationshipController.php';
include_once '../Controller/GeneralisationController.php';
include_once '..\Controller\AttributeERMController.php';

session_start();

if (!isset($_SESSION['ERM-Model'])) {
    $ERMModel = ERMController::createModel();
    $_SESSION['ERM-Model'] = $ERMModel;
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'resetERM'){
        $ERMModel = ERMController::createModel();
        $_SESSION['ERM-Model'] = $ERMModel;
        echo 'Das ERM Model wurde reseted';
    }
  
    if ($_POST['function'] == 'addEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addEntity($ERMModel, $_POST['id'], $_POST['name'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }

    if ($_POST['function'] == 'addRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::addRelationship($ERMModel, $_POST['id'], $_POST['name'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($relationship);
    }

    if ($_POST['function'] == 'addGeneralisation') {
        $ERMModel = $_SESSION['ERM-Model'];
        $isA = ERMController::addGeneralisation($ERMModel, $_POST['id'], $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($isA);
    }

    if ($_POST['function'] == 'changePositionEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        EntityController::changePosition($entity, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }

    if ($_POST['function'] == 'changePositionRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationship($ERMModel, $_POST['id']);
        RelationshipController::changePosition($relationship, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($relationship);
    }

    if ($_POST['function'] == 'changePositionIsA') {
        $ERMModel = $_SESSION['ERM-Model'];
        $isA = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        GeneralisationController::changePosition($isA, $_POST['xaxis'], $_POST['yaxis']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($isA);
    }
    
    if ($_POST['function']== 'updateRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationship($ERMModel, $_POST['id']);
        RelationshipController::setName($relationship,$_POST['name']);
        RelationshipController::addOrUpdateAttributes($relationship, $_POST['attributes']);
        var_dump($relationship);
    }
    if ($_POST['function'] == 'getRelationship'){
        $relationship = ERMController::getRelationship($_SESSION['ERM-Model'], $_POST['id']);
        if ($relationship != NULL) {
            $relationshipArray = RelationshipController::getRelationshipAsArray($relationship);
            echo json_encode($relationshipArray, JSON_FORCE_OBJECT);
        } else {
            echo 'false';
        }
    }
    //Generalisation Menue
    if ($_POST['function']== 'updateGeneralisation') {
        $ERMModel = $_SESSION['ERM-Model'];
        $generalisation = ERMController::getGeneralisation($_POST['id']);
        $array = $_POST['array'];

        for ($i = 0; $i <= count($array); $i++) {
            $entity = ERMController::getEntitybyName($array[$i]);
            if($i == 0){
                GeneralisationController::setSupertyp($generalisation, $entity);
            }
            else{
                GeneralisationController::addSubtyp($generalisation, $entity);
            }
        }
        var_dump($generalisation);
    }
}


?>