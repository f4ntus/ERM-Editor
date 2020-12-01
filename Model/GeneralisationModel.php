<?php
/**
 * Class GeneralisationModel
 */

class GeneralisationModel
{
    /**
     * @var $name
     */
    private $name;
    private $supertyp;
    private $subtypes;

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
    public function getSupertyp()
    {
        return $this->supertyp;
    }

    /**
     * @param mixed $supertyp
     */
    public function setSupertyp($supertyp)
    {
        $this->supertyp = $supertyp;
    }

    /**
     * @return mixed
     */
    public function getSubtypes()
    {
        return $this->subtypes;
    }

    /**
     * @param mixed $subtypes
     */
    public function setSubtypes($subtypes)
    {
        $this->subtypes = $subtypes;
    }

    public function addsubtyp($subtyp)
    {

    }
}