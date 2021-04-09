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
    public static function createModel()
    {
        return new ERMModel();
    }

    /**
     * Entity wird einem ERM hinzugefügt
     * @param ERMModel $erm
     * @param String $name
     * @param int $x
     * @param int $y
     * @return EntityModel
     */
    public static function addEntity(ERMModel $erm, String $name, int $x, int $y)
    {
        $entity = EntityController::createEntity($name, $x, $y);
        $erm->addEntity($entity);
        return $entity;
    }

    /**
     * Entity wird aus einem ERM entfernt
     * @param ERMModel $erm
     * @param EntityModel $entity
     */
    public static function deleteEntity(ERMModel $erm, EntityModel $entity){
        $erm->deleteEntity($entity);
    }

    public static function printEntities(ERMModel $erm){
        $erm->printEntities();
    }

    /**
     * Hinzufpgen einer Relationship zu einem ERM
     * @param ERMModel $erm
     * @param String $name
     * @param int $x
     * @param int $y
     * @return RelationshipModel
     */
    public static function addRelationship(ERMModel $erm, String $name, int $x, int $y)
    {
        $relationship = RelationshipController::createRelationship($name, $x, $y);
        $erm->addRelationship($relationship);
        return $relationship;
    }

    /**
     * Hinzufügen einer Generaliserung
     * @param ERMModel $erm
     * @param int $x
     * @param int $y
     * @return GeneralisationModel
     */
    public static function addGeneralisation(ERMModel $erm, int $x, int $y)
    {
        $generalisation = GeneralisationController::createGeneralisation($x, $y);
        $erm->addGeneralisation($generalisation);
        return $generalisation;
    }


    /**
     * Löschen einer Entität
     * @param ERMModel $erm
     * @param RelationshipModel $relation
     */
    public static function deleteRelationship(ERMModel $erm, RelationshipModel $relation)
    {
        $erm->deleteRelationship($relation);
    }

    /**
     * Löschen einer Relationship
     * @param ERMModel $erm
     * @param GeneralisationModel $generalisation
     */
    public function deleteGeneralisation(ERMModel $erm, GeneralisationModel $generalisation)
    {
        $erm->deleteGeneralisation($generalisation);
    }

}