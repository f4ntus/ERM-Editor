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

        #dragThis {
            width: 8em;
            height: 8em;
            padding: 0.5em;
            border: 3px solid #ccc;
            border-radius: 0 1em 1em 1em;
            background-color: #fff;
            background-color: rgba(255,255,255,0.5);
        }

        #dragThis span {
            float: right;
        }

        #dragThis span:after {
            content: "px";
        }

        li {
            clear: both;
            border-bottom: 1px solid #ccc;
            line-height: 1.2em;
        }

        #dropHere {
            width: 12em;
            height: 12em;
            padding: 0.5em;
            border: 3px solid #f90;
            border-radius: 1em;
            margin: 0 auto;
        }

    </style>
</head>
<body>

<div id="dragThis">
    <ul>
        <li id="posX">x: <span></span></li>
        <li id="posY">y: <span></span></li>
        <li id="finalX">Final X: <span></span></li>
        <li id="finalY">Final Y: <span></span></li>
        <li id="width">Width: <span></span></li>
        <li id="height">Height: <span></span></li>
    </ul>
</div>

<div id="dropHere"></div>

<script>

    $('#dragThis').draggable(
        {
            containment: $('body'),
            drag: function(){
                var offset = $(this).offset();
                var xPos = offset.left;
                var yPos = offset.top;
                $('#posX > span').text(xPos);
                $('#posY > span').text(yPos);
            },
            stop: function(){
                var finalOffset = $(this).offset();
                var finalxPos = finalOffset.left;
                var finalyPos = finalOffset.top;

                $('#finalX > span').text(finalxPos);
                $('#finalY > span').text(finalyPos);
                $('#width > span').text($(this).width());
                $('#height > span').text($(this).height());
            },
            revert: 'invalid'
        });

    $('#dropHere').droppable(
        {
            accept: '#dragThis',
            over : function(){
                $(this).animate({'border-width' : '5px',
                    'border-color' : '#0f0'
                }, 500);
                $('#dragThis').draggable('option','containment',$(this));
            }
        });
</script>



</body>