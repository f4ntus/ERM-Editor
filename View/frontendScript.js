function generalizationMode(mode) {
    let outputText = document.getElementById("showGeneralizationMode");
    outputText.innerText = mode;
}

function selectEntityDropdown(entity, number) {
    let element = "dropdownEntityText" + number;
    let outputText = document.getElementById(element);
    outputText.innerText = entity;
}

function selectNotationDropdown(notation, number) {
    let element = "dropdownNotationText" + number;
    let outputText = document.getElementById(element);
    outputText.innerText = notation;
}

function onClickButtonAddRelationship(rowNuber) {
    // insert new row in Table
    var table = document.getElementById("tblRelationship");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    // get HTML code from the first row of the Table
    var colEntity = '<td id="colRelEntity">\n' +
        '                    <div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownEntityText' + rowNuber + '">Entity</p>\n' +
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content" >\n' +
        '                            <a href="#" onclick="selectEntityDropdown(\'Gebäude\',\'' + rowNuber + '\')">Gebäude</a>\n' +
        '                            <a href="#" onclick="selectEntityDropdown(\'Raum\',\'' + rowNuber + '\')">Raum</a>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>'
    var colNotation = '<div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownNotationText' + rowNuber + '">n</p>\n' +
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content" id="entityContent">\n' +
        '                            <a href="#" class="selNotDorp01" onclick="selectNotationDropdown(\'1\',\'' + rowNuber + '\')">1</a>\n' +
        '                            <a href="#" class="selNotDorp02" onclick="selectNotationDropdown(\'n\',\'' + rowNuber + '\')">n</a>\n' +
        '                            <a href="#" class="selNotDorp03" onclick="selectNotationDropdown(\'m\',\'' + rowNuber + '\')">m</a>\n' +
        '                        </div>\n' +
        '                    </div>'
    var colWeakEntity = '<td id="colRelWeakEntity"> <input type="checkbox" name="weakEntity' + rowNuber + '"></td>'
    // insert the HTML Code in the new Row
    cell1.innerHTML = rowNuber;
    cell2.innerHTML = colEntity;
    cell3.innerHTML = colNotation;
    cell4.innerHTML = colWeakEntity;
    // change button Attribute for the next higher rowNumber
    var btnAddRelationship = document.getElementById("btnAddRelationship");
    var newRowNumber = rowNuber + 1;
    var onClickFunktionString = "onClickButtonAddRelationship(" + rowNuber + 1 + ")"
    btnAddRelationship.setAttribute("onClick", "onClickButtonAddRelationship(" + newRowNumber + ")")
}

function onClickERMReset() {
    $.post(
        "../Interface/Connector.php",
        {
            function: "resetERM",
        },
        function (result) {
            alert(result);
        }
    );
}

function onClickButtonAddSingleValueAttribute() {

    document.getElementById("idDivAddSimpleAttribute").style.display = "block";
    document.getElementById("idDivAddMultiValueAttribute").style.display = "none";
    document.getElementById("idDivAddCompoundAttribute").style.display = "none";

}

function onClickButtonAddMultiValueAttribute() {

    document.getElementById("idDivAddSimpleAttribute").style.display = "none";
    document.getElementById("idDivAddMultiValueAttribute").style.display = "block";
    document.getElementById("idDivAddCompoundAttribute").style.display = "none";

}

function onClickButtonAddCompoundAttribute() {

    document.getElementById("idDivAddSimpleAttribute").style.display = "none";
    document.getElementById("idDivAddMultiValueAttribute").style.display = "none";
    document.getElementById("idDivAddCompoundAttribute").style.display = "block";

}

