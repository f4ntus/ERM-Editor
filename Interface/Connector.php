<?php

include_once '..\Controller\EntityController.php';
include_once '..\Controller\ERMController.php';
include_once '..\Controller\RelationshipController.php';
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
    if ($_POST['function'] == 'createEntity') {
        // diese Funktion muss natürlich noch angepasst werden
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::addEntity($ERMModel, $_POST['xaxis'], $_POST['yaxis']);
        EntityController::setName($entity, $_POST['name']);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
        var_dump($entity);
    }
    if ($_POST['function']== 'createRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::addRelationship($ERMModel,$_POST['id'],$_POST['name'],$_POST['xaxis'],$_POST['yaxis']);
        $attributes = $_POST['attributes'];
        foreach ($attributes as $attribute){
            RelationshipController::addAttribute($relationship, $attribute['name'], $attribute['typ'], false);
        }
        $_SESSION['ERM-Model'] = $ERMModel;
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
}

?>