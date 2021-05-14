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
     * @var X Standort
     */
    protected $y;
    /**
     * @var Y Standort
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
     * @return X
     */
    public function getY(): X
    {
        return $this->y;
    }

    /**
     * @param X $y
     */
    public function setY(X $y): void
    {
        $this->y = $y;
    }

    /**
     * @return Y
     */
    public function getX(): Y
    {
        return $this->x;
    }

    /**
     * @param Y $x
     */
    public function setX(Y $x): void
    {
        $this->x = $x;
    }

}