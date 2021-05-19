<?php



function cleanNamefromERMObject(array $array, string $name){
    $basicname=$name;
    $i=1;
    while(checkredundantNamefromERMObjects($array, $name)) {
        $i++;
        $name = $basicname . $i;
    }
    return $name;

}
/**
 * Gibt aus ob redundante Namen vorhanden sind
 * @param array $array
 * @param string $name
 * @return bool
 */
function checkredundantNamefromERMObjects(array $array, string $name){
    $result = false;
    foreach ($array as $element){
        if($element->getName()==$name){
            $result = true;
        }
    }
    return $result;

}


