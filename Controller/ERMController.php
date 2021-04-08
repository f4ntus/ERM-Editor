<?php
include_once '../Model/ERMModel.php';
include_once '../Model/EntityModel.php';
/**
 * Class ERMController
 * Diese Klasse ist der Controller bei der Erstellung eines ERMs.
 */

class ERMController
{

    /**
     * Diese Funktion erstelllt ein Modell
     */
    public function createModel()
    {
        return new ERMModel();
    }


    public function addEntity(ERMModel $erm, EntityModel $entity )
    {
        $erm->addEntity($entity);
    }

    public function deleteEntity(ERMModel $erm, EntityModel $entity){
        $erm->deleteEntity($entity);
    }

    public function printEntities(ERMModel $erm){
        $erm->printEntities();
    }
    /**
     * Diese Funktion fügt eine RelationshipModel hinzu
     */
    public function addRelationship()
    {

    }

    /**
     * Diese Funktion fügt eine Generalisierung hinzu
     */
    public function addGeneralisation()
    {

    }


    /**
     * Diese Funktion entfernt eine RelationshipModel
     */
    public function deleteRelationship()
    {

    }

    /**
     * Diese Funktion entfernt eine Generalisierung
     */
    public function deleteGeneralisation()
    {

    }

}