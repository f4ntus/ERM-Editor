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
</head>
<body>
<div class="grid-container">
    <div class="headline">
        <ul>
            <li><a href="about.asp">Impressum</a></li>
            <li><a href="contact.asp">Anleitung</a></li>
            <li><a href="news.asp">Laden</a></li>
            <li><a href="default.asp">Speichern</a></li>
        </ul>
    </div>
    <div class="leftMenue">
        <div class="menuGroup">
            <p>Formen</p>
            <button class="entity" id="entity">Entity</button>
            <button class="relationship" id="relationship">Relationship</button>
            <button class="isA" id="isA"></button>
        </div>
        <div class="menuGroup">
            <from action="">
                <p>Kardinalitätsrestriktionen</p>
                <input type="radio" id="oneNm" name="cardinality" value="oneNm">
                <label for="oneNm">1, n, m</label><br>
                <input type="radio" id="minMax" name="cardinality" value="minMax">
                <label for="minMax">min, max</label><br>
                <input type="submit" value="Aktualisieren">
            </from>
        </div>
        <div class="menuGroup">
            <div class="dropdown">
                <button class="dropbtn">Generalisierung</button>
                <div class="dropdown-content">
                    <a href="#" onclick="generalizationMode('Hausklassenmodell')">Hausklassenmodell</a>
                    <a href="#" onclick="generalizationMode('Partionierungs-Modell')">Partionierungs-Modell</a>
                    <a href="#" onclick="generalizationMode('Volle Redundanz')">Volle Redundanz</a>
                    <a href="#" onclick="generalizationMode('Überrelation')">Überrelation</a>
                </div>
            </div>
            <p id="showGeneralizationMode"></p>
            <button>ERM umwandeln</button>
        </div>
    </div>
    <div class="editor">Three </div>
    <div class="rightMenue">
        <h3>Entity bearbeiten:</h3>
        <table style="width:100%">
            <tr>
                <th colspan="2">
                    <input placeholder="Entity name" type="text" id="idEntityName" name="idEntityName">
                </th>

                <th>PK</th>
            </tr>
            <tr>
                <td>X</td>
                <td>Id</td>
                <td>X</td>
            </tr>
            <tr>
                <td>X</td>
                <td>{Raum}</td>
                <td>X</td>
            </tr>
            <tr>
                <td>X</td>
                <td>Adresse(Straße,PLZ)</td>
                <td>X</td>
            </tr>
        </table>

        <hr class="hr">

        <button onclick="onClickButtonAddSimpleAttribute()" class="button">Einfaches<br>Attribut<br>hinzufügen</button>
        <button onclick="onClickButtonAddMultiValueAttribute()" class="button">Mehrwertiges<br>Attribut<br>hinzufügen
        </button>
        <button onclick="onClickButtonAddCompoundAttribute()" class="button">Zusammengesetztes<br>Attribut<br>hinzufügen
        </button>

        <hr class="hr">

        <div class="row" id="idDivAddAttribute">

        </div>
    </div>
    <div class="outputBelow">Five</div>
</div>


<script>

    entityInputNo = 0;
    relationshipInputNo = 0;
    isAInputNo = 0;
    onClick = '';


    //set droppable as a droppable container
    $(".editor").droppable({
        drop: function(event, ui) {

            $element = ui.helper.clone();
            $element.draggable({cancel: false, containment: $('.editor'), cursor: 'move'});
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
                $element.attr("id", 'isA' + isAInputNo);
                $newIDIsA = 'isA' + isAInputNo;
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
        containment: '#editor',
        cursor: 'move',
        helper: entityClone,

    });

    //Set draggableInput as a draggable layer
    $(".relationship").draggable({
        cancel: false,
        containment: '#editor',
        cursor: 'move',
        helper: relationshipClone,

    });

    //Set draggableInput as a draggable layer
    $(".isA").draggable({
        cancel: false,
        containment: '#editor',
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
</html>