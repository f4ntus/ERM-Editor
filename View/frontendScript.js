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
    var cell3 = row.insertCell(2);

    cell1.innerHTML = "<button onclick=\"onClickDeleteAttribute(this.value)\">X</button>";
    cell2.innerHTML = sAttributeName;
    cell3.innerHTML = "<label class=\"switch\">\n" +
        "                        <input id='idCheckboxPrimaryKeyMainTable" + iAttributeCount + "' type=\"checkbox\">\n" +
        "                        <span class=\"slider round\"></span>\n" +
        "                    </label>";


    if(bPrimary){
        var sCheckboxId = "idCheckboxPrimaryKeyMainTable" + iAttributeCount;
        document.getElementById(sCheckboxId).checked = true;

    }

}
function onClickAddMultiValueAttributeToTable() {



    sAttributeName = document.getElementById("idMultiValueAttributeName").value;
    iType = 2;

    var table = document.getElementById("idTableEntityAttributes");
    var numberRows = table.rows.length;
    if(numberRows === 20){
        //Maximale Anzahl an Attributen erreicht Fehlermeldung
        return;
    }
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);



    cell1.innerHTML = "<button onclick=\"onClickDeleteAttribute(this.value)\">X</button>";
    cell2.innerHTML = "{"+sAttributeName+"}";
    cell3.innerHTML = ""; //not possible to set multi value attribute as pk


}
function onClickAddCompoundAttributeToTable() {


    sUpperAttributeName = document.getElementById("idUpperAttributeName").value;
    var aSubValues =[];
    var oTable = document.getElementById("idTableCompoundAttribute");

    //prepare array for sub attributes
    for(var i=1; i< oTable.rows.length -1; i++){

        aSubValues[i-1] = oTable.rows[i].cells[1].children[0].value;
    }
    //prepare compount attributre string for ui output

    var sCompoundAttribute = sUpperAttributeName + "(";
    for(var i=0; i<aSubValues.length; i++){


        if(i==aSubValues.length-1){
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ")";
        }
        else{
            sCompoundAttribute = sCompoundAttribute + aSubValues[i] + ",";

        }
    }


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
    var cell3 = row.insertCell(2);

    cell1.innerHTML = "<button onclick=\"onClickDeleteAttribute(this.value)\">X</button>";
    cell2.innerHTML = sCompoundAttribute;
    cell3.innerHTML = "<label class=\"switch\">\n" +
        "                        <input id='idCheckboxPrimaryKeyMainTable" + iAttributeCount + "' type=\"checkbox\">\n" +
        "                        <span class=\"slider round\"></span>\n" +
        "                    </label>";


    if(bPrimary){
        var sCheckboxId = "idCheckboxPrimaryKeyMainTable" + iAttributeCount;
        document.getElementById(sCheckboxId).checked = true;

    }

}

function onClickDeleteAttribute(oSelectedButton) {

}