<?php

/**
 * Class ERMModel
 */
class ERMModel
{
    private $entities;
    private $relationships;
    private $generalistions;
    private $id;

    /**
     * Konstrukter
     */

    public function __construct()
    {
        $this->id = 1;
        // Check relevants
        $this->entities = array();
        $this->relationships = array();
        $this->generalistions = array();
    }


    /**
     * @param EntityModel $Entity
     */
    public function addEntity(EntityModel $entity)
    {
        $this->entities[] = $entity;
    }

    /**
     * Diese Funktion entfernt eine Entität
     */
    public function deleteEntity(EntityModel $entity)
    {
        foreach ($this->entities as $key => $a) {
            if ($entity == $a) {
                unset($this->entities[$key]);
            }
        }
    }


    public function printEntities()
    {

        foreach ($this->entities as $entity) {
            $entity->printEntity($entity);
            echo '</br>';
        }
    }

    /**
     * Diese Funktion fügt eine RelationshipModel hinzu
     */
    public function addRelationship(RelationshipModel $relationship)
    {
        $this->relationships[] = $relationship;
    }

    /**
     * Diese Funktion fügt eine Generalisierung hinzu
     */
    public function addGeneralisation(GeneralisationModel $generalisation)
    {
        $this->generalistions[] = $generalisation;
    }


    /**
     * Diese Funktion entfernt eine RelationshipModel
     */
    public function deleteRelationship(RelationshipModel $relationship)
    {
        foreach ($this->relationships as $key => $r) {
            if ($relationship == $r) {
                unset($this->relationships[$key]);
            }
        }

    }

    /**
     * Diese Funktion entfernt eine Generalisierung
     */
    public function deleteGeneralisation(GeneralisationModel $generalisation)
    {
        foreach ($this->generalistions as $key => $g) {
            if ($generalisation == $g) {
                unset($this->generalistions[$key]);
            }
        }
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @param array $entities
     */
    public function setEntities(array $entities): void
    {
        $this->entities = $entities;
    }

    /**
     * @return array
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @param array $relationships
     */
    public function setRelationships(array $relationships): void
    {
        $this->relationships = $relationships;
    }

    /**
     * @return array
     */
    public function getGeneralistions(): array
    {
        return $this->generalistions;
    }

    /**
     * @param array $generalistions
     */
    public function setGeneralistions(array $generalistions): void
    {
        $this->generalistions = $generalistions;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Ausgeben eines Entities
     * @param $name
     * @return EntityModel
     */
    public function getEntitybyName($name): EntityModel
    {
        foreach ($this->entities as $entity){
            if ($entity->getName() == $name){
                $e = $entity;
            }
        }
        return $e;
    }

    public function getEntitybyID($id): EntityModel
    {
        foreach ($this->entities as $entity){
            if ($entity->getID() == $id){
                $e = $entity;
            }
        }
        return $e;
    }

    public function getRelationship($id): RelationshipModel
    {
        foreach ($this->relationships as $relationship){
            if ($relationship->getID() == $id){
                $r = $relationship;
            }
        }
        return $r;
    }

    public function getGeneralisation($id): GeneralisationModel
    {
        foreach ($this->generalistions as $generalisation){
            if ($generalisation->getID() == $id){
                $g = $generalisation;
            }
        }
        return $g;
    }
}