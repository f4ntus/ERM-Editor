<?php
/**
 * Class Attribute
 * Merkmale von Attribute
 */

class Attribute
{
    /**
     * @var $name
     */
    private $name;
    /**
     * @var $type
     */
    private $type;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}