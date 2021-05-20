/**
 * function to enable to drag the elements enitity, relationship an isA into the editor area (droppable container)
 * while the draggable function is triggered for an element, create a clone from the original element which should be dragged.
 * enable also to move the dropped elements inside the editor area.
 * @author Antonia Gabriel
 */
$(function() {

    entityInputNo = 0;
    relationshipInputNo = 0;
    isAInputNo = 0;


//set editor as a droppable container
    $(".editor").droppable({
        drop: function(event, ui) {

            //defines element which ist allowed to be dropped: the cloned version from the original element returned by the function
            $element = ui.helper.clone();
            //make dropped element draggable again
            $element.draggable({
                cancel: false,
                containment: $('.editor'),
                cursor: 'move',
                stop: function (event, ui){
                    // position of the draggable-element minus position of the droppable-element
                    // relative to the document
                    var newPosX = ui.offset.left - $('.editor').offset().left;
                    var newPosY = ui.offset.top - $('.editor').offset().top;
                    console.info($element.attr("id"));
                    console.info("new Position X: ", newPosX, "new Position Y: ", newPosY);

                    if ($element.attr("id").includes("entity")) {
                        $function = 'changePositionEntity'
                    }else if ($element.attr("id").includes("relationship")){
                        $function = 'changePositionRelationship'
                    }else if ($element.attr("id").includes("isA")){
                        $function = 'changePositionIsA'
                    }

                    $.post(
                    "../Interface/Connector.php",
                        {
                            function: $function,
                            id: $element.attr("id"),
                            xaxis: newPosX,
                            yaxis: newPosY,
                        },
                        function(result){
                            console.log(result);
                    });

                }
            });

            // if the original draggable element has the id "entity", increase entityInputNo and change the ID of the Clone
            if (ui.draggable.attr('id') == 'entity') {
                entityInputNo++;
                $element.attr("id", 'entity' + entityInputNo);
                newIDEntity = 'entity' + entityInputNo;
                console.info(newIDEntity)
                //insert Clone into the droppable container
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addEntity",
                        id: newIDEntity,
                        name: newIDEntity,
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function(result){
                        console.log(result);
                    });

            }

            if (ui.draggable.attr('id') == 'relationship') {
                relationshipInputNo++;
                $element.attr("id", 'relationship' + relationshipInputNo);
                newIDRelationship = 'relationship' + relationshipInputNo;
                console.info(newIDRelationship)
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addRelationship",
                        id: newIDRelationship,
                        name: newIDRelationship,
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function(result){
                        console.log(result);
                    });
            }

            if (ui.draggable.attr('id') == 'isA') {
                isAInputNo++;
                $element.attr("id", 'isA' + isAInputNo);
                newIDIsA = 'isA' + isAInputNo;
                console.info(newIDIsA)
                $element.appendTo(this);

                var firstPosX = ui.offset.left - $(this).offset().left;
                var firstPosY = ui.offset.top - $(this).offset().top;
                console.info("first Position X: ", firstPosX, "first Position Y: ", firstPosY);

                $.post(
                    "../Interface/Connector.php",
                    {
                        function: "addGeneralisation",
                        id: newIDIsA,
                        xaxis: firstPosX,
                        yaxis: firstPosY,
                    },
                    function(result){
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
    return '<button id="entity' + entityInputNo + '" class="entity" onclick="openEntityMenu(this)" oncontextmenu="openContextMenu(this.id)"></button>';
}
//create clone from relationship-button with new ID
function relationshipClone() {
    return '<button id="relationship' + relationshipInputNo + '" class="relationship" onclick="openRelationshipMenu(this)" oncontextmenu="openContextMenu(this.id)"></button>';
}
//create clone from isA-button with new ID
function isAClone() {
    return '<button id="isA' + isAInputNo + '" class="isA" onclick="openGeneralisationMenu(this)" oncontextmenu="openContextMenu(this.id)"></button>';
}

function openEntityMenu(entity){
    document.getElementById("rightMenue").style.visibility = "visible";
    document.getElementById("displayEntityName").innerText = entity.id;

}

function openRelationshipMenu(relationship){
    document.getElementById("relationshipMenu").style.visibility = "visible";
    document.getElementById("pRelationshipID").innerText = relationship.id;
    document.getElementById("inputRelationshipName").value = relationship.innerText;
    FrontendController.updateRelationship(relationship.id);
    console.info("öffnet Relationship-Menü");
}

function openGeneralisationMenu(generalisation){
    document.getElementById("generalisationMenu").style.display = "block";
    document.getElementById("pGeneralisationID").innerText = generalisation.id;
    //document.getElementById("inputGeneralisationName").value = generalisation.innerText;
    //FrontendController.updateRelationship(relationship.id);
    //console.info("öffnet Relationship-Menü");

    //set Dropboxes
    var dropboxContent = [];
    dropboxContent[0] = document.getElementById("generalisationContent1")
    dropboxContent[1] = document.getElementById("generalisationContent2")
    dropboxContent[2] = document.getElementById("generalisationContent3")

    var entities = document.getElementsByClassName("entity"); //for some reason element 0 of array unusable (so 4 elements for 3 entities)

    dropboxContent.forEach(function(dropboxContent){
        for(i=1; i<entities.length; i++){
            var aElement = document.createElement('a')
            //aElement.setAttribute("onclick","function");
            aElement.onclick = function() {selectGeneralisationDropdown(this);};
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


}

function openContextMenu(id){

    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    }, false);

    const deleteElement = document.getElementById(id)
    const menu = document.getElementById('menu')
    const outClick = document.getElementById('editorID')

    deleteElement.addEventListener('contextmenu', e => {
        e.preventDefault()

        menu.style.left = e.pageX + 'px';
        menu.style.top = e.pageY + 'px';
        menu.classList.add('show');

        outClick.style.display = "block";
    })

    outClick.addEventListener('click', () => {
        menu.classList.remove('show')
    })

    const deleteButton = document.getElementById('deleteButton')

    deleteButton.addEventListener('click', () => {
        //Remove the selected element from the document
        deleteElement.remove();
        menu.classList.remove('show')
    })


}

