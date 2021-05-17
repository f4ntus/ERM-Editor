<?php
include_once '../Model/AttributeERMModel.php';
include_once '../Model/RelatetedAttributeERMModel.php';

class AttributeERMController
{
    /**
     * Erstellung einees normalen(0) oder mehrwertigen Attributes (1)
     * @param String $name
     * @param int $type 1normale_2mehrwertig
     * @param $primary
     * @return AttributeERMModel
     */

    public static function createAttribute(String $name, int $type, $primary){
        return New AttributeERMModel($name, $type, $primary);
    }

    /**
     * Erstellung enes zusammengesetzen Attributes (2)
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */
    public static function createRelatedAttribute(String $name, $primary, array $subnames){
        return New RelatetedAttributeERMModel($name,2, $primary, $subnames);
    }


    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param ERMObjectwithAttributes $ERMObject
     * @param Array $attributes
     */
    public static function addOrUpdateAllAttributes(ERMObjectwithAttributes $ERMObject, array $attributes){
        // delete existing attributes
        AttributeERMController::deleteAllAttributes($ERMObject);

        // create new attributes
        foreach ($attributes as $attributeArray){
            if (($attributeArray['typ'] == '0')|($attributeArray['typ'] == '1')){
                $attribute = AttributeERMController::createAttribute($attributeArray['name'],$attributeArray['typ'],$attributeArray['primary']);
                $ERMObject->addAttribute($attribute);
            }
            if ($attributeArray['typ']=='2'){ //for relatedAttributes
                $relatedAttribute = AttributeERMController::createRelatedAttribute($attributeArray['name'], $attributeArray['primary'], $attributeArray['subattributes']);
                $ERMObject->addAttribute($relatedAttribute);
            }
        }
    }

    /** alle Attribute werden gelöscht
     * @param ERMObjectwithAttributes $ERMObject
     */
    public static function deleteAllAttributes(ERMObjectwithAttributes $ERMObject){
        foreach ($ERMObject->getAttributes() as $attribute){
            $ERMObject->deleteAttribute($attribute);
        }
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

    public static function getAttributeInformation(AttributeERMModel $attribute){
        $information = array();
        $information['name'] = $attribute->getName();
        $information['typ'] = $attribute->getType();
        $information['primary'] = $attribute->getPrimary();
        return $information;
    }


}