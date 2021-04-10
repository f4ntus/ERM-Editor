<?php


class RelatetedAttributeERMModel extends AttributeERMModel
{
   private $subnames;

    /**
     * RelatetedAttributeERMModel constructor.
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

    public function getInformations()
    {
        $information = array();
        $name = $this->name . ' (';
        foreach ($this->subnames as $s) {
            $name = $name . ' ' . $s;
        }
        $name = $name . ')';

        $information['Name'] = $name;
        $information['Type'] = $this->type;
        $information['Primary'] = $this->primary;
        return $information;
    }


}