function onClickAddSubAttributeRow() {

    var table = document.getElementById("idTableCompoundAttribute");
    var numberRows = table.rows.length;
    if (numberRows === 7) {
        //Maximale Anzahl an Unterattributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(numberRows - 1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "Unterattribut";
    cell2.innerHTML = "<input placeholder=\"\" type=\"text\" id=\"idSubValueAttribute\" name=\"idSubValueAttribute\"/>";
}

function onClickAddSubtypeRow() {

    var table = document.getElementById("tableGeneralisation");
    var numberRows = table.rows.length;
    if (numberRows === 9) {
        //Maximale Anzahl an Unterattributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(numberRows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    var clone = document.getElementById("dropdown1").cloneNode(true);
    clone.id = "dropdown" + numberRows;
    clone.children[0].innerText = "default";
    clone.children[0].id = "dropdownGeneralisationText0" + (numberRows+1);
    //set onclick eventhandler for aElements of clone
    for (i = 0; i < clone.children[2].children.length; i++) {
        var aElement = clone.children[2].children[i];
        aElement.onclick = function () {
            selectGeneralisationDropdown(this);
        };
    }
    cell1.innerHTML = "Subtyp";
    cell2.appendChild(clone);
}


function onClickAddSimpleAttributeToTable() {
    var sAttributeName = document.getElementById("idSimpleAttributeName").value;
    FrontendController.addRowAttributeToTable(
        "idCheckboxPK",
        true,
        0,
        sAttributeName,
        sAttributeName,
        'entityAttribute',
        0);
}

function onClickAddMultiValueAttributeToTable() {
    var sAttributeName = document.getElementById("idMultiValueAttributeName").value;
    var sAttributeValue = "{" + sAttributeName + "}";
    FrontendController.addRowAttributeToTable(
        "",
        false,
        1,
        sAttributeName,
        sAttributeValue,
        'entityAttribute',
        0);
}

function onClickAddCompoundAttributeToTable() {
    var sUpperAttributeName = document.getElementById("idUpperAttributeName").value;
    var aSubValues = [];
    var oTable = document.getElementById("idTableCompoundAttribute");

    //prepare array for sub attributes
    for (var i = 1; i < oTable.rows.length - 1; i++) {
        aSubValues[i - 1] = oTable.rows[i].cells[1].children[0].value;
    }

    //prepare compount attributre string for ui output
    var sCompoundAttribute = sUpperAttributeName + "(";
    for (var i = 0; i < aSubValues.length; i++) {
        if (i == aSubValues.length - 1) {
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ")";
        } else {
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ",";
        }
    }
    FrontendController.addRowAttributeToTable(
        "idCheckboxPK2",
        true,
        2,
        sUpperAttributeName,
        sCompoundAttribute,
        'entityAttribute',
        0);
}


function onClickDeleteAttribute(oSelectedButton, tableId) {
    let table = document.getElementById(tableId);
    let rowIndex = oSelectedButton.parentNode.parentNode.rowIndex;
    table.deleteRow(rowIndex);
}


function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("idTableEntityAttributes");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            compareAttributeIndex1 = parseInt(rows[i].cells[3].innerHTML);
            compareAttributeIndex2 = parseInt(rows[i + 1].cells[3].innerHTML);

            if (compareAttributeIndex1 > compareAttributeIndex2) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function onClickFinishEntityMenue() {
    let newEntityName = document.getElementById("idEntityName").value;
    let entityID = document.getElementById("pEntityID").innerHTML;
    let oldEntityName = document.getElementById(entityID).innerText;
    document.getElementById(entityID).innerText = newEntityName;
    if (FrontendController.checkEntityName(newEntityName)){
        FrontendController.pushEntity(entityID, newEntityName);
        document.getElementById("rightMenue").style.visibility = "hidden";
    } else {
        document.getElementById(entityID).innerText = oldEntityName;
        document.getElementById("idEntityName").value = oldEntityName;
    }
}

function onClickButtonDeleteEntity() {

    let entityID = document.getElementById("pEntityID").innerHTML;
    let deleteEntity = document.getElementById(entityID);

    //Remove the selected element from the document
    deleteEntity.remove();
    document.getElementById("rightMenue").style.visibility = "hidden";
    $.post(
        "../Interface/Connector.php",
        {
            function: "deleteEntity",
            id: entityID,
        },
        function (result) {
            console.log(result);
        }
    );

}


function onClickFinishGeneralisationMenue() {
    var tableGeneralisation = document.getElementById("tableGeneralisation");
    var generalisierungId = document.getElementById("pGeneralisationID").innerText;

    var arrayGeneralisation = [];

    for (i = 0; i < tableGeneralisation.rows.length; i++) {
        arrayGeneralisation[i] = tableGeneralisation.rows[i].cells[1].children[0].innerText;
    }
    FrontendController.pushGeneralisation(generalisierungId, arrayGeneralisation);
}

function onClickButtonDeleteGeneralisation() {
    let generalisationID = document.getElementById("pGeneralisationID").innerHTML;
    let deleteGeneralisation = document.getElementById(generalisationID);
    //Remove the selected element from the document
    deleteGeneralisation.remove();
    document.getElementById("generalisationMenu").style.visibility = "hidden";
    $.post(
        "../Interface/Connector.php",
        {
            function: "deleteIsA",
            id: generalisationID,
        },
        function (result) {
            console.log(result);
        }
    );
}

// ----------------------------------------------- for Releationship Menu ------------------------------------
// -----------------------------------------------------------------------------------------------------------

function onInputRelationshipName(oTextbox) {
    let id = document.getElementById("pRelationshipID").innerHTML;
    document.getElementById(id).innerText = oTextbox.value;
}

function onClickEntitySelection(sRelationshipNo) {
    aEntitys = document.getElementsByClassName("entity");
    let entityLists = '';
    console.log(aEntitys.length)
    for (let i = 0; i < aEntitys.length; i++) {
        if (aEntitys[i].id != "entity") { // exclude object from the right menu
            console.log(aEntitys);
            entityLists += '<a href="#" onClick="selectEntityDropdown(\'' + aEntitys[i].innerHTML + '\',\'' + sRelationshipNo + '\')">' + aEntitys[i].innerHTML + '</a>';
        }
    }
    let oDropDownContent = document.getElementById("EntitySelectionDropDownContent" + sRelationshipNo)
    oDropDownContent.innerHTML = entityLists;
    oDropDownContent.style.display = "block";
}

function selectEntityDropdown(entity, number) {
    let element = "dropdownEntityText" + number;
    let outputText = document.getElementById(element);
    console.log()
    outputText.innerText = entity;
    let oDropDownContent = document.getElementById("EntitySelectionDropDownContent" + number);
    oDropDownContent.style.display = "none";
}

function selectNotationDropdown(notation, number) {
    let element = "dropdownNotationText" + number;
    let outputText = document.getElementById(element);
    outputText.innerText = notation;
}

function selectGeneralisationDropdown(aElement) {
    aElement.parentElement.parentElement.children[0].innerText = aElement.innerText;
}

function onClickButtonAddRelationship(rowNuber) {
    // insert new row in Table
    var table = document.getElementById("tblRelationship");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    // get HTML code from the first row of the Table
    var colEntity = '<td id="colRelEntity">\n' +
        '                    <div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownEntityText' + rowNuber + '">Entity</p>\n' +
        '                        <button class="dropbtnArrow" onClick="onClickEntitySelection(' + rowNuber + ')"></button>\n' +
        '                        <div class="dropdown-content" id="EntitySelectionDropDownContent' + rowNuber + '" >\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>'
    var colNotation = '<div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownNotationText' + rowNuber + '">n</p>\n' +
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content hoverContent" id="entityContent">\n' +
        '                            <a href="#" class="selNotDorp01" onclick="selectNotationDropdown(\'1\',\'' + rowNuber + '\')">1</a>\n' +
        '                            <a href="#" class="selNotDorp02" onclick="selectNotationDropdown(\'n\',\'' + rowNuber + '\')">n</a>\n' +
        '                            <a href="#" class="selNotDorp03" onclick="selectNotationDropdown(\'m\',\'' + rowNuber + '\')">m</a>\n' +
        '                        </div>\n' +
        '                    </div>'
    var colWeakEntity = '<td id="colRelWeakEntity"> <input type="checkbox" name="weakEntity' + rowNuber + '"></td>'
    // insert the HTML Code in the new Row
    cell1.innerHTML = rowNuber;
    cell2.innerHTML = colEntity;
    cell3.innerHTML = colNotation;
    cell4.innerHTML = colWeakEntity;
    // change button Attribute for the next higher rowNumber
    var btnAddRelationship = document.getElementById("btnAddRelationship");
    var newRowNumber = rowNuber + 1;
    var onClickFunktionString = "onClickButtonAddRelationship(" + rowNuber + 1 + ")"
    btnAddRelationship.setAttribute("onClick", "onClickButtonAddRelationship(" + newRowNumber + ")")
}

function onClickAddSimpleAttributeToRelationship() {
    document.getElementById("idDivAddSimpleAttributeRel").style.display = "block";
    document.getElementById("idDivAddMultiValueAttributeRel").style.display = "none";
    document.getElementById("idDivAddCompoundAttributeRel").style.display = "none";
}

function onClickAddMultiValueAttributeToRelationship() {
    document.getElementById("idDivAddSimpleAttributeRel").style.display = "none";
    document.getElementById("idDivAddMultiValueAttributeRel").style.display = "block";
    document.getElementById("idDivAddCompoundAttributeRel").style.display = "none";
}

function onClickAddCompoundAttributeToRelationship() {
    document.getElementById("idDivAddSimpleAttributeRel").style.display = "none";
    document.getElementById("idDivAddMultiValueAttributeRel").style.display = "none";
    document.getElementById("idDivAddCompoundAttributeRel").style.display = "block";
}

function onClickAddSimpleAttributeToTableRel() {
    var sAttributeName = document.getElementById("idSimpleAttributeNameRel").value;
    FrontendController.addRowAttributeToTable(
        "idCheckboxPK",
        false,
        0,
        sAttributeName,
        sAttributeName,
        'relationshipAttribute',
        0);
}

function onClickAddMultiValueAttributeToTableRel() {
    var sAttributeName = document.getElementById("idMultiValueAttributeNameRel").value;
    var sAttributeValue = "{" + sAttributeName + "}";
    FrontendController.addRowAttributeToTable(
        "",
        false,
        1,
        sAttributeName,
        sAttributeValue,
        'relationshipAttribute',
        0);
}

function onClickAddCompoundAttributeToTableRel() {
    var sUpperAttributeName = document.getElementById("idUpperAttributeNameRel").value;
    var aSubValues = [];
    var oTable = document.getElementById("idTableCompoundAttributeRel");

    //prepare array for sub attributes
    for (var i = 1; i < oTable.rows.length - 1; i++) {
        aSubValues[i - 1] = oTable.rows[i].cells[1].children[0].value;
    }

    //prepare compount attributre string for ui output
    var sCompoundAttribute = sUpperAttributeName + "(";
    for (var i = 0; i < aSubValues.length; i++) {
        if (i == aSubValues.length - 1) {
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ")";
        } else {
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ",";
        }
    }
    FrontendController.addRowAttributeToTable(
        "idCheckboxPK2",
        false,
        2,
        sUpperAttributeName,
        sCompoundAttribute,
        'relationshipAttribute',
        0);
}

function onClickAddSubAttributeRowRel() {
    // diese Funktion auslagern da fast gleich wie onClickAddSubAttributeRow()
    var table = document.getElementById("idTableCompoundAttributeRel");
    var numberRows = table.rows.length;
    if (numberRows === 7) {
        //Maximale Anzahl an Unterattributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(numberRows - 1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "Unterattribut";
    cell2.innerHTML = "<input placeholder=\"\" type=\"text\" id=\"idSubValueAttribute\" name=\"idSubValueAttribute\"/>";
}

function onClickButtonSubmitRelationship() {
    FrontendController.pushRelationship();
    document.getElementById("relationshipMenu").style.visibility = 'hidden';
}

function onClickButtonDeleteRelationship() {

    let relationshipID = document.getElementById("pRelationshipID").innerHTML;
    let deleteRelationship = document.getElementById(relationshipID);
    //Remove the selected element from the document
    deleteRelationship.remove();
    document.getElementById("relationshipMenu").style.visibility = "hidden";
    $.post(
        "../Interface/Connector.php",
        {
            function: "deleteRelationship",
            id: relationshipID,
        },
        function (result) {
            console.log(result);
        }
    );
}

function onClickChangeERMModel() {
    FrontendController.changeERMModel();
}


function onClickButtonDrawLines(){
    FrontendController.drawLines2();
}

function arrayEquals(a, b) {
    return Array.isArray(a) &&
        Array.isArray(b) &&
        a.length === b.length &&
        a.every((val, index) => val === b[index]);
}

