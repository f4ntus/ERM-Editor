<?php
/**
 * Class Entity
 * Das Modell eines Erstellung
 */

class Entity
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
     * @var $x
     */
    public $x;
    /**
     * @var $y
     */
    public $y;
    /**
     * @return mixed
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

    public function addattribute($attribute){

    }
}