<?php
include_once 'ERMObjectModel.php';
/**
 * Class EntityModel
 * Das Modell eines Erstellung
 */

class EntityModel extends ERMObjectModel
{
    /**
     * @var $name
     */
    private $name;
    /**
     * @var$attributes
     * Das ist eine Liste/Array oder was auch immer
     */
    private $attributes;
    /**
     * @return mixed
     */
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

    public function addAttribute(AttributeERMModel $attribute){
        $this->attributes[] = $attribute;
    }

    /**
     * Attribut wird entfernt
     * @param AttributeERMModel $attribute
     */
    public function deleteAttribute(AttributeERMModel $attribute){
        foreach ($this->attributes as  $key=>$a){
             if($attribute==$a){
                 unset($this->attributes[$key]);
             }
        }

    }

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
     * @return mixed $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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