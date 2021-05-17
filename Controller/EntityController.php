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
    public static function createEntity(String $id, String $name, int $x, int $y)
    {
        return new EntityModel($id, $name, $x, $y);
    }

    /**
     * Name setzen
     * @param EntityModel $entity
     * @param String $name
     */
    public static function setName(EntityModel $entity, String $name){
        $entity->setName($name);

    }

    /**Name ausgeben
     * @param EntityModel $entity
     * @return mixed
     */
    public static function getName(EntityModel $entity){
        return $entity->getName();

    }

    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param EntityModel $Entity
     * @param Array $attributes
     */
    public static function addOrUpdateAttributes(EntityModel $entity, array $attributes){
        AttributeERMController::addOrUpdateAllAttributes($entity,$attributes);
    }


    /**
     * Hinzufügen eines Attributes
     * @param EntityModel $entity
     * @param String $name
     * @param int $type
     * @param $primary
     * @return AttributeERMModel
     */
    public static function addAttribute(EntityModel $entity, String $name, int $type, $primary){
        $attribute = AttributeERMController::createAttribute($name, $type, $primary)   ;
        $entity->addAttribute($attribute);
        return $attribute;


    }

    /**
     * Hinzufügen eines Zusammenhängenden Attributes
     * @param EntityModel $entity
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */

    public static function addRelatedAttribute(EntityModel $entity, String $name, $primary, array $subnames){
        $attribute = AttributeERMController::createRelatedAttribute($name, $primary, $subnames);
        $entity->addAttribute($attribute);
        return $attribute;
    }

    /**
     * @param EntityModel $entity Entity
     * @param AttributeERMModel $attribute Attribute
     */
    public static function deleteAttribute(EntityModel $entity, AttributeERMModel $attribute){
        $entity->deleteAttribute($attribute);
    }

    /** alle Attribute werden gelöscht
     * @param EntityModel $entity
     */
    public static function deleteAllAttributes(EntityModel $entity){
        AttributeERMController::deleteAllAttributes($entity);
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