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
    public static function createEntity($name, $x, $y)
    {
        return new EntityModel($name, $x, $y);

    }


    /**
     * Hinzufügen eines Attributes
     * @param EntityModel $entity
     * @param String $name
     * @param int $type
     * @param $primary
     * @return AttributeModel
     */
    public static function addAttribute(EntityModel $entity, String $name, int $type, $primary){
        $attribute = AttributeController::createAttribute($name, $type, $primary)   ;
        $entity->addAttribute($attribute);
        return $attribute;


    }

    /**
     * Hinzufügen eines Zusammenhängenden Attributes
     * @param EntityModel $entity
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeModel
     */

    public static function addRelatedAttribute(EntityModel $entity, String $name, $primary, array $subnames){
        $attribute = AttributeController::createRelatedAttribute($name, $primary, $subnames);
        $entity->addAttribute($attribute);
        return $attribute;
    }

    /**
     * @param EntityModel $entity Entity
     * @param AttributeModel $attribute Attribute
     */
    public static function deleteAttribute(EntityModel $entity, AttributeModel $attribute){
        $entity->deleteAttribute($attribute);
    }

    /**
     * Anpassung der Position
     * @param EntityModel $entity Entity
     * @param int $x Standort
     * @param int $y Standort
     */
    public static function changePosition(EntityModel $entity, int $x, int $y){
        $entity->setX($x);
        $entity->setY($y);
    }
    public static function printEntity(EntityModel $entity){
        $entity->printEntity();
    }

    /**
     * Ausgabe der Position
     * @param EntityModel $entity
     * @return array
     */
    public static function getPosition(EntityModel $entity){
        $position = array();
        $position['X'] = $entity->getX();
        $position['Y'] = $entity->getY();
    return $position;
    }

    /**
     * Relevante Information aller Attribute erhalten
     * @param EntityModel $entity
     * @return array
     */
    public static function getAttributes(EntityModel $entity){
        $attributes = array();

        foreach ($entity->getAttributes() as  $a) {
            $attributes[] = $a->getInformations();
        }

        return $attributes;

    }



}