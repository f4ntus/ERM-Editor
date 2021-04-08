<?php
include_once 'EntityModel.php';
/**
 * Class RelationModel
 * Zeigt eine Relation auf welche ein Teil einer Relationship sind
 */
class RelationModel
{
    /**
     * @var EntityModel Entität
     */
    private $entity;
    /**
     * @var integer Kardinalität der Beziehung
     */
    private $kard;
    /**
     * @var Boolean
     */
    private $weak;

    /**
     * RelationModel constructor.
     * @param EntityModel $entity
     * @param  $kardmin string minimale Kardinalität
     * @param  $kardmax string maximale Kardinalität
     */
    public function __construct(EntityModel $entity,  $kard, $weak)
    {
        $this->entity = $entity;
        $this->kard = $kard;
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