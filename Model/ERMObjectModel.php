<?php

/**
 * Die Oberklasse aller ERM Objekte
 * Class ERMObjectModel
 */
class ERMObjectModel
{
    /**
     * @var ID
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

}