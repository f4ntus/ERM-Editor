<?php
include_once '../Model/RDMModel.php';
include_once '../Model/AttributeRDMModel.php';
include_once '../Model/RelationRDMModel.php';

/**
 * Class RDMController
 */
class RDMController
{
    public static function getRDM(ERMModel $erm, $generalisationstyp)
    {
        $rdm = self::generateRDM($erm, $generalisationstyp);
        $relations = array();
        $j = 0;
        foreach ($rdm->getRelations() as $relation) {
            $attributes = array();
            $i = 0;
            foreach ($relation->getAttributes() as $attribute) {
                $attributeArray = [
                    'name' => $attribute->getName(),
                    'primary' => $attribute->getPrimary(),
                    'reference' => $attribute->getReferences(),
                ];
                $attributes[$i] = $attributeArray;
                $i++;
            }
            $relations[$j] = [
                'name' => $relation->getName(),
                'attributes' => $attributes
            ];
            $j++;
        }
        return $relations;
    }

    /**
     * @param ERMModel $erm
     */
    public static function generateRDM(ERMModel $erm, $generalisationstyp)
    {
        $rdm = new RDMModel();

        ERMController::GeneralisationERM($erm, $generalisationstyp);
        self::createRelationsfromEntity($erm, $rdm);
        self::createRelationsfromRelationships($erm, $rdm);
        return $rdm;
    }

    /**
     * Das Erstellen neuer Relationen von den Entitäten
     * @param ERMModel $erm
     * @param RDMModel $rdm
     * @return RDMModel
     */
    private static function createRelationsfromEntity(ERMModel $erm, RDMModel $rdm)
    {
        foreach ($erm->getEntities() as $entity) {
            $relation = new RelationRDMModel(cleanNamefromERMObject($rdm->getRelations(), $entity->getName()));
            $relation->setEntity($entity);
            self::addRelationfromEntity($entity, $relation, $rdm);
        }
    }

    /**
     * Verwalten von Relationsships des ERM in das RDM
     * @param ERMModel $erm
     * @param RDMModel $rdm
     */
    private static function createRelationsfromRelationships(ERMModel $erm, RDMModel $rdm)
    {

        //Alle Relationen durch gehen
        foreach ($erm->getRelationships() as $relationship) {
            //Die Anzahl von n-Beziehungen ermitteln ($i)

            $i = 0;
            foreach ($relationship->getRelations() as $ERMRelation) {
                if ($ERMRelation->getKard() == '[0,*]' or $ERMRelation->getKard() == '[1,*]') {
                    $i = $i + 1;
                }
            }

            //Es wird keine eigene Relation benötigt. Bei <2 Entities, keine eigenen Attribute und nur einer (i) Notation größer als 0:1
            if (count($relationship->getRelations()) == 2 and count($relationship->getAttributes()) == 0 and $i <= 1) {

                switch ($i) {
                    case 0:
                        //Es muss eine 1:1 Beziehung sein
                        self::relationshipwithonetoone($relationship, $rdm);
                        break;
                    case 1:
                        //Es ist eine 1:n Beziehung
                        self::relationshipwithoneton($relationship, $rdm);
                        break;
                }


            } else {
                //Es wird eine eigene Relation benötigt


                $RDMRelation = new RelationRDMModel(cleanNamefromERMObject($rdm->getRelations(), $relationship->getName()));

                //Attribute der Relationship in RDM aufnehmen
                foreach ($relationship->getAttributes() as $ERMAttribute) {
                    $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($RDMRelation->getAttributes(), $ERMAttribute->getName()), false);
                    $RDMRelation->addAttribute($RDMAttribute);
                }

                //Primärschlüssel der Relations hinzufügem
                foreach ($relationship->getRelations() as $ERMRelation) {
                    $Entity = $ERMRelation->getEntity();
                    foreach ($Entity->getAttributes() as $ERMAttribute) {
                        if ($ERMAttribute->getPrimary()=="true") {
                            $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($RDMRelation->getAttributes(), $ERMAttribute->getName()), true);
                            $RDMAttribute->setReferences($Entity->getName());
                            $RDMRelation->addAttribute($RDMAttribute);
                        }

                    }
                }
                $rdm->addRelation($RDMRelation);
            }
        }

    }

    /**
     * Hinzufügen einer 1-1 Beziehung in das vorhande RDM Modell
     * @param RelationshipModel $relationship
     * @param ERMModel $erm
     * @param RDMModel $rdm
     */
    private static function relationshipwithonetoone(RelationshipModel $relationship, RDMModel $rdm)
    {
        //Die relevanten Beziehungen werden raussgesucht
        $ERMrelations = $relationship->getRelations();
        //Entitys werden zugewisene
        $firstentity = current($ERMrelations)->getEntity();
        $secondentity = next($ERMrelations)->getEntity();
        //Im vorhanden rdm Modell werden die Relation durchlaufen
        foreach ($rdm->getRelations() as $RDMRelation) {
            //Die betroffene Relation wird rausgesucht
            if ($RDMRelation->getName() == $firstentity->getName()) {
                //Die Schlüsselttribute werden rausgesucht
                foreach ($secondentity->getAttributes() as $ERMAttribute) {
                    if ($ERMAttribute->getPrimary()=="true") {
                        //Das Schlüsselattribut des ersten Attribut wird dem zweiten Attribute hinzugefügt
                        $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($RDMRelation->getAttributes(), $ERMAttribute->getName()), false);
                        $RDMAttribute->setReferences($secondentity->getName());
                        $RDMRelation->addAttribute($RDMAttribute);
                    }
                }
            }
        }

    }

    /**1 zu n Beziehung vorgang
     * @param RelationshipModel $relationship
     * @param RDMModel $rdm
     */
    private static function relationshipwithoneton(RelationshipModel $relationship, RDMModel $rdm)
    {
        $relations = $relationship->getRelations();
        //Die relevanten Beziehungen werden raussgesucht
        foreach ($relations as $key => $ERMRelation) {
            $kard = $ERMRelation->getKard();
            switch ($kard) {
                case '[1,*]':
                case '[0,*]':
                    $entity1 = $relations[$key]->getEntity();
                    break;
                case '[0,1]':
                case '[1,1]':
                    $entityn = $relations[$key]->getEntity();
                    $weak = $ERMRelation->getWeak();
                    break;

            }
        }
        //Die passenden Relations werden rausgesucht
        foreach ($rdm->getRelations() as $RDMRelation) {
            if ($entity1 == $RDMRelation->getEntity()) {
                $relation1 = $RDMRelation;
            }
            if (($entityn == $RDMRelation->getEntity())) {
                $relationn = $RDMRelation;
            }
        }

        foreach ($relation1->getAttributes() as $RDMAttribute1) {
            if ($RDMAttribute1->getPrimary()=="true") {
                //Das Schlüsselattribut des ersten Attribut wird dem zweiten Attribute hinzugefügt
                $RDMAttribute2 = new AttributeRDMModel(cleanNamefromERMObject($relationn->getAttributes(), $RDMAttribute1->getName()), $weak);
                $RDMAttribute2->setReferences($relation1->getName());
                $relationn->addAttribute($RDMAttribute2);
            }
        }
    }
