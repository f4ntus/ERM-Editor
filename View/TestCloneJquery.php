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
/*    .draggableInput {
        width: 50px;
        height: 30px;
        padding: 1em;
        float: left;
        margin: 10px 10px 10px 0;
        background-color: #9933ff;
        border-radius: 10px;
        border: 1px solid #9933ff;
        writing-mode: tb-rl;
    }

    .draggableInputHelper {
        width: 50px;
        height: 30px;
        padding: 0.5em;
        margin: 10px 10px 10px 0;
        background-color: #006699;
        border-radius: 10px;
        border: 1px solid #006699;
    }*/

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

    .draggableInput {
        margin: 20px;
        height: 55px;
        width: 100px;
    }


    .draggableInputHelper {
        margin: 20px;
        height: 55px;
        width: 100px;
    }

#entity {
    background-image: url("images/entity.png");
    background-size: contain;
}

#relationship {
    background-image: url("images/relationship.png");
    background-size: contain;
    border: white;
}

#isA {
    background-image: url("images/isA.png");
    background-size: contain;
    border: white;
}

</style>

</head>
<body>

<div class="menuGroup">
    <p>Formen</p>
    <button class="draggableInput" id="entity"></button>
    <button class="draggableInput" id="relationship"></button>
    <button class="shape" id="isA"></button>
</div>

<!--<div id="draggableInput" class="draggableInput">
</div>-->
<div class="droppable">
</div>



<script>

    draggableInputNo = 0;
    newID = ' ';

    $(function() {
        //set droppable as a droppable container
        $(".droppable").droppable({
            drop: function(event, ui) {

                $element = ui.helper.clone();
                $element.draggable({containment: $('.droppable'), cursor: 'move'});
                $element.selectable();

                // position of the draggable minus position of the droppable
                // relative to the document
                var $newPosX = ui.offset.left - $(this).offset().left;
                var $newPosY = ui.offset.top - $(this).offset().top;
                console.info($newPosX,$newPosY);

                if (ui.draggable.attr('id') == 'entity') {
                    draggableInputNo++;
                    $element.attr("id", 'entity' + draggableInputNo);
                    newID = 'entity' + draggableInputNo;
                    console.info($element);
                    console.info($newID)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                    var myEl = document.getElementById('entity' + draggableInputNo);

                    myEl.addEventListener('click', function() {
                        console.info("draufgeklickt!")
                        console.info(myEl)
                    }, false);

                }

                if (ui.draggable.attr('id') == 'relationship') {
                    draggableInputNo++;
                    $element.attr("id", 'relationship' + draggableInputNo);
                    $newIDRelationship = 'relationship' + draggableInputNo;
                    console.info($element);
                    console.info($newID)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                    var myEl = document.getElementById('relationship' + draggableInputNo);

                    myEl.addEventListener('click', function() {
                        console.info("draufgeklickt!")
                        console.info(myEl)
                    }, false);

                }

            }
        });

        //Set draggableInput as a draggable layer
        $(".draggableInput").draggable({
            cancel: false,
            containment: '#droppable',
            cursor: 'move',
            helper: draggableInputHelper,
            drag function (event, ui){
                if (ui.draggable.attr('id') == 'entity') {
                    draggableInputNo++;
                    $element.attr("id", 'entity' + draggableInputNo);
                    newID = 'entity' + draggableInputNo;
                    console.info($element);
                    console.info($newID)
                }
            }

        });


    });

    function draggableInputHelper() {
        console.info("in fuction");
        console.info(draggableInputNo);
        if (newID == 'entity' + draggableInputNo + '') {
            return '<button id="entity' + draggableInputNo + '" class="draggableInputHelper" ></button>'
        }else if (ui.draggable.attr('id') == $newIDRelationship){
            return '<button id="relationship' + draggableInputNo + '" class="draggableInputHelper" ></button>'
        }

    }




</script>

</body>
