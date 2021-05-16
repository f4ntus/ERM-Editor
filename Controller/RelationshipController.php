<?php
include_once '../Model/RelationERMModel.php';
include_once '../Model/RelationshipModel.php';
include_once '../Controller/AttributeERMController.php';

class RelationshipController
{
    /**
     * Erstellen einer Relationship
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     * @return RelationshipModel
     */
    public static function createRelationship($id, $name, $x, $y)
    {
        return new RelationshipModel($id, $name, $x, $y);
    }

    /**
     * Hinzufügen einer Relation
     * @param RelationshipModel $relationship
     * @param EntityModel $entity
     * @param $kard
     * @param $weak
     * @return RelationERMModel
     */
    public static function addRelation(RelationshipModel $relationship, EntityModel $entity, $kard, $weak){
        $relation = new RelationERMModel($entity, $kard, $weak);
        $relationship->addRelation($relation);
        return $relation;
    }

    public static function addOrUpdateRealtions(ERMModel $ERMModel, RelationshipModel $relationship, array $relations){
        // deleting existing relations
        foreach ($relationship->getRelations() as $relation){
            RelationshipController::deleteRelation($relation);
        }
        // creating new relations
        foreach ($relations as $relationArray){
            $entity = $ERMModel->getEntitybyName($relationArray['entity']);
            RelationshipController::addRelation($relationship,$entity,$relationArray['notation'],$relation['waekness']);
        }
    }
    /**
     * Name vergeben
     * @param RelationshipModel $relationship
     * @param String $name
     */
    public static function setName(RelationshipModel $relationship, String $name){
        $relationship->setName($name);

    }

    /**
     * Name ausgeben
     * @param RelationshipModel $relationship
     * @return mixed
     *
     */
    public static function getName(RelationshipModel $relationship){
        return $relationship->getName();

    }


    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param RelationshipModel $relationship
     * @param Array $attributes
     */
    public static function addOrUpdateAttributes(RelationshipModel $relationship, array $attributes){
        // delete existing attributes
        RelationshipController::deleteAllAttributes($relationship);

        // create new attributes
        foreach ($attributes as $attributeArray){
            if (($attributeArray['typ'] == '0')|($attributeArray['typ'] == '1')){
                $attribute = AttributeERMController::createAttribute($attributeArray['name'],$attributeArray['typ'],$attributeArray['primary']);
                $relationship->addAttribute($attribute);
            }
            if ($attributeArray['typ']=='2'){ //for relatedAttributes
                $relatedAttribute = AttributeERMController::createRelatedAttribute($attributeArray['name'], $attributeArray['primary'], $attributeArray['subattributes']);
                $relationship->addAttribute($relatedAttribute);
            }
        }
    }

    /**
     * Hinzufügen eines Zusammenhängenden Attributes
     * @param RelationshipModel $relationship
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */

    public static function addRelatedAttribute(RelationshipModel $relationship, String $name, $primary, array $subnames){
        $attribute = AttributeERMController::createRelatedAttribute($name, $primary, $subnames);
        $relationship->addAttribute($attribute);
        return $attribute;
    }


    /** Attribute wird gelöscht
     * @param RelationshipModel $relationship
     * @param AttributeERMModel $attribute
     */
    public static function deleteAttribute(RelationshipModel $relationship, AttributeERMModel $attribute){
        $relationship->deleteAttribute($attribute);
    }

    /** alle Attribute werden gelöscht
     * @param RelationshipModel $relationship
     */
    public static function deleteAllAttributes(RelationshipModel $relationship){
        foreach ($relationship->getAttributes() as $attribute){
            RelationshipController::deleteAttribute($relationship, $attribute);
        }
    }

    /**Relation wird gelöscht
     * @param RelationshipModel $relationship
     * @param RelationERMModel $relation
     */
    public static function deleteRelation(RelationshipModel $relationship, RelationERMModel $relation){
        $relationship->deleteRelation($relation);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public static function changePosition(RelationshipModel $relationship, int $x, int $y){
        $relationship->setX($x);
        $relationship->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param RelationshipModel $relationship
     * @return array
     */
    public static function getPosition(RelationshipModel $relationship){
        $position = array();
        $position['X'] = $relationship->getX();
        $position['Y'] = $relationship->getY();
        return $position;
    }
    public static function getRelationshipAsArray(RelationshipModel $relationship){
        $attributes = RelationshipController::getAttributes($relationship);
       /* $i = 0;
        $attributeArray = null;
        foreach ($attributes as $attribute) {
            $attributeArray[$i] = [
                'name' => $attribute["Name"],
                'typ' => $attribute["Type"]
            ];
            $i++;
        }*/
        $relationshipArray = [
            'name' => $relationship->getName(),
            'id' => $relationship->getId(),
            'attributes' => $attributes
        ];
        return $relationshipArray;
    }
     public static function getAttributes(RelationshipModel $relationship){
        $attributes = array();
        foreach ($relationship->getAttributes() as  $a){
            $attributes[] = AttributeERMController::getAttributeInformation($a);
        }
        return $attributes;
    }


}