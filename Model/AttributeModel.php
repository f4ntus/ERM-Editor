<?php
/**
 * Class AttributeModel
 * Merkmale von AttributeModel
 */
class AttributeModel
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
     * @var $primary
     */
    private $primary;

    /**
     * AttributeModel constructor.
     * @param $name
     * @param $type
     * @param $primary
     */
    public function __construct($name, $type, $primary)
    {
        $this->name = $name;
        $this->type = $type;
        $this->primary = $primary;
    }

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

    /**
     * @return mixed
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param mixed $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }

}