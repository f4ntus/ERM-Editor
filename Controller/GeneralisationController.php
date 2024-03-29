<?php
include_once '../Model/GeneralisationModel.php';
include_once '../Model/EntityModel.php';

class GeneralisationController
{
    /**
     * @param EntityModel $supertyp
     * @param $x
     * @param $y
     * @return GeneralisationModel
     */
    public static function createGeneralisation(string $id, int $x, int $y)
    {
        return new GeneralisationModel($id, $x, $y);

    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $supertyp
     */
    public static function setSupertyp(GeneralisationModel $generalisation, EntityModel $supertyp)
    {
        $generalisation->setSupertyp($supertyp);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public static function addSubtyp(GeneralisationModel $generalisation, EntityModel $subtyp)
    {
        $subtyp->setSuperEntity($generalisation->getSupertyp());
        $generalisation->addSubtyp($subtyp);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public static function deleteSubtyp(GeneralisationModel $generalisation, EntityModel $subtyp)
    {
        $subtyp->setSuperEntity(NULL);
        $generalisation->deleteSubtyp($subtyp);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public static function changePosition(GeneralisationModel $generalisation, int $x, int $y)
    {
        $generalisation->setX($x);
        $generalisation->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param GeneralisationModel $generalisation
     * @return array
     */
    public static function getPosition(GeneralisationModel $generalisation)
    {
        $position = array();
        $position['X'] = $generalisation->getX();
        $position['Y'] = $generalisation->getY();
        return $position;
    }

    /**
     * Ausgabe der Generalisierung in Array Format
     * @param EntityModel $generalisation
     * @return array
     */
    public static function getGeneralisationAsArray(GeneralisationModel $generalisation){

        $generalisationArray = [
            'id' => $generalisation->getId(),
            'supertype' => GeneralisationController::getSupertypeAsArray($generalisation),
            'subtypes' => GeneralisationController::getSubtypesAsArray($generalisation)
        ];
        return $generalisationArray;

    }

    /**
     * Ausgabe eines Supertyps in Array Format
     * @param EntityModel $generalisation
     * @return array
     */
    public static function getSupertypeAsArray(GeneralisationModel $generalisation){

        return EntityController::getEntityAsArray($generalisation->getSupertyp());
    }

    /**
     * Ausgabe der Subtypen in Array Format
     * @param EntityModel $generalisation
     * @return array
     */
    public static function getSubtypesAsArray(GeneralisationModel $generalisation){
        $subtypeArray = [];
        foreach ($generalisation->getSubtypes() as $subtype) {
            $subtypeArray[] = EntityController::getEntityAsArray($subtype);
        }
        return $subtypeArray;
    }

    /**
     * Ausgabe der Subtypen und des Supertypes einer Generalisierung in Array Format
     * @param EntityModel $generalisation
     * @return array
     */
    public static function getSubtypesAndSupertype(GeneralisationModel $generalisation){
        $typeArray = [];
        $typeArray[] = EntityController::getEntityAsArray($generalisation->getSupertyp());
        foreach ($generalisation->getSubtypes() as $subtype) {
            $typeArray[] = EntityController::getEntityAsArray($subtype);
        }
        return $typeArray;
    }
}