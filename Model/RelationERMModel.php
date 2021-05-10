<?php
include_once 'EntityModel.php';
/**
 * Class RelationERMModel
 * Zeigt eine Relation auf welche ein Teil einer Relationship sind
 */
class RelationERMModel
{
    /**
     * @var EntityModel Entität
     */
    private $entity;
    /**
     * @var String  Kardinalität der Beziehung
     */
    private $kard;
    /**
     * @var
     */
    private $weak;

    /**
     * RelationERMModel constructor.
     * @param EntityModel $entity
     * @param $kard
     * @param $weak
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
     * @return int
     */
    public function getKard(): string
    {
        return $this->kard;
    }

    /**
     * @param int $kard
     */
    public function setKard(int $kard): void
    {
        $this->kard = $kard;
    }

    /**
     * @return mixed
     */
    public function getWeak()
    {
        return $this->weak;
    }

    /**
     * @param mixed $weak
     */
    public function setWeak($weak): void
    {
        $this->weak = $weak;
    }









}