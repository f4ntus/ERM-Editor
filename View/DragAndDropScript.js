/**
 * function to enable to drag the elements enitity, relationship an isA into the editor area (droppable container)
 * while the draggable function is triggered for an element, create a clone from the original element which should be dragged.
 * enable also to move the dropped elements inside the editor area.
 * @author Antonia Gabriel
 */
$(function () {

    entityInputNo = 0;
    relationshipInputNo = 0;
    isAInputNo = 0;


//set editor as a droppable container
    $(".editor").droppable({
        drop: function (event, ui) {

            //defines element which ist allowed to be dropped: the cloned version from the original element returned by the function
            $element = ui.helper.clone();
            //make dropped element draggable again
            $element.draggable({
                cancel: false,
                containment: $('.editor'),
                cursor: 'move',
                stop: function (event, ui) {
                    // position of the draggable-element minus position of the droppable-element
                    // relative to the document
                    var newPosX = ui.offset.left - $('.editor').offset().left;
                    var newPosY = ui.offset.top - $('.editor').offset().top;
                    console.info($element.attr("id"));
                    console.info("new Position X: ", newPosX, "new Position Y: ", newPosY);


                    if ($element.attr("id").includes("entity")) {
                        $function = 'changePositionEntity'
                    } else if ($element.attr("id").includes("relationship")) {
                        $function = 'changePositionRelationship'
                    } else if ($element.attr("id").includes("isA")) {
                        $function = 'changePositionIsA'
                    }
                    //change position of the dragged element
                    $.post(
                        "../Interface/Connector.php",
                        {
                            function: $function,
                            id: $element.attr("id"),
                            xaxis: newPosX,
                            yaxis: newPosY,
                        },
                        function (result) {
                            console.log(result);
                        });


                    //update position of the lines attached to the dragged element
                    if (lineNumber > 0) {
                        FrontendController.updateLines($element.attr("id"));
                    }
                }
            });

            // if the original draggable element has the id "entity", increase entityInputNo and change the ID of the Clone
            if (ui.draggable.attr('id') == 'entity') {
                entityInputNo++;
                $element.attr("id", 'entity' + entityInputNo);
                console.info($element.attr("id"))
                //insert Clone into the droppable container
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addEntity",
                        id: $element.attr("id"),
                        name: $element.attr("id"),
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function (result) {
                        console.log(result);
                    });

            }

            if (ui.draggable.attr('id') == 'relationship') {
                relationshipInputNo++;
                $element.attr("id", 'relationship' + relationshipInputNo);
                console.info($element.attr("id"))
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addRelationship",
                        id: $element.attr("id"),
                        name: $element.attr("id"),
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function (result) {
                        console.log(result);
                    });
            }

            if (ui.draggable.attr('id') == 'isA') {
                isAInputNo++;
                $element.attr("id", 'isA' + isAInputNo);
                console.info($element.attr("id"))
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addGeneralisation",
                        id: $element.attr("id"),
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function (result) {
                        console.log(result);
                    });

            }

        }
    });

//Set entity as a draggable layer
    $(".entity").draggable({
        //cancel the default click event of the button
        cancel: false,
        //define the area where the element can be dragged to
        containment: '#editor',
        cursor: 'move',
        //which element should be dragged? not the original, instead the new one returned from the function
        helper: entityClone,

    });

//Set relationship as a draggable layer
    $(".relationship").draggable({
        cancel: false,
        containment: '#editor',
        cursor: 'move',
        helper: relationshipClone,

    });

//Set isA as a draggable layer
    $(".isA").draggable({
        cancel: false,
        containment: '#editor',
        cursor: 'move',
        helper: isAClone,

    });
});


//create clone from entity-button with new ID
function entityClone() {
    return '<button id="entity' + entityInputNo + '" class="entity" onclick="openEntityMenu(this)"></button>';
}

//create clone from relationship-button with new ID
function relationshipClone() {
    return '<button id="relationship' + relationshipInputNo + '" class="relationship" onclick="openRelationshipMenu(this)"></button>';
}

//create clone from isA-button with new ID
function isAClone() {
    return '<button id="isA' + isAInputNo + '" class="isA" onclick="openGeneralisationMenu(this)"></button>';
}

//opens entityMenu and loads backend data in menu
function openEntityMenu(entity) {
    document.getElementById("rightMenueBox").style.visibility = "visible";
    document.getElementById("idEntityName").value = entity.innerHTML;
    document.getElementById("pEntityID").innerText = entity.id;
    FrontendController.getEntityFromBackend(entity.id);

}

//opens relationshipMenu and loads backend data in menu
function openRelationshipMenu(relationship) {
    document.getElementById("generalisationMenu").style.display = "none";
    document.getElementById("relationshipMenu").style.display = "block";
    document.getElementById("pRelationshipID").innerText = relationship.id;
    document.getElementById("inputRelationshipName").value = relationship.innerText;
    FrontendController.updateRelationship(relationship.id);
    console.info("öffnet Relationship-Menü");
}

//opens generalisationMenu and loads backend data in menu
function openGeneralisationMenu(generalisation) {
    document.getElementById("generalisationMenu").style.display = "block";
    document.getElementById("relationshipMenu").style.display = "none";
    document.getElementById("pGeneralisationID").innerText = generalisation.id;
    FrontendController.getGeneralisationFromBackend(generalisation.id);
    //document.getElementById("inputGeneralisationName").value = generalisation.innerText;
    //FrontendController.updateRelationship(relationship.id);
    //console.info("öffnet Relationship-Menü");

    //set Dropboxes
    var dropboxContent = [];
    dropboxContent[0] = document.getElementById("generalisationContent1")
    dropboxContent[1] = document.getElementById("generalisationContent2")
    dropboxContent[2] = document.getElementById("generalisationContent3")

    var entities = document.getElementsByClassName("entity"); //for some reason element 0 of array unusable (so 4 elements for 3 entities)
    this.entities = null;
    if (!(arrayEquals(entities, this.entities))) {

        dropboxContent.forEach(function (dropboxContent) {
            dropboxContent.innerHTML = "";
            for (i = 1; i < entities.length; i++) {
                var aElement = document.createElement('a');
                //aElement.setAttribute("onclick","function");
                aElement.onclick = function () {
                    selectGeneralisationDropdown(this);
                };
                //aElement.addEventListener("click", selectGeneralisationDropdown(this));
                aElement.href = "#";
                aElement.innerHTML = entities[i].innerHTML;
                //var innerText = entities[i].innerText;
                //var aElement = '<a href="#" class="selNotDorp01" onclick="selectNotationDropdown(\'1\',\'01\')">entity1</a>';
                //aElement.innerText = entities[i];
                dropboxContent.appendChild(aElement);
                //dropboxContent.innerHTML= '<a href="#" class="selNotDorp01" onclick="selectNotationDropdown(\'1\',\'01\')">entity1</a>';
            }
        });
        this.entities = entities;
    }

}


