function generalizationMode(mode) {
    let outputText = document.getElementById("showGeneralizationMode");
    outputText.innerText = mode;
}

function selectEntityDropdown(entity, number){
    let element = "dropdownEntityText" + number;
    let outputText = document.getElementById(element);
    outputText.innerText = entity;
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
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content" >\n' +
        '                            <a href="#" onclick="selectEntityDropdown(\'Gebäude\',\''+rowNuber+'\')">Gebäude</a>\n' +
        '                            <a href="#" onclick="selectEntityDropdown(\'Raum\',\''+rowNuber+'\')">Raum</a>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </td>'
    var colNotation = '<div class="dropdown">\n' +
        '                        <p class="dorpdowntext" id="dropdownNotationText'+rowNuber+'">n</p>\n' +
        '                        <button class="dropbtnArrow"></button>\n' +
        '                        <div class="dropdown-content" id="entityContent">\n' +
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

function onClickButtonAddSimpleAttribute() {

    document.getElementById("idDivAddAttribute").innerHTML =

        document.getElementById("idDivAddAttribute").innerHTML =

            '            <h4>Einfaches Attribut hinzufügen:</h4>\n' +
            '            <div class="column" style="width: 30%;">\n' +
            '                <button class="button2">Einfaches<br>Attribut<br>hinzufügen</button>\n' +
            '            </div>\n' +
            '            <div class="column2" style="width: 70%;">\n' +
            '                <table style="width:80%;" >\n' +
            '                    <tr>\n' +
            '                        <th>Attributname</th>\n' +
            '                        <th>PK</th>\n' +
            '                    </tr>\n' +
            '                    <tr>\n' +
            '                        <td><input placeholder="" type="text" id="idSimpleAttributeName" name="idSimpleAttributeName"/></td>\n' +
            '                        <td><input type="checkbox" id="idCheckboxPK" name="idCheckboxPK"/></td>\n' +
            '                    </tr>\n' +
            '                </table>\n' +
            '            </div>';

}

function onClickButtonAddMultiValueAttribute() {

    document.getElementById("idDivAddAttribute").innerHTML =

        '<h4>Mehrwertiges Attribut Attribut hinzufügen:</h4>\n' +
        '            <div class="column" style="width: 30%;">\n' +
        '                <button class="button2">Mehrwertiges<br>Attribut<br>hinzufügen</button>\n' +
        '            </div>\n' +
        '            <div class="column2" style="width: 70%;">\n' +
        '                <table style="width:70%">\n' +
        '                    <tr>\n' +
        '                        <th style="text-align: center;" >Mehrwertiges Attribut</th>\n' +
        '                    </tr>\n' +
        '                    <tr>\n' +
        '                        <td>\n' +
        '                            <div class="row">\n' +
        '\n' +
        '                                { <input placeholder=""   type="text" id="idMultiValueAttributeName"\n' +
        '                                       name="idMultiValueAttributeName"/> }\n' +
        '\n' +
        '                            </div>\n' +
        '                        </td>\n' +
        '\n' +
        '                    </tr>\n' +
        '                </table>\n' +
        '            </div>';


}

function onClickButtonAddCompoundAttribute() {


}