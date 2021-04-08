function generalizationMode(mode) {
    let outputText = document.getElementById("showGeneralizationMode");
    outputText.innerText = mode;
}


function onClickButtonAddSimpleAttribute() {

    document.getElementById("idDivAddAttribute").innerHTML =

        document.getElementById("idDivAddAttribute").innerHTML =

            '            <h4>Einfaches Attribut hinzufügen:</h4>\n' +
            '            <div class="column" style="width: 30%;">\n' +
            '                <button class="button2">Einfaches<br>Attribut<br>hinzufügen</button>\n' +
            '            </div>\n' +
            '            <div class="column2" style="width: 60%;">\n' +
            '                <table style="" >\n' +
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

        '<h4>Mehrwertiges Attribut hinzufügen:</h4>\n' +
        '            <div class="column" style="width: 30%;">\n' +
        '                <button class="button2">Mehrwertiges<br>Attribut<br>hinzufügen</button>\n' +
        '            </div>\n' +
        '            <div class="column2" style="width: 65%;">\n' +
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

    document.getElementById("idDivAddAttribute").innerHTML =

        '<h4>Zusammengesetztes Attribut Attribut hinzufügen:</h4>\n' +
        '            <div class="column" style="width: 30%;">\n' +
        '                <button class="button2">Zusammengesetztes<br>Attribut<br>hinzufügen</button>\n' +
        '            </div>\n' +
        '            <div class="column2" style="width: 65%;">\n' +
        '                <table style="width:70%">\n' +
        '                    <tr>\n' +
        '                        <th style="text-align: center;" >Oberattribut</th>\n' +

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

function onClickAddSubAttributeRow(){

    var table = document.getElementById("idTableCompoundAttribute");
    var numberRows = table.rows.length;
    alert(numberRows);
    var row = table.insertRow(numberRows-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    cell1.innerHTML = "Unterattribut";
    cell2.innerHTML = "<input placeholder=\"\" type=\"text\" id=\"idSubValueAttribute\" name=\"idSubValueAttribute\"/>";





}