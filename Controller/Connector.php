<?php
include_once 'EntityController.php';
include_once 'ERMController.php';
$ERMModel = NULL;
if (isset($_POST['function'])){
    if ($_POST['function'] == 'createEntity'){
        if ($ERMModel == NULL ){
            $ERMModel = ERMController::createModel();
        }
        $entity = ERMController::addEntity($ERMModel,$_POST['xaxis'],$_POST['yaxis']);
        EntityController::setName($entity, $_POST['name']);
        var_dump($ERMModel);
        var_dump($entity);
    }
}
if (isset($_GET['function'])){
    if ($_GET['function'] == 'getEntities'){
        echo "Hallo";
        var_dump($ERMModel);
        ERMController::printEntities($ERMModel);
    }
}
?>
