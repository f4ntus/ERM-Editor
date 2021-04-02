<?php
include_once '../Controller/ERMController.php';
include_once '../Controller/AttributeController.php';
include_once '../Controller/EntityController.php';
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
 $erm = $ERMController->createModel();


$entity = $EntityController->createEntity('Haus', 2,3);
$ERMController->addEntity($erm, $entity);
$attribute1 = $AttributeController->createAttribute('Nummer',1,true);
$EntityController->addAttribute($entity, $attribute1);
$attribute2 = $AttributeController->createAttribute('Groeße',2,false);
$EntityController->addAttribute($entity, $attribute2);
$attribute3 = $AttributeController->createrelatedAttribute("Adresse", false, array("Straße", "Land"));
$EntityController->addAttribute($entity, $attribute3);



$EntityController->changePosition($entity,1,2);
$ERMController->printEntities($erm);

//$EntityController->deleteAttribute($entity, $attribute1)
?>
</body>
</html>