
<?php
/**
 * This file connects the frontend and the backend.
 * The function, which should be called is inside the $_POST['function'] variable
 */
include_once '../Controller/EntityController.php';
include_once '../Controller/ERMController.php';
include_once '../Controller/RelationshipController.php';
include_once '../Controller/GeneralisationController.php';
include_once '../Controller/AttributeERMController.php';
include_once '../Controller/RDMController.php';

session_start();

if (!isset($_SESSION['ERM-Model'])) {
    $ERMModel = ERMController::createModel();
    $_SESSION['ERM-Model'] = $ERMModel;
}

if (isset($_POST['function'])) {
    if ($_POST['function'] == 'resetERM') {
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
        $relationship = ERMController::getRelationshipbyID($ERMModel, $_POST['id']);
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
    if ($_POST['function'] == 'getEntity') {
        $entity = ERMController::getEntitybyID($_SESSION['ERM-Model'], $_POST['id']);
        if ($entity != NULL) {
            $entityArray = EntityController::getEntityAsArray($entity);
            echo json_encode($entityArray, JSON_FORCE_OBJECT);
        } else {
            echo 'false';
        }
    }
    if ($_POST['function'] == 'getGeneralisation') {
        $generalisation = ERMController::getGeneralisation($_SESSION['ERM-Model'], $_POST['id']);
        if (!empty($generalisation->getSubtypes()) && !empty($generalisation->getSupertyp())) {
            $generalisationArray = GeneralisationController::getGeneralisationAsArray($generalisation);
            echo json_encode($generalisationArray, JSON_FORCE_OBJECT);
        } else {
            echo 'false';
        }
    }
    if ($_POST['function'] == 'updateEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        EntityController::setName($entity, $_POST['name']);
        if (isset($_POST['attributes'])) { // Entity with attributes
            EntityController::addOrUpdateAttributes($entity, $_POST['attributes']);
        } else { // Entity without attributes
            EntityController::deleteAllAttributes($entity);
        }
        var_dump($entity);
    }
    if ($_POST['function'] == 'updateRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationshipbyID($ERMModel, $_POST['id']);
        RelationshipController::setName($relationship, $_POST['name']);
        //var_dump($_POST);
        if (isset($_POST['attributes'])) { // relationship with attributes
            RelationshipController::addOrUpdateAttributes($relationship, $_POST['attributes']);
        } else { // Relationship without attributes
            RelationshipController::deleteAllAttributes($relationship);
        }
        RelationshipController::addOrUpdateRealtions($ERMModel, $relationship, $_POST['relations']);
        var_dump($relationship);
    }
    if ($_POST['function'] == 'getRelationship') {
        $relationship = ERMController::getRelationshipbyID($_SESSION['ERM-Model'], $_POST['id']);
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
        $relationship = ERMController::getRelationshipbyID($ERMModel, $_POST['id']);
        ERMController::deleteRelationship($ERMModel, $relationship);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
    }
    if ($_POST['function'] == 'deleteIsA') {
        $ERMModel = $_SESSION['ERM-Model'];
        $isA = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        ERMController::deleteGeneralisation($ERMModel, $isA);
        $_SESSION['ERM-Model'] = $ERMModel;
        var_dump($ERMModel);
    }
    if ($_POST['function'] == 'changeERMModel') {
        $ERMModel = $_SESSION['ERM-Model'];
        //var_dump($ERMModel);
        $generalisationType = intval($_POST['generalisationModel']);
        $rdmArray = RDMController::getRDM($ERMModel, $generalisationType);
        echo json_encode($rdmArray, JSON_FORCE_OBJECT);
    }


    if ($_POST['function'] == 'getPositionEntity') {
        $ERMModel = $_SESSION['ERM-Model'];
        $entity = ERMController::getEntitybyID($ERMModel, $_POST['id']);
        $position = EntityController::getPosition($entity);
        echo json_encode(array("X" => $position['X'], "Y" => $position['Y']));
    }

    if ($_POST['function'] == 'getPositionRelationship') {
        $ERMModel = $_SESSION['ERM-Model'];
        $relationship = ERMController::getRelationshipbyID($ERMModel, $_POST['id']);
        $position = RelationshipController::getPosition($relationship);
        echo json_encode(array("X" => $position['X'], "Y" => $position['Y']));
    }

    if ($_POST['function'] == 'getPositionGeneralisation') {
        $ERMModel = $_SESSION['ERM-Model'];
        $generalisation = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        $position = GeneralisationController::getPosition($generalisation);
        echo json_encode(array("X" => $position['X'], "Y" => $position['Y']));
    }


    if ($_POST['function'] == 'updateGeneralisation') {
        $ERMModel = $_SESSION['ERM-Model'];
        $generalisation = ERMController::getGeneralisation($ERMModel, $_POST['id']);
        $array = $_POST['array'];

        for ($i = 0; $i < count($array); $i++) {
            $entity = ERMController::getEntitybyName($ERMModel, $array[$i]);
            if ($i == 0) {
                GeneralisationController::setSupertyp($generalisation, $entity);
            } else {
                GeneralisationController::addSubtyp($generalisation, $entity);
            }
        }
        var_dump($generalisation);
    }

    if ($_POST['function'] == 'getRelations') {
        $relationship = ERMController::getRelationshipbyID($_SESSION['ERM-Model'], $_POST['id']);
        if ($relationship != NULL) {
            $relationshipArray = RelationshipController::getRelations($relationship);
            echo json_encode($relationshipArray, JSON_FORCE_OBJECT);
        } else {
            echo 'false';
        }
    }

    if ($_POST['function'] == 'getSubtypesAndSupertype') {
        $generalisation = ERMController::getGeneralisation($_SESSION['ERM-Model'], $_POST['id']);
        if ($generalisation != NULL) {
            $generalisationArray = GeneralisationController::getSubtypesAndSupertype($generalisation);
            echo json_encode($generalisationArray, JSON_FORCE_OBJECT);
        } else {
            echo 'false';
        }
    }


}


?>