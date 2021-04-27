<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script language="javascript" type="text/javascript" src="frontendScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Also include jQueryUI -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>ERM-Editor</title>



<style>

    .droppable {
        width: 200px;
        height: 200px;
        padding: 0.5em;
        margin: 10px;
        float: left;
        border: 1px solid #867979;
        border-radius: 4px;
        background-color: yellow;
    }



.entity {
    margin: 20px;
    background-image: url("images/entity.png");
    background-size: contain;
    height: 55px;
    width: 100px;

}

.relationship {
    margin: 20px;
    background-image: url("images/relationship.png");
    background-size: contain;
    height: 55px;
    width: 95px;
    border: white;
}

.isA {
    margin: 20px;
    background-image: url("images/isA.png");
    background-size: contain;
    height: 55px;
    width: 68px;
    border: white;
}

</style>

</head>
<body>

<div class="menuGroup">
    <p>Formen</p>
    <button class="entity" id="entity"> </button>
    <button class="relationship" id="relationship"></button>
    <button class="isA" id="isA"></button>
</div>


<div class="droppable">
</div>



<script>

    entityInputNo = 0;
    relationshipInputNo = 0;
    isAInputNo = 0;
    onClick = '';


        //set droppable as a droppable container
        $(".droppable").droppable({
            drop: function(event, ui) {

                $element = ui.helper.clone();
                $element.draggable({cancel: false, containment: $('.droppable'), cursor: 'move'});
                $element.selectable();

                // position of the draggable minus position of the droppable
                // relative to the document
                var $newPosX = ui.offset.left - $(this).offset().left;
                var $newPosY = ui.offset.top - $(this).offset().top;
                console.info($newPosX,$newPosY);

                if (ui.draggable.attr('id') == 'entity') {
                    entityInputNo++;
                    $element.attr("id", 'entity' + entityInputNo);
                    $newIDEntity = 'entity' + entityInputNo;
                    console.info($element);
                    console.info($newIDEntity)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                }

                if (ui.draggable.attr('id') == 'relationship') {
                    relationshipInputNo++;
                    $element.attr("id", 'relationship' + relationshipInputNo);
                    $newIDRelationship = 'relationship' + relationshipInputNo;
                    console.info($element);
                    console.info($newIDRelationship)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                }

                if (ui.draggable.attr('id') == 'isA') {
                    isAInputNo++;
                    $element.attr("id", 'relationship' + isAInputNo);
                    $newIDIsA = 'relationship' + isAInputNo;
                    console.info($element);
                    console.info($newIDIsA)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                }

            }
        });

        //Set draggableInput as a draggable layer
        $(".entity").draggable({
            cancel: false,
            containment: '#droppable',
            cursor: 'move',
            helper: entityClone,

        });

        //Set draggableInput as a draggable layer
        $(".relationship").draggable({
            cancel: false,
            containment: '#droppable',
            cursor: 'move',
            helper: relationshipClone,

        });

        //Set draggableInput as a draggable layer
        $(".isA").draggable({
            cancel: false,
            containment: '#droppable',
            cursor: 'move',
            helper: isAClone,

        });


    function entityClone() {
        return '<button id="entity' + entityInputNo + '" class="entity" onclick="openEntityMenu()"></button>'
    }

    function relationshipClone() {
        return '<button id="relationship' + relationshipInputNo + '" class="relationship" onclick="openRelationshipMenu()"></button>'
    }

    function isAClone() {
        return '<button id="isA' + isAInputNo + '" class="isA" ></button>'
    }

    function openEntityMenu(){
        console.info("öffnet Entity-Menü")
    }

    function openRelationshipMenu(){
        console.info("öffnet Relationship-Menü")
    }



</script>

</body>
