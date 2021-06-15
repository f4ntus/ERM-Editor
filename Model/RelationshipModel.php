<?php
include_once 'ERMObjectwithAttributesModel.php';

/**
 * Class RelationshipModel
 */
class RelationshipModel extends ERMObjectwithAttributesModel
{


    /**
     * @var $ Enities 2 Demensionale Liste/Array oder was auch immer 1 Dim Kardinalität 2. Dim EntityModel
     */
    private $relations;

    /**
     * RelationshipModel constructor.
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct($id, $name, $x, $y)
    {
        $this->id = $id;
        $this->name = $name;
        $this->x = $x;
        $this->y = $y;
        $this->attributes = array();
        $this->relations = array();
    }







    /**
     * Hinzufügen einer Relation
     * @param RelationERMModel $relation
     */
    public function addRelation(RelationERMModel $relation){
        $this->relations[] = $relation;
    }

    /**
     * Relation wird entfernt
     * @param RelationERMModel $attribute
     */
    public function deleteRelation(RelationERMModel $relation){
        foreach ($this->relations as  $key=>$r){
            if($relation==$r){
                unset($this->relations[$key]);
            }
        }

    }




    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }



    /**
     * @return mixed
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * @param mixed $relations
     */
    public function setRelations($relations)
    {
        $this->relations = $relations;
    }

    /**
     * Die Notation des Objektes in eine 1mn Notation anpassen
     */
    public function changeNotationto1mn()
    {
        if (count($this->relations) == 2) {
            $relation1 = current($this->relations);
            $relation2 = next($this->relations);
            //Vereinfach von [0,1], [1,1] -> A und [0,*], [1,*] -> B
            switch ($relation1->getKard()) {
                case '[0,1]':
                case '[1,1]':
                    $r1 = 'A';
                    break;
                case '[0,*]':
                case '[1,*]':
                    $r2 = 'B';
                    break;

            }

            switch ($relation2->getKard()) {
                case '[0,1]':
                case '[1,1]':
                    $r1 = 'A';
                    break;
                case '[0,*]':
                case '[1,*]':
                    $r2 = 'B';
                    break;

            }

            if ($r1 == 'A' and $r2 == 'B') {//n:1

                $relation1->setKard('n');
                $relation2->setKard('1');
            } elseif ($r1 == 'B' and $r2 == 'A') { //1:n
                $relation1->setKard('1');
                $relation2->setKard('n');
            } elseif ($r1 == 'B' and $r2 == 'B') { //m:n
                $relation1->setKard('m');
                $relation2->setKard('n');
            }
        } else {
            foreach ($this->relations as $relation) {
                $relation->setKard('n');
            }
        }
    }



}