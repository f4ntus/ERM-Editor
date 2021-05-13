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
    onClick = '';


//set editor as a droppable container
    $(".editor").droppable({
        drop: function(event, ui) {

            //defines element which ist allowed to be dropped: the cloned version from the original element returned by the function
            $element = ui.helper.clone();

            //make dropped element draggable again
            $element.draggable({cancel: false, containment: $('.editor'), cursor: 'move'});

            // position of the draggable-element minus position of the droppable-element
            // relative to the document
            var $newPosX = ui.offset.left - $(this).offset().left;
            var $newPosY = ui.offset.top - $(this).offset().top;
            console.info($newPosX,$newPosY);

            // if the original draggable element has the id "entity", increase entityInputNo and change the ID of the Clone
            if (ui.draggable.attr('id') == 'entity') {
                entityInputNo++;
                $element.attr("id", 'entity' + entityInputNo);
                $newIDEntity = 'entity' + entityInputNo;
                console.info($element);
                console.info($newIDEntity)
                //insert Clone into the droppable container
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
    return '<button id="isA' + isAInputNo + '" class="isA" oncontextmenu="openContextMenu(this.id)"></button>';
}

function openEntityMenu(entity){
    document.getElementById("rightMenue").style.visibility = "visible";
    document.getElementById("displayEntityName").innerText = entity.id;

}

function openRelationshipMenu(relationship){
    document.getElementById("relationshipMenu").style.visibility = "visible";
    document.getElementById("pRelationshipID").innerText = relationship.id;
    document.getElementById("inputRelationshipName").textContent = relationship.innerText;
    console.info("öffnet Relationship-Menü");
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

