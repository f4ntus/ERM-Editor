<?php
include_once '../Model/AttributeERMModel.php';
include_once '../Model/RelatetedAttributeERMModel.php';

class AttributeERMController
{
    /**
     * Erstellung einees normalen(1) oder mehrwertigen Attributes
     * @param String $name
     * @param int $type 1normale_2mehrwertig
     * @param $primary
     * @return AttributeERMModel
     */

    public static function createAttribute(String $name, int $type, $primary){
        return New AttributeERMModel($name, $type, $primary);
    }

    /**
     * Erstellung enes zusammengesetzen Attributes
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */
    public static function createRelatedAttribute(String $name, $primary, array $subnames){
        return New RelatetedAttributeERMModel($name,3, $primary, $subnames);
    }

    /**Änderung des Primärschlüssels auf aktiv
     * @param AttributeERMModel $attribute
     */
    public static function setPKon(AttributeERMModel $attribute){
        $attribute->setPrimary(true);
    }

    /**
     * Änderung des Primärschlüssels auf inaktiv
     * @param AttributeERMModel $attribute
     */
    public static function setPKoff(AttributeERMModel $attribute){
        $attribute->setPrimary(false);
    }

    /**Änderung des Namen
     * @param AttributeERMModel $attribute
     * @param String $name Name
     */
    public static function changeName(AttributeERMModel $attribute, String $name){
        $attribute->setName($name);
    }



}