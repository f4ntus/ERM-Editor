<?php
include_once '../Model/RelationModel.php';
include_once '../Model/RelationshipModel.php';

class RelationshipController
{
    public function createRelationship($name, $x, $y)
    {
        return new RelationshipModel($name, $x, $y);
    }

    public function addRelation(RelationshipModel $relationship, EntityModel $entity, $kardmin, $kardmax, $weak){
        $relation = new RelationModel($entity, $kardmin, $kardmax, $weak);
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
    public function changePosition(RelationshipModel $relation, int $x, int $y){
        $relation->setX($x);
        $relation->setY($y);
    }


}