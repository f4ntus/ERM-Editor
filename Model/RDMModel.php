<?php


class RDMModel
{


    private $relations;



    /**
     * RDMModel constructor.
     */
    public function __construct()
    {
        $this->relations = array();
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        return $this->relations;
    }

    /**
     * @param array $relations
     */
    public function setRelations(array $relations): void
    {
        $this->relations = $relations;
    }

    /**
     * Hinzufügen einer Relation
     * @param RelationRDMModel $relation
     */
    public function addRelation(RelationRDMModel $relation)
    {
        $this->relations[] = $relation;
    }

    public function printRDM(){
        $ausgabe = 'RDM: ';
        foreach ($this->relations as $relation){
            $ausgabe = $ausgabe.$relation->getName().' ( ';
            foreach ($relation->getAttributes() as $attribute){
                $ausgabe = $ausgabe.$attribute->getName().' '.$attribute->getReferences(). ' ';
            }
            $ausgabe = $ausgabe. ' )'.'</br>';
        }
    return $ausgabe;
    }
}