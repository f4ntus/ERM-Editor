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

function onClickAddSubAttributeRow(){

    var table = document.getElementById("idTableCompoundAttribute");
    var numberRows = table.rows.length;
    if(numberRows === 7){
        //Maximale Anzahl an Unterattributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(numberRows-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "Unterattribut";
    cell2.innerHTML = "<input placeholder=\"\" type=\"text\" id=\"idSubValueAttribute\" name=\"idSubValueAttribute\"/>";

}
var sAttributeName;
var iType;
var bPrimary;

var iAttributeCount = 0;



function onClickAddSimpleAttributeToTable() {



    sAttributeName = document.getElementById("idSimpleAttributeName").value;
    iType = 1;
    bPrimary = document.getElementById("idCheckboxPK").checked;


    var table = document.getElementById("idTableEntityAttributes");
    var numberRows = table.rows.length;
    if(numberRows === 20){
        //Maximale Anzahl an Attributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "<button id=\"idRemoveAttribute\">X</button>";
    cell2.innerHTML = "Test";



}
function onClickAddMultiValueAttributeToTable() {

    var sAttributeName;
    var iType;
    var bPrimary;

    sAttributeName = document.getElementById("idMultiValueAttributeName").value;

    idMultiValueAttributeName
    idMultiValueAttributeName

}
function onClickAddCompoundAttributeToTable() {

    var sAttributeName;
    var iType;
    var bPrimary;

    sAttributeName = document.getElementById("idUpperAttributeName").value;

    idUpperAttributeName
    idSubValueAttribute1
    idSubValueAttribute1

}