function generalizationMode(mode) {
    let outputText = document.getElementById("showGeneralizationMode");
    outputText.innerText = mode;
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



function onClickAddSimpleAttributeToTable() {
    var sAttributeName = document.getElementById("idSimpleAttributeName").value;
    addRowAttributeToTable("idCheckboxPK",true,0,sAttributeName,'entityAttribute');
}

function onClickAddMultiValueAttributeToTable() {
   var sAttributeName = document.getElementById("idMultiValueAttributeName").value;
   var sAttributeValue = "{" + sAttributeName + "}";
    addRowAttributeToTable("",false,1,sAttributeValue, 'entityAttribute');
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
    addRowAttributeToTable("idCheckboxPK2", true, 2, sCompoundAttribute, 'entityAttribute');
}

function addRowAttributeToTable(idCheckboxPK, primaryKeyNeeded, attributeType, sAttributeValue,tableType){
    if (tableType === 'entityAttribute'){
        var table = document.getElementById("idTableEntityAttributes");
    } else { // tableType = relationshipAttribute
        var table = document.getElementById("idTableRelationshipAttributes");
    }
    var numberRows = table.rows.length;
    if (numberRows === 20) {
        //Maximale Anzahl an Attributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(numberRows - 1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    if (tableType === 'entityAttribute') {
        var cell4 = row.insertCell(3);
    }

    if (tableType === 'entityAttribute'){
        cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableEntityAttributes\')\">X</button>";
    } else { // tableType = relationshipAttribute
        cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableRelationshipAttributes\')\">X</button>";
    }

    cell3.innerHTML = sAttributeValue;

    if(primaryKeyNeeded===true){
        bPrimary = document.getElementById(idCheckboxPK).checked;
        cell4.innerHTML = "<label class=\"switch\">\n" +
        "                        <input id='idCheckboxPrimaryKeyMainTable" + table.rows.length + "' type=\"checkbox\">\n" +
        "                        <span class=\"slider round\"></span>\n" +
        "                    </label>";
        if (bPrimary) {
            var sCheckboxId = "idCheckboxPrimaryKeyMainTable" + table.rows.length;
            document.getElementById(sCheckboxId).checked = true;
        }
    }else{
        if (tableType === 'entityAttribute') {
            cell4.innerHTML = "";
        }
    }
    //Metadata for simple/multivalue/compound attribute
    cell1.innerHTML = attributeType;
    cell1.style.display = "none";
    //sortTable();
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
    newEntityName = document.getElementById("idEntityName").value;
    oldEntityName = document.getElementById("displayEntityName").innerText;
    entity = document.getElementById(oldEntityName);
    entity.innerText = newEntityName;
    entity.id = newEntityName;
    document.getElementById("rightMenue").style.visibility = "hidden";
}
// ----------------------------------------------- for Releationship Menu ------------------------------------
// -----------------------------------------------------------------------------------------------------------

function onInputRelationshipName(oTextbox){
    let id = document.getElementById("pRelationshipID").innerHTML;
    document.getElementById(id).innerText = oTextbox.value;
}
function onClickEntitySelection(sRelationshipNo){
    aEntitys = document.getElementsByClassName("entity");
    let entityLists = '';
    console.log(aEntitys.length)
    for (let i = 0; i < aEntitys.length; i++){
        if (aEntitys[i].id != "entity"){ // exclude object from the right menu
            console.log(aEntitys);
            entityLists += '<a href="#" onClick="selectEntityDropdown(\''+ aEntitys[i].innerHTML +'\',\''+ sRelationshipNo +'\')">'+ aEntitys[i].innerHTML +'</a>';
        }
    }
    let oDropDownContent = document.getElementById("EntitySelectionDropDownContent" + sRelationshipNo)
    oDropDownContent.innerHTML = entityLists;
    oDropDownContent.style.display = "block";
}
function selectEntityDropdown(entity, number){
    let element = "dropdownEntityText" + number;
    let outputText = document.getElementById(element);
    console.log()
    outputText.innerText = entity;
    let oDropDownContent = document.getElementById("EntitySelectionDropDownContent" + number);
    oDropDownContent.style.display = "none";
}
function selectNotationDropdown(notation, number){
    let element = "dropdownNotationText" + number;
    let outputText = document.getElementById(element);
    outputText.innerText = notation;
}
function onClickButtonAddRelationship(rowNuber){
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
        '                        <p class="dorpdowntext" id="dropdownEntityText'+rowNuber+'">Entity</p>\n' +
        '                        <button class="dropbtnArrow" onClick="onClickEntitySelection('+rowNuber+')"></button>\n' +
        '                        <div class="dropdown-content" id="EntitySelectionDropDownContent'+rowNuber+'" >\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>'
    var colNotation = '<div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownNotationText'+rowNuber+'">n</p>\n' +
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content hoverContent" id="entityContent">\n' +
        '                            <a href="#" class="selNotDorp01" onclick="selectNotationDropdown(\'1\',\''+rowNuber+'\')">1</a>\n' +
        '                            <a href="#" class="selNotDorp02" onclick="selectNotationDropdown(\'n\',\''+rowNuber+'\')">n</a>\n' +
        '                            <a href="#" class="selNotDorp03" onclick="selectNotationDropdown(\'m\',\''+rowNuber+'\')">m</a>\n' +
        '                        </div>\n' +
        '                    </div>'
    var colWeakEntity = '<td id="colRelWeakEntity"> <input type="checkbox" name="weakEntity'+rowNuber+'"></td>'
    // insert the HTML Code in the new Row
    cell1.innerHTML = rowNuber;
    cell2.innerHTML = colEntity;
    cell3.innerHTML = colNotation;
    cell4.innerHTML = colWeakEntity;
    // change button Attribute for the next higher rowNumber
    var btnAddRelationship = document.getElementById("btnAddRelationship");
    var newRowNumber = rowNuber+1;
    var onClickFunktionString = "onClickButtonAddRelationship("+rowNuber+1+")"
    btnAddRelationship.setAttribute("onClick", "onClickButtonAddRelationship("+newRowNumber+")" )
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

function onClickAddCompoundAttributeToRelationship () {
    document.getElementById("idDivAddSimpleAttributeRel").style.display = "none";
    document.getElementById("idDivAddMultiValueAttributeRel").style.display = "none";
    document.getElementById("idDivAddCompoundAttributeRel").style.display = "block";
}
function onClickAddSimpleAttributeToTableRel(){
    var sAttributeName = document.getElementById("idSimpleAttributeNameRel").value;
    addRowAttributeToTable("idCheckboxPK",false,0,sAttributeName, 'relationshipAttribute');
}
function onClickAddMultiValueAttributeToTableRel(){
    var sAttributeName = document.getElementById("idMultiValueAttributeNameRel").value;
    var sAttributeValue = "{" + sAttributeName + "}";
    addRowAttributeToTable("",false,1,sAttributeValue,'relationshipAttribute');
}
function onClickAddCompoundAttributeToTableRel(){
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
    addRowAttributeToTable("idCheckboxPK2", false, 2, sCompoundAttribute, 'relationshipAttribute');
}
function onClickAddSubAttributeRowRel(){
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