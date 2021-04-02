<?php
include_once '../Model/AttributeModel.php';
include_once '../Model/RelatetedAttributeModel.php';

class AttributeController
{
    /**
     * Erstellung einees normalen(1) oder mehrwertigen Attributes
     * @param String $name
     * @param int $type 1normale_2mehrwertig
     * @param $primary
     * @return AttributeModel
     */

    public function createAttribute(String $name, int $type, $primary){
        return New AttributeModel($name, $type, $primary);
    }

    /**
     * Erstellung enes zusammengesetzen Attributes
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeModel
     */
    public function createRelatedAttribute(String $name, $primary, array $subnames){
        return New RelatetedAttributeModel($name,3, $primary, $subnames);
    }

    /**Änderung des Primärschlüssels auf aktiv
     * @param AttributeModel $attribute
     */
    public function setPKon(AttributeModel $attribute){
        $attribute->setPrimary(true);
    }

    /**
     * Änderung des Primärschlüssels auf inaktiv
     * @param AttributeModel $attribute
     */
    public function setPKoff(AttributeModel $attribute){
        $attribute->setPrimary(false);
    }

    /**Änderung des Namen
     * @param AttributeModel $attribute
     * @param String $name Name
     */
    public function changeName(AttributeModel $attribute, String $name){
        $attribute->setName($name);
    }
}