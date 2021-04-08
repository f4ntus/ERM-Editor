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
    public function createGeneralisation(EntityModel $supertyp, $x, $y){
        return new GeneralisationModel($supertyp, $x,$y);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $supertyp
     */
    public function changeSupertyp(GeneralisationModel $generalisation, EntityModel $supertyp){
        $generalisation->setSupertyp($supertyp);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public function addSubtyp(GeneralisationModel $generalisation, EntityModel $subtyp){
        $generalisation->addSubtyp($subtyp);
    }

    /**
     * @param GeneralisationModel $generalisation
     * @param EntityModel $subtyp
     */
    public function deletesubtyp(GeneralisationModel $generalisation, EntityModel $subtyp){
        $generalisation->deleteSubtyp($subtyp);
    }

    /**
     * @param RelationshipModel $relation
     * @param int $x
     * @param int $y
     */
    public function changePosition(GeneralisationModel $generalisation, int $x, int $y){
        $generalisation->setX($x);
        $generalisation->setY($y);
    }

    /**
     * Ausgabe der Position
     * @param GeneralisationModel $generalisation
     * @return array
     */
    public function getPosition(GeneralisationModel $generalisation){
        $position = array();
        $position['X'] = $generalisation->getX();
        $position['Y'] = $generalisation->getY();
        return $position;
    }
}