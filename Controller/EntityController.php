<?php
include_once '../Model/EntityModel.php';
include_once 'functions.php';

class EntityController
{
    /** Hinzufügen eines Entity
     * @param $name Name
     * @param $x Standort
     * @param $y Standort
     * @return EntityModel
     */
    public static function createEntity(string $id, string $name, int $x, int $y)
    {
        return new EntityModel($id, $name, $x, $y);
    }

    /**
     * Name setzen
     * @param EntityModel $entity
     * @param String $name
     */
    public static function setName(EntityModel $entity, string $name)
    {
        $entity->setName($name);

    }

    /**Name ausgeben
     * @param EntityModel $entity
     * @return mixed
     */
    public static function getName(EntityModel $entity)
    {
        return $entity->getName();

    }

    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param EntityModel $Entity
     * @param Array $attributes
     */
    public static function addOrUpdateAttributes(EntityModel $entity, array $attributes)
    {
        AttributeERMController::addOrUpdateAllAttributes($entity, $attributes);
    }

    /**
     * Ausgabe des Entities in Array Format
     * @param EntityModel $entity
     * @return array
     */
    public static function getEntityAsArray(EntityModel $entity)
    {
        $attributes = AttributeERMController::getAttributes($entity);
        $entityArray = [
            'name' => $entity->getName(),
            'id' => $entity->getId(),
            'attributes' => $attributes
        ];
        return $entityArray;
    }


    /**
     * Hinzufügen eines Attributes
     * @param EntityModel $entity
     * @param String $name
     * @param int $type
     * @param $primary
     * @return AttributeERMModel
     */
    public static function addAttribute(EntityModel $entity, string $name, int $type, $primary)
    {
        $name = cleanNamefromERMObject($entity->getAttributes(), $name);
        $attribute = AttributeERMController::createAttribute($name, $type, $primary);
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

    public static function addRelatedAttribute(EntityModel $entity, string $name, $primary, array $subnames)
    {
        $attribute = AttributeERMController::createRelatedAttribute($name, $primary, $subnames);
        $entity->addAttribute($attribute);
        return $attribute;
    }

    /**
     * @param EntityModel $entity Entity
     * @param AttributeERMModel $attribute Attribute
     */
    public static function deleteAttribute(EntityModel $entity, AttributeERMModel $attribute)
    {
        $entity->deleteAttribute($attribute);
    }

    /** alle Attribute werden gelöscht
     * @param EntityModel $entity
     */
    public static function deleteAllAttributes(EntityModel $entity)
    {
        AttributeERMController::deleteAllAttributes($entity);
    }

    /**
     * Anpassung der Position
     * @param EntityModel $entity Entity
     * @param int $x Standort
     * @param int $y Standort
     */
    public static function changePosition(EntityModel $entity, int $x, int $y)
    {
        $entity->setX($x);
        $entity->setY($y);
    }



    /**
     * Ausgabe der Position
     * @param EntityModel $entity
     * @return array
     */
    public static function getPosition(EntityModel $entity)
    {
        $position = array();
        $position['X'] = $entity->getX();
        $position['Y'] = $entity->getY();
        return $position;
    }


}