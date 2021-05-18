<?php


class RelationRDMModel
{

    private $name;

    private $attributes;

    private $entity;

    /**
     * RelationRDMModel constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->attributes = array();
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
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity): void
    {
        $this->entity = $entity;
    }



}