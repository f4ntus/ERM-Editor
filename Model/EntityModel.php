<?php
include_once 'ERMObjectModel.php';
/**
 * Class EntityModel
 * Das Modell eines Erstellung
 */

class EntityModel extends ERMObjectwithAttributes
{

    /**
     * Referenz zu OberEnitity
     * @var
     */
    private $superEntity;

    /**
     * EntityModel constructor.
     * @param $id
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct($id, $name , $x, $y)
    {
        $this->id = $id;
        $this->name = $name;
        $this->x = $x;
        $this->y = $y;
        $this->attributes = array();

    }

    /**
     * Attribu wird hinzugefügt
     * @param AttributeERMModel $attribute
     */



    /**
     * Ausgeben der Attrobute
     */
    public function printEntity(){
        echo $this->name.'</br>';
        echo $this->x.'</br>';
        echo $this->y.'</br>';
        foreach ($this->attributes as  $attribute){
            switch($attribute->getType()){
                case 1:
                    echo $attribute->getName().'</br>';
                    break;
                case 2:
                    echo '{'.$attribute->getName().'}'.'</br>';
                    break;
                case 3:
                   // $relatedAttribute = new RelatetedAttributeERMModel();
                    $relatedAttribute = $attribute;
                    echo $relatedAttribute->getName().'(';
                    foreach ($relatedAttribute->getSubnames() as $subname){
                        echo $subname .' ,';
                    }
                    break;

            }
        }
    }


    /**
     * @return mixed
     */
    public function getSuperEntity()
    {
        return $this->superEntity;
    }

    /**
     * @param mixed $superEntity
     */
    public function setSuperEntity($superEntity): void
    {
        $this->superEntity = $superEntity;
    }








}