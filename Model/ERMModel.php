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
            echo $entity->getName();
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
}