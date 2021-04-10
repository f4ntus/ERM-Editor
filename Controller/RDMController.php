<?php
include_once '../Model/RDMModel.php';
include_once '../Model/AttributeRDMModel.php';
include_once '../Model/RelationRDMModel.php';
/**
 * Class RDMController
 */

class RDMController
{
    /**
     * @param ERMModel $erm
     */
    public static function generateRDM(ERMModel $erm){
        $rdm = new RDMModel();
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
    private static function createRelationsfromEntity(ERMModel $erm, RDMModel $rdm){
        foreach ($erm->getEntities() as $entity){
            $relation = new RelationRDMModel($entity->getName());


            //Hinzufügen des Attributes von normalen und zusammengesetzten Attributen
            foreach ($entity->getAttributes() as $ERMa){

                switch($ERMa->getType()){
                    case 1:
                        $RDMa = New AttributeRDMModel();
                        $RDMa->setName($ERMa->getName());
                        $RDMa->setPrimary($ERMa->getPrimary());
                        $relation->addAttribute($RDMa);
                        break;
                    case 3:
                        $basicName = $ERMa->getName();
                        foreach($ERMa->getSubnames() as $subname){
                            $RDMa = New AttributeRDMModel();
                            $RDMa->setName($basicName.$subname);
                            $RDMa->setPrimary($ERMa->getPrimary());
                            $relation->addAttribute($RDMa);
                        }
                        break;



                }
            }
            $rdm->addRelation($relation);

            //Hinzufügen einer wweiteren Relation durch Typ 2 also einem mehrwertigen Attribut
            foreach ($entity->getAttributes() as $ERMa){

                if($ERMa->getType()==2){
                   $relationfromultivaluesattribute = new RelationRDMModel($entity->getName().$ERMa->getName());
                   foreach ($relation->getAttributes() as $attribute){
                       if ($attribute->getPrimary()){
                           $newattribute = new AttributeRDMModel();
                           $newattribute->setName($attribute->getName());
                           $newattribute->setPrimary(true);
                           $newattribute->setReferences($relation->getName());
                           $relationfromultivaluesattribute->addAttribute($newattribute);

                       }
                    }
                   $RDMa = new AttributeRDMModel();
                   $RDMa->setName($ERMa->getName());
                   $RDMa->setPrimary(true);
                   $relationfromultivaluesattribute->addAttribute($RDMa);
                   $rdm->addRelation($relationfromultivaluesattribute);
                }
            }

        }
    }

    private static function createRelationsfromRelationships(ERMModel $erm, RDMModel $rdm){

        //Alle Relationen durch gehen
        foreach ($erm->getRelationships() as $relationship){
            //Die Anzahl von n-Beziehungen ermitteln ($i)

             $i = 0;
            foreach ($relationship->getRelations() as $ERMRelation){
                if($ERMRelation->getKard() == '[0,1]' OR $ERMRelation->getKard()=='[1:1]')
                {
                $i = $i +1;
                }
            }
            echo $i;
        //Es wird keine eigene Relation benötigt.
        if(count($relationship->getRelations())==2 and count($relationship->getAttributes()) == 0 and $i <=1){

            switch ($i){
                case 0:
                    self::relationshipwithonetoone($relationship, $erm, $rdm);
                    break;
                case 1:
                    self::relationshipwithoneton($relationship, $erm, $rdm);
                    break;
            }


        } else { //Es wird eine eigene Relation benötigt
            $RDMRelation = new RelationRDMModel();

        }
    }

    }

    /**
     * Hinzufügen einer 1-1 Beziehung in das vorhande RDM Modell
     * @param RelationshipModel $relationship
     * @param ERMModel $erm
     * @param RDMModel $rdm
     */
    private static function relationshipwithonetoone(RelationshipModel $relationship, ERMModel $erm, RDMModel $rdm){
        //Die relevanten Beziehungen werden raussgesucht
        $ERMrelations = $relationship->getRelations();
        //Entitys werden zugewisene
        $firstentity = current($ERMrelations)->getEntity();
        $secondentity = next($ERMrelations)->getEntity();
        //Im vorhanden rdm Modell werden die Relation durchlaufen
        foreach ($rdm->getRelations() as $RDMRelation){
            //Die betroffene Relation wird rausgesucht
            if($RDMRelation->getName() == $firstentity->getName()){
                //Die Schlüsselttribute werden rausgesucht
                foreach ($secondentity->getAttributes() as $ERMAttribute)
                    if($ERMAttribute->getPrimary()){
                        //Das Schlüsselattribut des ersten Attribut wird dem zweiten Attribute hinzugefügt
                        $RDMAttribute = new AttributeRDMModel();
                        $RDMAttribute->setPrimary(false);
                        $RDMAttribute->setName($ERMAttribute->getName());
                        $RDMAttribute->setReferences($secondentity->getName());
                        $RDMRelation->addAttribute($RDMAttribute);
                    }

            }
        }

    }

    private static function relationshipwithoneton(RelationshipModel $relationship, ERMModel $erm, RDMModel $rdm)
    {
        $relations = $relationship->getRelations();
        //Die relevanten Beziehungen werden raussgesucht
        foreach ($relations as $key => $ERMRelation) {
            $kard = $ERMRelation->getKard();
            echo $kard;
            switch ($kard) {
                case '[1,*]':
                    $entity1 = $relations[$key]->getEntity();
                    break;
                case '[0,1]':
                    $entityn = $relations[$key]->getEntity();
                    $weak = $ERMRelation->getWeak();
                    break;
            }
        }
        foreach ($rdm->getRelations() as $RDMRelation) {
            if ($RDMRelation->getName() == $entityn->getName()) {
                //Die Schlüsselttribute werden rausgesucht
                foreach ($entity1->getAttributes() as $ERMAttribute)
                    if ($ERMAttribute->getPrimary()) {
                        //Das Schlüsselattribut des ersten Attribut wird dem zweiten Attribute hinzugefügt
                        $RDMAttribute = new AttributeRDMModel();
                        $RDMAttribute->setPrimary($weak);
                        $RDMAttribute->setName($ERMAttribute->getName());
                        $RDMAttribute->setReferences($entity1->getName());
                        $RDMRelation->addAttribute($RDMAttribute);
                    }

            }
        }
    }

    public static function getRelations(RDMModel $rdm){
        return $rdm->getRelations();
    }

}