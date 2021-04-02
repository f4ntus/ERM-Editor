<?php


class RelatetedAttributeModel extends AttributeModel
{
   private $subnames;

    /**
     * RelatetedAttributeModel constructor.
     * @param $name
     * @param $type
     * @param $primary
     * @param $subnames Array_mitNamen
     */
   public function __construct($name, $type, $primary, $subnames)
   {
       parent::__construct($name, $type, $primary);
       $this->subnames = $subnames;
   }

    /**
     * @return mixed
     */
    public function getSubnames()
    {
        return $this->subnames;
    }

    /**
     * @param mixed $subnames
     */
    public function setSubnames($subnames)
    {
        $this->subnames = $subnames;
    }


}