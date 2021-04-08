<?php
include_once '../Model/EntityModel.php';

class EntityController
{
    /** Hinzufügen eines Entity
     * @param $name Name
     * @param $x Standort
     * @param $y Standort
     * @return EntityModel
     */
    public function createEntity($name, $x, $y)
    {
        return new EntityModel($name, $x, $y);
    }

    /**
     * @param EntityModel $entity Entity
     * @param AttributeModel $attribute Attribut
     */
    public function addAttribute(EntityModel $entity, AttributeModel $attribute){
            $entity->addAttribute($attribute);


    }

    /**
     * @param EntityModel $entity Entity
     * @param AttributeModel $attribute Attribute
     */
    public function deleteAttribute(EntityModel $entity, AttributeModel $attribute){
        $entity->deleteAttribute($attribute);
    }

    /**
     * Anpassung der Position
     * @param EntityModel $entity Entity
     * @param int $x Standort
     * @param int $y Standort
     */
    public function changePosition(EntityModel $entity, int $x, int $y){
        $entity->setX($x);
        $entity->setY($y);
    }
    public function printEntity(EntityModel $entity){
        $entity->printEntity();
    }

    /**
     * Ausgabe der Position
     * @param EntityModel $entity
     * @return array
     */
    public function getPosition(EntityModel $entity){
        $position = array();
        $position['X'] = $entity->getX();
        $position['Y'] = $entity->getY();
    return $position;
    }

    public function getAttributes(EntityModel $entity){
        $attributes = array();

        foreach ($entity->getAttributes() as  $a) {
            $attributes[] = $a->getInformations();
        }

        return $attributes;

    }



}