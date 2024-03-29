<?php

/**
 * Die Oberklasse aller ERM Objekte
 * Class ERMObjectModel
 */
abstract class ERMObjectModel
{
    /**
     * ID eines Objektes
     * @var
     */
    protected $id;

    /**
     * Y Wert des Standort
     * @var
     */
    protected $y;

    /**
     * X Wert des Standort
     * @var
     */
    protected $x;

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
    public function setY($y): void
    {
        $this->y = $y;
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
    public function setX($x): void
    {
        $this->x = $x;
    }

}