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
     * Name zurückgeben
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Namen setzen
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Typ zurücknehmen
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * type setzen
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Primärschlüssel asugeben (string)
     * @return mixed
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * Primärschlüssel setzen (string)
     * @param mixed $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }



}