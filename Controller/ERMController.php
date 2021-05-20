<?php
include_once '../Model/ERMModel.php';
include_once '../Model/EntityModel.php';
include_once '../Model/ERMObjectModel.php';
/**
 * Class ERMController
 * Diese Klasse ist der Controller bei der Erstellung eines ERMs.
 */

class ERMController
{

    /**
     * Diese Funktion erstelllt ein Modell
     */
    public static function createModel()
    {
        return new ERMModel();
    }

    /**
     * Entity wird einem ERM hinzugefügt
     * @param ERMModel $erm
     * @param String $name
     * @param int $x
     * @param int $y
     * @return EntityModel
     */
    public static function addEntity(ERMModel $erm, String $id, String $name, int $x, int $y)
    {
        $entity = EntityController::createEntity($id, $name, $x, $y);
        $erm->addEntity($entity);
        return $entity;
    }

    /**
     * Entity wird aus einem ERM entfernt
     * @param ERMModel $erm
     * @param EntityModel $entity
     */
    public static function deleteEntity(ERMModel $erm, EntityModel $entity){
        $erm->deleteEntity($entity);
    }

    public static function printEntities(ERMModel $erm){
        $erm->printEntities();
    }

    /**
     * Rückgabe eines Entity nach deren Name
     * @param ERMModel $erm
     * @param String $name
     * @return EntityModel
     */
    public static function getEntitybyName(ERMModel $erm, String $name){
        foreach ($erm->getEntities() as $entity)
        {
            if($entity->getName()==$name){
                $e=$entity;
            }
        }
        if(isset($e)){
            return $e;
        } else {
            return NULL;
        }
    }

    /**
     * Rückgabe eines Entity nach deren ID
     * @param ERMModel $erm
     * @param String $name
     * @return EntityModel
     */
    public static function getEntitybyID(ERMModel $erm, String $id){
        foreach ($erm->getEntities() as $entity)
        {
            if($entity->getID()==$id){
                $e=$entity;
            }
        }
        if(isset($e)){
            return $e;
        } else {
            return NULL;
        }
    }

    /**
     * Hinzufpgen einer Relationship zu einem ERM
     * @param ERMModel $erm
     * @param String $name
     * @param int $x
     * @param int $y
     * @return RelationshipModel
     */
    public static function addRelationship(ERMModel $erm, $id, String $name, int $x, int $y)
    {
        $relationship = RelationshipController::createRelationship($id, $name, $x, $y);
        $erm->addRelationship($relationship);
        return $relationship;
    }

    /**
     * Rückgabe einer Relation nach deren ID
     * @param ERMModel $erm
     * @param String $id
     * @return RelationshipModel
     */
    public static function getRelationship(ERMModel $erm, String $id){
        // find relationship
        foreach ($erm->getRelationships() as $relationship)
        {
            if($relationship->getID()==$id){
                $selectedRelationship=$relationship;
            }
        }
        if(isset($selectedRelationship)){
            return $selectedRelationship;
        } else {
            return NULL;
        }
    }
    /**
     * Hinzufügen einer Generaliserung
     * @param ERMModel $erm
     * @param int $x
     * @param int $y
     * @return GeneralisationModel
     */
    public static function addGeneralisation(ERMModel $erm, $id, int $x, int $y)
    {
        $generalisation = GeneralisationController::createGeneralisation($id, $x, $y);
        $erm->addGeneralisation($generalisation);
        return $generalisation;
    }

    /**
     * Ausgeben einer Generaliserung
     * @param ERMModel $erm
     * @param String $id
     * @return mixed
     */
    public static function getGeneralisation(ERMModel $erm, String $id){
        foreach ($erm->getGeneralistions() as $generalistion)
        {
            if($generalistion->getID()==$id){
                $g=$generalistion;
            }
        }
        if(isset($g)){
            return $g;
        } else {
            return NULL;
        }
    }

    /**
     * Löschen einer Relationship
     * @param ERMModel $erm
     * @param RelationshipModel $relation
     */
    public static function deleteRelationship(ERMModel $erm, RelationshipModel $relation)
    {
        $erm->deleteRelationship($relation);
    }

    /**
     * Löschen einer Generalisierung
     * @param ERMModel $erm
     * @param GeneralisationModel $generalisation
     */
    public static function deleteGeneralisation(ERMModel $erm, GeneralisationModel $generalisation)
    {
        //Alle Subtypes verlieren ihr SuperEntity
        foreach ($generalisation->getSubtypes() as $subtype)
            {
            $subtype->setSuperEntity(NULL);
            }
        $erm->deleteGeneralisation($generalisation);
    }

    /**
     * ERM an ausgewählten Generaliserungstyp anpassen
     * Auswahl des Generaliserungsmodells
     * @param ERMModel $erm
     * @param int $generalisierungstyp
     */
    public static function GeneralisationERM(ERMModel $erm, int $generalisierungstyp){
        switch ($generalisierungstyp){
            case 1:
                self::generalisierungbyHausklassenmodell($erm);
                break;
            case 2;
                self::generalisierungbyPartionierungsmodell($erm);
                break;
            case 3:
                self::generalisierungbyHausklassenmodell($erm);
                break;
            case 4:
                self::generalisierungbyUeberrelation($erm);
                break;
        }
    }

    /**Generaliserung nach Hausklassenmodell
     * @param ERMModel $erm
     */



    private static function generalisierungbyHausklassenmodell (ERMModel $erm){
        foreach ($erm->getGeneralistions() as $generalisation){
            $supertyp = $generalisation->getSupertyp();
            foreach ($generalisation->getSubtypes() as $subtype){
                foreach ($supertyp->getAttributes() as $attribute){
                    $subtype->addAttribute($attribute);
                }

            }
        }

    }

    /**
     * Generaliserung nach Partionierung
     * @param ERMModel $erm
     */
    private static function generalisierungbyPartionierungsmodell (ERMModel $erm){
        foreach ($erm->getGeneralistions() as $generalisation){
            $supertyp = $generalisation->getSupertyp();
            foreach ($generalisation->getSubtypes() as $subtype){
                foreach ($supertyp->getAttributes() as $attribute){
                    if($attribute->getPrimary()){
                        $subtype->addAttribute($attribute);
                    }
                }

            }
        }





    }

    /**
     * Generaliserung nach Überrealtion
     * @param ERMModel $erm
     */
    private static function generalisierungbyUeberrelation (ERMModel $erm){
        $typ = new AttributeERMModel("__Hierarchietyp", 1, false);
        foreach ($erm->getGeneralistions() as $generalisation) {
            $supertyp = $generalisation->getSupertyp();
            do {
                if (null !== $supertyp->getSuperEntity()) {
                    $supertyp = $supertyp->getSuperEntity();
                    $isntTop = true;
                } else {
                    $isntTop = false;
                }

            } while ($isntTop);

            foreach ($generalisation->getSubtypes() as $subtype) {

                //Die Attribute der Relation hinzufügen
                foreach ($subtype->getAttributes() as $attribute) {
                    $supertyp->addAttribute($attribute);
                }
                self::deleteEntity($erm, $subtype);
            }
            if (!in_array($typ, $supertyp->getAttributes())) {
                $supertyp->addAttribute($typ);
            }



            }
        }



}