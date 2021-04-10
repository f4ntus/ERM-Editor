<?php
/**
 * Class EntityModel
 * Das Modell eines Erstellung
 */

class EntityModel
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
     * @var $x Standort der Variable
     */
    public $x;
    /**
     * @var $y Standort der Variable
     */
    public $y;
    /**
     * @return mixed
     */

    /**
     * EntityModel constructor.
     * @param $name
     * @param $x Standort
     * @param $y Standort
     */
    public function __construct($name, $x, $y)
    {
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
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

}