//LÖSCHEN!!!!
    /*
        /** Auswahl des Generaliserungsmodell
         * @param RDMModel $rdm
         * @param ERMModel $erm
         * @param int $generaliserungstyp

        private static function createGeneralisierungsmodells(RDMModel $rdm, ERMModel $erm, int $generaliserungstyp){
            switch ($generaliserungstyp){
                case 1:
                    self::generalisoerungbyHausklassenmodell($rdm, $erm);
                    break;
                case 2;
                    self::generalisoerungbyPartionierungsmodell($rdm, $erm);
                    break;
                case 3:
                    self::generalisoerungbyHausklassenmodell($rdm, $erm);
                    break;
                case 4:
                    self::generalisoerungbyUeberrelation($rdm, $erm);
                    break;
             }

        }

        /**Generaliserung nach Hausklassenmodell
         * @param RDMModel $rdm
         * @param ERMModel $erm

        private static function generalisoerungbyHausklassenmodell (RDMModel $rdm, ERMModel $erm){
            foreach ($erm->getGeneralistions() as $generalisation){
                $supertyp = $generalisation->getSupertyp();
                foreach ($generalisation->getSubtypes() as $subtype){
                    $relation = new RelationRDMModel(cleanNamefromERMObject($subtype->getName(),$rdm->getRelations()), $subtype);
                    self::addRelationfromEntity($subtype, $relation, $rdm);
                    //Die Attribute der SuperTyp dem Subtyp hinzufügen

                    foreach ($rdm->getRelations() as $oldRelation) {
                        if(in_array($supertyp, $oldRelation->getERMobjects()))
                        {
                            foreach ($oldRelation->getAttributes() as $RDMAttribute) {
                                $relation->addAttribute($RDMAttribute);
                            }
                        }
                    }
                }
            }

        }

        /**Generaliserung nach Partionierungsmodell
         * @param RDMModel $rdm
         * @param ERMModel $erm

        private static function generalisoerungbyPartionierungsmodell (RDMModel $rdm, ERMModel $erm){
            foreach ($erm->getGeneralistions() as $generalisation){
                $supertyp = $generalisation->getSupertyp();
                foreach ($generalisation->getSubtypes() as $subtype) {
                    $relation = new RelationRDMModel($subtype->getName(), $subtype);
                    self::addRelationfromEntity($subtype, $relation, $rdm);
                    //Die Primärschlüssel  der SuperTyp dem Subtyp hinzufügen

                    foreach ($rdm->getRelations() as $oldRelation) {
                        if (in_array($supertyp, $oldRelation->getERMobjects())) {
                            foreach ($oldRelation->getAttributes() as $RDMAttribute) {
                                if ($RDMAttribute->getPrimary()) {
                                    $relation->addAttribute($RDMAttribute);
                                }
                            }
                        }
                    }
                }

            }
        }

        private static function generalisoerungbyVolleRedundanz (RDMModel $rdm, ERMModel $erm){

        }

        /**Generaliserung nach Überrelation
         * @param RDMModel $rdm
         * @param ERMModel $erm

        private static function generalisoerungbyUeberrelation (RDMModel $rdm, ERMModel $erm){
            //Typ Attribute
            $typAttribute = new AttributeRDMModel();
            $typAttribute->setName('Typ');
            $typAttribute->setPrimary(false);
            foreach ($erm->getGeneralistions() as $generalisation){
                $supertyp = $generalisation->getSupertyp();
                foreach ($generalisation->getSubtypes() as $subtype) {
                    //Die Attribute der Relation hinzufügen
                    foreach ($rdm->getRelations() as $oldRelation)
                    {
                        //superrelation wurde gefunden
                        if(in_array($supertyp, $oldRelation->getERMobjects()))
                        {

                            if(!in_array($typAttribute, $oldRelation->getAttributes())) {
                                $oldRelation->addAttribute($typAttribute);
                            }
                            self::addRelationfromEntity($subtype, $oldRelation, $rdm);
                            $oldRelation->addERMObject($subtype);
                        }

                    }
                }
            }
        }
    */
    /**Anhand einer Relation werden die Attribute einer Entity in einer Relation übertragen bzw. bei mehrwertigen Attributen wird neuer Relation erstellt
     * @param EntityModel $entity
     * @param RelationRDMModel $relation
     * @param RDMModel $rdm
     */
    private static function addRelationfromEntity(EntityModel $entity, RelationRDMModel $relation, RDMModel $rdm)
    {


        //Hinzufügen des Attributes von normalen und zusammengesetzten Attributen
        foreach ($entity->getAttributes() as $ERMAttribute) {

            switch ($ERMAttribute->getType()) {
                case 0:
                    $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($relation->getAttributes(), $ERMAttribute->getName()), $ERMAttribute->getPrimary());
                    $RDMAttribute->setName($ERMAttribute->getName());
                    $RDMAttribute->setPrimary($ERMAttribute->getPrimary());
                    $relation->addAttribute($RDMAttribute);
                    break;
                case 2:
                    $basicName = $ERMAttribute->getName();
                    foreach ($ERMAttribute->getSubnames() as $subname) {
                        $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($relation->getAttributes(), $basicName . $subname), $ERMAttribute->getPrimary());
                        $relation->addAttribute($RDMAttribute);
                    }
                    break;


            }
        }
        if (!in_array($relation, $rdm->getRelations())) {
            $rdm->addRelation($relation);
        }
        //Hinzufügen einer wweiteren Relation durch Typ 1 also einem mehrwertigen Attribut
        foreach ($entity->getAttributes() as $ERMAttribute) {

            if ($ERMAttribute->getType() == 1) {
                $relationfromultivaluesattribute = new RelationRDMModel(cleanNamefromERMObject($rdm->getRelations(), $entity->getName() . $ERMAttribute->getName()));
                foreach ($relation->getAttributes() as $attribute) {
                    if ($attribute->getPrimary()=="true") {
                        $newattribute = new AttributeRDMModel(cleanNamefromERMObject($relationfromultivaluesattribute->getAttributes(), $attribute->getName()), true);
                        $newattribute->setReferences($relation->getName());
                        $relationfromultivaluesattribute->addAttribute($newattribute);

                    }
                }
                $RDMAttribute = new AttributeRDMModel(cleanNamefromERMObject($relationfromultivaluesattribute->getAttributes(), $ERMAttribute->getName()), true);
                $RDMAttribute->setName($ERMAttribute->getName());
                $RDMAttribute->setPrimary("true");
                $relationfromultivaluesattribute->addAttribute($RDMAttribute);
                $rdm->addRelation($relationfromultivaluesattribute);
            }
        }

    }

    public static function getRelations(RDMModel $rdm)
    {
        return $rdm->getRelations();

    }

    public static function printRDM(RDMModel $rdm)
    {
        return $rdm->printRDM();
    }


}