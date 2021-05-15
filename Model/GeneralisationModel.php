<?php
/**
 * Class GeneralisationModel
 */

class GeneralisationModel extends ERMObjectModel
{
    /**
     * @var $name
     */
    private $supertyp;
    private $subtypes;


    /**
     * GeneralisationModel constructor.
     * @param $name
     * @param $x
     * @param $y
     */
    public function __construct($id, $x, $y)
    {
        $this->id = $id;
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






}