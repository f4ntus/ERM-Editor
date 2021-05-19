<?php
include_once '../Model/RelationERMModel.php';
include_once '../Model/RelationshipModel.php';
include_once '../Controller/AttributeERMController.php';

class RelationshipController
{
    /**
     * Erstellen einer Relationship
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     * @return RelationshipModel
     */
    public static function createRelationship($id, $name, $x, $y)
    {
        return new RelationshipModel($id, $name, $x, $y);
    }

    /**
     * Hinzufügen einer Relation
     * @param RelationshipModel $relationship
     * @param EntityModel $entity
     * @param $kard
     * @param $weak
     * @return RelationERMModel
     */
    public static function addRelation(RelationshipModel $relationship, EntityModel $entity, $kard, $weak){
        $relation = new RelationERMModel($entity, $kard, $weak);
        $relationship->addRelation($relation);
        return $relation;
    }

    public static function addOrUpdateRealtions(ERMModel $ERMModel, RelationshipModel $relationship, array $relations){
        // deleting existing relations
        foreach ($relationship->getRelations() as $relation){
            RelationshipController::deleteRelation($relationship,$relation);
        }
        // creating new relations
        foreach ($relations as $relationArray){
            $entity = $ERMModel->getEntitybyName($relationArray['entity']);
            RelationshipController::addRelation($relationship,$entity,$relationArray['notation'],$relationArray['weakness']);
        }
    }
    /**
     * Name vergeben
     * @param RelationshipModel $relationship
     * @param String $name
     */
    public static function setName(RelationshipModel $relationship, String $name){
        $relationship->setName($name);

    }

    /**
     * Name ausgeben
     * @param RelationshipModel $relationship
     * @return mixed
     *
     */
    public static function getName(RelationshipModel $relationship){
        return $relationship->getName();

    }


    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param RelationshipModel $relationship
     * @param Array $attributes
     */
    public static function addOrUpdateAttributes(RelationshipModel $relationship, array $attributes){
        AttributeERMController::addOrUpdateAllAttributes($relationship,$attributes);
    }

    /**
     * Hinzufügen eines Zusammenhängenden Attributes
     * @param RelationshipModel $relationship
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */

    public static function addRelatedAttribute(RelationshipModel $relationship, String $name, $primary, array $subnames){
        $attribute = AttributeERMController::createRelatedAttribute($name, $primary, $subnames);
        $relationship->addAttribute($attribute);
        return $attribute;
    }


    /** Attribute wird gelöscht
     * @param RelationshipModel $relationship
     * @param AttributeERMModel $attribute
     */
    public static function deleteAttribute(RelationshipModel $relationship, AttributeERMModel $attribute){
        $relationship->deleteAttribute($attribute);
    }

    /** alle Attribute werden gelöscht
     * @param RelationshipModel $relationship
     */
    public static function deleteAllAttributes(RelationshipModel $relationship){
        AttributeERMController::deleteAllAttributes($relationship);
    }

    /**Relation wird gelöscht
     * @param RelationshipModel $relationship
     * @param RelationERMModel $relation
     */
    public static function deleteRelation(RelationshipModel $relationship, RelationERMModel $relation){
        $relationship->deleteRelation($relation);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public static function changePosition(RelationshipModel $relationship, int $x, int $y){
        $relationship->setX($x);
        $relationship->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param RelationshipModel $relationship
     * @return array
     */
    public static function getPosition(RelationshipModel $relationship){
        $position = array();
        $position['X'] = $relationship->getX();
        $position['Y'] = $relationship->getY();
        return $position;
    }

    /**
     * Ausgabe der Relationship in Array Format
     * @param RelationshipModel $relationship
     * @return array
     */
    public static function getRelationshipAsArray(RelationshipModel $relationship){
        $attributes = AttributeERMController::getAttributes($relationship);
        $relationshipArray = [
            'name' => $relationship->getName(),
            'id' => $relationship->getId(),
            'attributes' => $attributes
        ];
        return $relationshipArray;
    }



}