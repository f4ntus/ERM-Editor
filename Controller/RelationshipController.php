<?php
include_once '../Model/RelationERMModel.php';
include_once '../Model/RelationshipModel.php';

class RelationshipController
{
    public static function createRelationship($name, $x, $y)
    {
        return new RelationshipModel($name, $x, $y);
    }

    public static function addRelation(RelationshipModel $relationship, EntityModel $entity, $kard, $weak){
        $relation = new RelationERMModel($entity, $kard, $weak);
        $relationship->addRelation($relation);
        return $relation;
    }


    /**
     * Hinzufügen eines Attributes
     * @param RelationshipModel $relationship
     * @param String $name
     * @param int $type
     * @param $primary
     * @return AttributeERMModel
     */
    public static function addAttribute(RelationshipModel $relationship, String $name, int $type, $primary){
        $attribute = AttributeERMController::createAttribute($name, $type, $primary)   ;
        $relationship->addAttribute($attribute);
        return $attribute;


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

    public static function getAttributes(RelationshipModel $relationship){
        $attributes = array();

        foreach ($relationship->getAttributes() as  $a){

                $attributes[] = $a->getInformations();
                   }

        return $attributes;

    }


}