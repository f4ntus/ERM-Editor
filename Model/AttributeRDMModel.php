<?php


class AttributeRDMModel
{
    private $name;

    private $primary;

    private $references;

    /**
     * AttributeRDMModel constructor
     */
    public function __construct()
    {
        $this->references = ' ';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
    public function setPrimary($primary): void
    {
        $this->primary = $primary;
    }

    /**
     * @return string
     */
    public function getReferences(): string
    {
        return $this->references;
    }

    /**
     * @param EntityModel $entity
     */
    public function setReferences(String $relationname): void
    {
        $name = 'REF '. $relationname;
        $this->references = $name;
    }


}