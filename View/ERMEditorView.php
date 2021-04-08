<?php
include_once '../Controller/ERMController.php';
include_once '../Controller/AttributeController.php';
include_once '../Controller/EntityController.php';
include_once '../Controller/GeneralisationController.php';
include_once '../Controller/RelationshipController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
Test
<?php
$ERMController = new ERMController();
$EntityController = new EntityController();
$AttributeController = new AttributeController();
$GeneralisationController = new GeneralisationController();
$RelationshipController = new RelationshipController();


$erm = $ERMController->createModel();


$entity = $EntityController->createEntity('Haus', 2,3);
$ERMController->addEntity($erm, $entity);
$attribute1 = $AttributeController->createAttribute('Nummer',1,true);
$EntityController->addAttribute($entity, $attribute1);
$attribute2 = $AttributeController->createAttribute('Groeße',2,false);
$EntityController->addAttribute($entity, $attribute2);
$attribute3 = $AttributeController->createrelatedAttribute("Adresse", false, array("Straße", "Land"));
$entity2 = $EntityController->createEntity('Stadt', 4,2);
$erm->addEntity($entity2);
$EntityController->addAttribute($entity, $attribute3);
$entity3 = $EntityController->createEntity('Zimmer', 1,3);
$attribute4 = $AttributeController->createAttribute('Zimmernummer', 1, true);
$EntityController->addAttribute($entity3, $attribute4);
$erm->addEntity($entity3);

$generalisation = $GeneralisationController->createGeneralisation($entity2, 3,1 );
$GeneralisationController->addSubtyp($generalisation, $entity);
$erm->addGeneralisation($generalisation);

$relationship = $RelationshipController->createRelationship('ist teil', 1, 3);
$RelationshipController->addRelation($relationship, $entity3, 1, 45, true);
$RelationshipController->addRelation($relationship, $entity, 3, 12, false);
$erm->addRelationship($relationship);






$EntityController->changePosition($entity,1,2);
$ERMController->printEntities($erm);
print_r( $EntityController->getAttributes($entity));
//$EntityController->deleteAttribute($entity, $attribute1)
?>
</body>
</html>