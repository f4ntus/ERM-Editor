<?php


/**
 * Class RelationshipModel
 */
class RelationshipModel extends ERMObjectModel
{
    /**
     * @var $name
     */
    private $name;

    /**
     * @var$attributes
     * Das ist eine  Liste/Array oder was auch immer
     */

    private $attributes;

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
     * Attribu wird hinzugefügt
     * @param AttributeERMModel $attribute
     */

    public function addAttribute(AttributeERMModel $attribute){
        $this->attributes[] = $attribute;
    }

    /**
     * Attribut wird entfernt
     * @param AttributeERMModel $attribute
     */
    public function deleteAttribute(AttributeERMModel $attribute){
        foreach ($this->attributes as  $key=>$a){
            if($attribute==$a){
                unset($this->attributes[$key]);
            }
        }

    }

    /**
     * Hinzufügen einer Relation
     * @param RelationERMModel $relation
     */
    public function addRelation(RelationERMModel $relation){
        $this->relations[] = $relation;
    }

    /**
     * Attribut wird entfernt
     * @param AttributeERMModel $attribute
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

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param mixed $entities
     */
    public function setEntities($entities)
    {
        $this->entities = $entities;
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

    /**
     * @return int
     */




}