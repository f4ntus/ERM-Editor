<?php


class RelationRDMModel
{

    private $name;

    private $attributes;

    /**
     * RelationRDMModel constructor.
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

    public function addAttribute(AttributeRDMModel $attribute)
    {
        $this->attributes[] = $attribute;
    }
}