<?php
/**
 * Class AttributeERMModel
 * Merkmale von AttributeERMModel
 */
class AttributeERMModel
{
    /**
     * @var $name
     */
    protected $name;
    /**
     * @var $type
     */
    protected $type;
    /**
     * @var $primary
     */
    protected $primary;

    /**
     * AttributeERMModel constructor.
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

    public function getInformations(){
        // diese Funktion muss gelöscht werden
        $information = array();
        $information['Name'] = $this->name;
        $information['Type'] = $this->type;
        $information['Primary'] = $this->primary;
        return $information;
    }


}