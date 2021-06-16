<?php

include_once 'ERMObjectwithAttributesModel.php';

/**
 * Class EntityModel
 * Das Modell eines Erstellung
 */

class EntityModel extends ERMObjectwithAttributesModel
{

    /**
     * Referenz zu OberEnitity
     * @var
     */
    private $superEntity;

    /**
     * EntityModel constructor.
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct($id, $name , $x, $y)
    {
        $this->id = $id;
        $this->name = $name;
        $this->x = $x;
        $this->y = $y;
        $this->attributes = array();

    }

    /**
     * @return mixed
     */
    public function getSuperEntity()
    {
        return $this->superEntity;
    }

    /**
     * @param mixed $superEntity
     */
    public function setSuperEntity($superEntity): void
    {
        $this->superEntity = $superEntity;
    }






}