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
    .draggableInput {
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
    }

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

</style>

</head>
<body>


<div id="draggableInput" class="draggableInput">
</div>
<div class="droppable">
</div>



<script>

    draggableInputNo = 0;

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

                if (ui.draggable.attr('id') == 'draggableInput') {
                    draggableInputNo++;
                    $element.attr("id", 'draggableInput' + draggableInputNo);
                    $newID = 'draggableInput' + draggableInputNo;
                    console.info($element);
                    console.info($newID)
                    $element.appendTo(this);

                    var $newPosX = ui.offset.left - $(this).offset().left;
                    var $newPosY = ui.offset.top - $(this).offset().top;
                    console.info($newPosX,$newPosY);

                    var myEl = document.getElementById('draggableInput' + draggableInputNo);

                    myEl.addEventListener('click', function() {
                        console.info("draufgeklickt!")
                        console.info(myEl)
                    }, false);

                }

            }
        });

        //Set draggableInput as a draggable layer
        $(".draggableInput").draggable({
            containment: '#droppable',
            cursor: 'move',
            helper: draggableInputHelper,
        });


    });

    function draggableInputHelper(event) {
        return '<div id="draggableInput' + draggableInputNo + '" class="draggableInputHelper" ></div>'

    }




</script>

</body>
