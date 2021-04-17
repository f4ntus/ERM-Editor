<?php
/**
 * Class GeneralisationModel
 */

class GeneralisationModel
{
    /**
     * @var $name
     */
    private $supertyp;
    private $subtypes;
    private $x;
    private $y;

    /**
     * GeneralisationModel constructor.
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct( $x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->subtypes = array();

    }

    /**
     * Subtyp hinzufügen
     * @param EntityModel $subtyp
     */
    public function addSubtyp(EntityModel $subtyp){
        $this->subtypes[] = $subtyp;
    }

    /**
     * Löschen eines Subtypes
     * @param EntityModel $subtyp
     */
    public function deleteSubtyp(EntityModel $subtyp){
        foreach ($this->subtypes as  $key=>$s){
            if($subtyp==$s){
                unset($this->relations[$key]);
            }
        }

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
    public function getSupertyp()
    {
        return $this->supertyp;
    }

    /**
     * @param mixed $supertyp
     */
    public function setSupertyp(EntityModel $supertyp)
    {
        $this->supertyp = $supertyp;
    }

    /**
     * @return array
     */
    public function getSubtypes()
    {
        return $this->subtypes;
    }

    /**
     * @param array $subtypes
     */
    public function setSubtypes($subtypes)
    {
        $this->subtypes = $subtypes;
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