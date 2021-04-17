<?php
include_once '../Model/GeneralisationModel.php';
include_once '../Model/EntityModel.php';

class GeneralisationERMController
{
    /**
     * @param EntityModel $supertyp
     * @param $x
     * @param $y
     * @return GeneralisationModel
     */
    public static function createGeneralisation($x, $y){
        return new GeneralisationModel($x,$y);

    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $supertyp
     */
    public static function setSupertyp(GeneralisationModel $generalisation, EntityModel $supertyp){
        $generalisation->setSupertyp($supertyp);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public static function addSubtyp(GeneralisationModel $generalisation, EntityModel $subtyp){
        $subtyp->setIsSubtyp(true);
        $generalisation->addSubtyp($subtyp);
    }
    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public static function deleteSubtyp(GeneralisationModel $generalisation, EntityModel $subtyp){
        $generalisation->deleteSubtyp($subtyp);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public static function changePosition(GeneralisationModel $generalisation, int $x, int $y){
        $generalisation->setX($x);
        $generalisation->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param GeneralisationModel $generalisation
     * @return array
     */
    public static function getPosition(GeneralisationModel $generalisation){
        $position = array();
        $position['X'] = $generalisation->getX();
        $position['Y'] = $generalisation->getY();
        return $position;
    }
}