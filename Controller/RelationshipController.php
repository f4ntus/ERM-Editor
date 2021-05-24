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
    public static function addRelation(RelationshipModel $relationship, EntityModel $entity, $kard, $weak)
    {
        $relation = new RelationERMModel($entity, $kard, $weak);
        $relationship->addRelation($relation);
        return $relation;
    }

    public static function addOrUpdateRealtions(ERMModel $ERMModel, RelationshipModel $relationship, array $relations)
    {
        // deleting existing relations
        foreach ($relationship->getRelations() as $relation) {
            RelationshipController::deleteRelation($relationship, $relation);
        }
        //Aufräumen
        if (true) {
            if (count($relations) == 2) { //Zweier Beziehung
                //N:M Beziehung
                if (($relations[0]['notation'] == 'm' or $relations[0]['notation'] == 'n') and ($relations[1]['notation'] == 'm' or $relations[1]['notation'] == 'n')) {
                    $relations[0]['notation'] = '[0,*]';
                    $relations[1]['notation'] = '[0,*]';
                    echo "Test";

                } elseif ($relations[0]['notation'] == '1' and ($relations[1]['notation'] == 'n' or $relations[1]['notation'] == 'm')) { //1:n
                    $relations[0]['notation'] = '[0,*]';
                    $relations[1]['notation'] = '[0,1]';
                } elseif ($relations[1]['notation'] == '1' and ($relations[0]['notation'] == 'n' or $relations[0]['notation'] == 'm')) {//n:1
                    $relations[1]['notation'] = '[0,*]';
                    $relations[0]['notation'] = '[0,1]';
                } elseif ($relations[0]['notation'] == '1' and $relations[1]['notation'] == '1') { //1:1
                    $relations[0]['notation'] = '[0,1]';
                    $relations[1]['notation'] = '[0,1]';
                }
            } else { //Höhere Beziehung
                foreach ($relations as $relationArray) {
                    $relationArray['notation'] = '[0,*]';
                }
            }
        }
        // creating new relations
        foreach ($relations as $relationArray) {
            $entity = $ERMModel->getEntitybyName($relationArray['entity']);
            RelationshipController::addRelation($relationship, $entity, $relationArray['notation'], $relationArray['weakness']);
        }
    }

    /**
     * Name vergeben
     * @param RelationshipModel $relationship
     * @param String $name
     */
    public static function setName(RelationshipModel $relationship, string $name)
    {
        $relationship->setName($name);

    }

    /**
     * Name ausgeben
     * @param RelationshipModel $relationship
     * @return mixed
     *
     */
    public static function getName(RelationshipModel $relationship)
    {
        return $relationship->getName();

    }


    /**
     * Hinzufügen und Updaten mehrerer Attribute
     * @param RelationshipModel $relationship
     * @param Array $attributes
     */
    public static function addOrUpdateAttributes(RelationshipModel $relationship, array $attributes)
    {
        AttributeERMController::addOrUpdateAllAttributes($relationship, $attributes);
    }

    /**
     * Hinzufügen eines Zusammenhängenden Attributes
     * @param RelationshipModel $relationship
     * @param String $name
     * @param $primary
     * @param array $subnames
     * @return RelatetedAttributeERMModel
     */

    public static function addRelatedAttribute(RelationshipModel $relationship, string $name, $primary, array $subnames)
    {
        $attribute = AttributeERMController::createRelatedAttribute($name, $primary, $subnames);
        $relationship->addAttribute($attribute);
        return $attribute;
    }


    /** Attribute wird gelöscht
     * @param RelationshipModel $relationship
     * @param AttributeERMModel $attribute
     */
    public static function deleteAttribute(RelationshipModel $relationship, AttributeERMModel $attribute)
    {
        $relationship->deleteAttribute($attribute);
    }

    /** alle Attribute werden gelöscht
     * @param RelationshipModel $relationship
     */
    public static function deleteAllAttributes(RelationshipModel $relationship)
    {
        AttributeERMController::deleteAllAttributes($relationship);
    }

    /**Relation wird gelöscht
     * @param RelationshipModel $relationship
     * @param RelationERMModel $relation
     */
    public static function deleteRelation(RelationshipModel $relationship, RelationERMModel $relation)
    {
        $relationship->deleteRelation($relation);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public static function changePosition(RelationshipModel $relationship, int $x, int $y)
    {
        $relationship->setX($x);
        $relationship->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param RelationshipModel $relationship
     * @return array
     */
    public static function getPosition(RelationshipModel $relationship)
    {
        $position = array();
        $position['X'] = $relationship->getX();
        $position['Y'] = $relationship->getY();
        return $position;
    }

    /**
     * Ausgabe der Relationship in Array Format
     * @param RelationshipModel $relationship
     * @return array
     */
    public static function getRelationshipAsArray(RelationshipModel $relationship)
    {

        if(true){
            $relationship->changeNotationto1mn();
        }


        $attributes = AttributeERMController::getAttributes($relationship);
        $relationArray = [];
        foreach ($relationship->getRelations() as $relation) {
            $relationArray[] = [
                'entity' => $relation->getEntity()->getName(),
                'notation' => $relation->getKard(),
                'weakness' => $relation->getWeak()
            ];
        }

        $relationshipArray = [
            'name' => $relationship->getName(),
            'id' => $relationship->getId(),
            'relations' => $relationArray,
            'attributes' => $attributes
        ];
        return $relationshipArray;
    }

    public static function getEntities(RelationshipModel $relationship)
    {
        $output = array();
        foreach ($relationship->getRelations() as $relation) {
            $output[] = $relation->getEntity()->getId();
        }
        return $output;

    }


}