<?php
include_once '../Model/RelationModel.php';
include_once '../Model/RelationshipModel.php';

class RelationshipController
{
    public function createRelationship($name, $x, $y)
    {
        return new RelationshipModel($name, $x, $y);
    }

    public function addRelation(RelationshipModel $relationship, EntityModel $entity, $kard, $weak){
        $relation = new RelationModel($entity, $kard, $weak);
        $relationship->addRelation($relation);
        return $relation;
    }

    /**
     * @param RelationshipModel $relationship
     * @param AttributeModel $attribute
     */
    public function addAttribute(RelationshipModel $relationship, AttributeModel $attribute){
        $relationship->addAttribute($attribute);


    }


    /**
     * @param RelationshipModel $relationship
     * @param AttributeModel $attribute
     */
    public function deleteAttribute(RelationshipModel $relationship, AttributeModel $attribute){
        $relationship->deleteAttribute($attribute);
    }

    public function deleteRelation(RelationshipModel $relationship, RelationModel $relation){
        $relationship->deleteRelation($relation);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public function changePosition(RelationshipModel $relationship, int $x, int $y){
        $relationship->setX($x);
        $relationship->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param RelationshipModel $relationship
     * @return array
     */
    public function getPosition(RelationshipModel $relationship){
        $position = array();
        $position['X'] = $relationship->getX();
        $position['Y'] = $relationship->getY();
        return $position;
    }

    public function getAttributes(RelationshipModel $relationship){
        $attributes = array();

        foreach ($relationship->getAttributes() as  $a){

                $attributes[] = $a->getInformations();
                   }

        return $attributes;

    }


}