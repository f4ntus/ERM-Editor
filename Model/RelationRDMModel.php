<?php


class RelationRDMModel
{

    private $name;

    private $attributes;

    private $ermobjects;

    /**
     * RelationRDMModel constructor.
     * @param $name
     */
    public function __construct($name, $ermobject)
    {
        $this->name = $name;
        $this->attributes = array();
        $this->ermobjects = array();
        self::addERMobject($ermobject);
    }


    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * Hinzufügen eines Attributes
     * @param AttributeRDMModel $attribute
     */
    public function addAttribute(AttributeRDMModel $attribute)
    {
        $this->attributes[] = $attribute;
    }

    /**
     * @param EntityModel $Entity
     */
    public function addERMobject($ermobject)
    {
        $this->ermobjects[] = $ermobject;
    }

    /**
     * Diese Funktion entfernt eine Entität
     */
    public function deleteERMobject($ermobject)
    {
        foreach ($this->ermobjects as $key => $a) {
            if ($ermobject == $a) {
                unset($this->ermobjects[$key]);
            }
        }
    }

    /**
     * @return array
     */
    public function getERMobjects(): array
    {
        return $this->ermobjects;
    }

    /**
     * @param array $ermobjects
     */
    public function setERMobjects(array $ermobjects): void
    {
        $this->ermobjects = $ermobjects;
    }

}