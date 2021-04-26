<?php
include_once '../Model/ERMModel.php';
include_once '../Model/EntityModel.php';
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
    public static function addEntity(ERMModel $erm, int $x, int $y)
    {
        $entity = EntityController::createEntity($x, $y);
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
     * Hinzufpgen einer Relationship zu einem ERM
     * @param ERMModel $erm
     * @param String $name
     * @param int $x
     * @param int $y
     * @return RelationshipModel
     */
    public static function addRelationship(ERMModel $erm, int $x, int $y)
    {
        $relationship = RelationshipController::createRelationship($x, $y);
        $erm->addRelationship($relationship);
        return $relationship;
    }

    /**
     * Hinzufügen einer Generaliserung
     * @param ERMModel $erm
     * @param int $x
     * @param int $y
     * @return GeneralisationModel
     */
    public static function addGeneralisation(ERMModel $erm, int $x, int $y)
    {
        $generalisation = GeneralisationERMController::createGeneralisation($x, $y);
        $erm->addGeneralisation($generalisation);
        return $generalisation;
    }


    /**
     * Löschen einer Entität
     * @param ERMModel $erm
     * @param RelationshipModel $relation
     */
    public static function deleteRelationship(ERMModel $erm, RelationshipModel $relation)
    {
        $erm->deleteRelationship($relation);
    }

    /**
     * Löschen einer Relationship
     * @param ERMModel $erm
     * @param GeneralisationModel $generalisation
     */
    public static function deleteGeneralisation(ERMModel $erm, GeneralisationModel $generalisation)
    {
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
        foreach ($erm->getGeneralistions() as $generalisation){
            $supertyp = $generalisation->getSupertyp();
            if($supertyp->getIsSubtyp()) {
                foreach ($generalisation->getSubtypes() as $subtype) {

                    //Die Attribute der Relation hinzufügen
                    foreach ($subtype->getAttributes() as $attribute) {
                        $supertyp->addAttribute($attribute);
                    }
                self::deleteEntity($erm, $subtype);
                }
            }else{
                $supertyp->addAttribute(new AttributeERMModel("Typ", 1, false));
            }
        }
        foreach ($erm->getGeneralistions() as $generalisation) {
            $supertyp = $generalisation->getSupertyp();
            if(!$supertyp->getIsSubtyp()) {
                foreach ($generalisation->getSubtypes() as $subtype) {
                    //Die Attribute der Relation hinzufügen
                    foreach ($subtype->getAttributes() as $attribute) {
                        $supertyp->addAttribute($attribute);
                    }
                self::deleteEntity($erm, $subtype);
                }
            }
        }
    }

}