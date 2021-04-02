<?php


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
    public function addsubtyp(GeneralisationModel $generalisation, EntityModel $subtyp){
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
    public function changePosition(RelationshipModel $relation, int $x, int $y){
        $relation->setX($x);
        $relation->setY($y);
    }
}