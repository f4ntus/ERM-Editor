<?php

/**
 * Class RelationModel
 * Zeigt eine Relation auf welche ein Teil einer Relationship sind
 */
class RelationModel
{
    /**
     * @var EntityModel Entität
     */
    private EntityModel $entity;
    /**
     * @var integer minminaler Betrag der Kardinaltiät
     */
    private $kardmin;
    /**
     * @var integer Maximaler Wert der Kardinalität
     */
    private $kardmax;
    /**
     * @var SchwachesENtit
     */
    private $weak;

    /**
     * RelationModel constructor.
     * @param EntityModel $entity
     * @param  $kardmin string minimale Kardinalität
     * @param  $kardmax string maximale Kardinalität
     */
    public function __construct(EntityModel $entity,  $kardmin, $kardmax, $weak)
    {
        $this->entity = $entity;
        $this->kardmin = $kardmin;
        $this->kardmax = $kardmax;
        $this->weak = $weak;
    }


    /**
     * @return EntityModel
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param EntityModel $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getKardmin()
    {
        return $this->kardmin;
    }

    /**
     * @param mixed $kardmin
     */
    public function setKardmin($kardmin)
    {
        $this->kardmin = $kardmin;
    }

    /**
     * @return mixed
     */
    public function getKardmax()
    {
        return $this->kardmax;
    }

    /**
     * @param mixed $kardmax
     */
    public function setKardmax($kardmax)
    {
        $this->kardmax = $kardmax;
    }


}