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
        //var_dump($_POST);
        if (isset($_POST['attributes'])){ // relationship with attributes
            RelationshipController::addOrUpdateAttributes($relationship, $_POST['attributes']);
        }else{ // Relationship without attributes
            RelationshipController::deleteAllAttributes($relationship);
        }
        RelationshipController::addOrUpdateRealtions($ERMModel, $relationship, $_POST['relations']);
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

    if ($_POST['function'] == 'deleteEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        ERMController::deleteEntity($ERMModel, $entity);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
    }
    if ($_POST['function'] == 'deleteRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationship($ERMModel, $_POST['id']);
        ERMController::deleteRelationship($ERMModel, $relationship);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
    }
    if ($_POST['function'] == 'deleteIsA') {
        $ERMModel = $_SESSION['ERM-Model'];
        $isA = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        ERMController::deleteRelationship($ERMModel, $isA);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
    }
}


?>