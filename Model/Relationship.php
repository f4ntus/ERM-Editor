<?php


/**
 * Class Relationship
 */
class Relationship
{
    /**
     * @var $name
     */
    private $name;

    /**
     * @var$attributes
     * Das ist eine  Liste/Array oder was auch immer
     */

    private $attributes;

    /**
     * @var $ Enities 2 Demensionale Liste/Array oder was auch immer 1 Dim Kardinalität 2. Dim Entity
     */
    private $entities;

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
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param mixed $entities
     */
    public function setEntities($entities)
    {
        $this->entities = $entities;
    }




}