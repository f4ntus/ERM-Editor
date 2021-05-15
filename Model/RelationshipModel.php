<?php
include_once 'ERMObjectwithAttributes.php';

/**
 * Class RelationshipModel
 */
class RelationshipModel extends ERMObjectwithAttributes
{


    /**
     * @var $ Enities 2 Demensionale Liste/Array oder was auch immer 1 Dim Kardinalität 2. Dim EntityModel
     */
    private $relations;

    /**
     * RelationshipModel constructor.
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct($id, $name, $x, $y)
    {
        $this->id = $id;
        $this->name = $name;
        $this->x = $x;
        $this->y = $y;
        $this->attributes = array();
        $this->relations = array();
    }







    /**
     * Hinzufügen einer Relation
     * @param RelationERMModel $relation
     */
    public function addRelation(RelationERMModel $relation){
        $this->relations[] = $relation;
    }

    /**
     * Relation wird entfernt
     * @param RelationERMModel $attribute
     */
    public function deleteRelation(RelationERMModel $relation){
        foreach ($this->relations as  $key=>$r){
            if($relation==$r){
                unset($this->relations[$key]);
            }
        }

    }




    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }



    /**
     * @return mixed
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * @param mixed $relations
     */
    public function setRelations($relations)
    {
        $this->relations = $relations;
    }




}