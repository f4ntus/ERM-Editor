
function onClickButtonAddSimpleAttribute(){

    document.getElementById("idDivAddAttribute").innerHTML =

        '<div className="column" style="width: 30%;">\n' +
        '        <button className="button2">Einfaches<br>Attribut<br>hinzufügen</button>\n' +
        '    </div>\n' +
        '    <div className="column2" style="width: auto;">\n' +
        '        <table style="width:100%">\n' +
        '            <tr>\n' +
        '                <th>Attributname</th>\n' +
        '                <th>PK</th>\n' +
        '            </tr>\n' +
        '            <tr>\n' +
        '                <td><input placeholder="" type="text" id="idSimpleAttributeName" name="idSimpleAttributeName"/></td>\n' +
        '                <td><input type="checkbox" id="idCheckboxPK" name="idCheckboxPK"/></td>\n' +
        '            </tr>\n' +
        '        </table>\n' +
        '    </div>\n' +
        '    <div className="column" style="width: 30%;">\n' +
        '        <button className="button2">Einfaches<br>Attribut<br>hinzufügen</button>\n' +
        '    </div>';

}
function onClickButtonAddMultiValueAttribute(){

    document.getElementById("idDivAddAttribute").innerHTML =

        '<div className="column2" style="width: auto;">\n' +
        '            <table style="width:100%">\n' +
        '                <tr>\n' +
        '                    <th>Mehrwertiges Attribut</th>\n' +
        '\n' +
        '                </tr>\n' +
        '                <tr>\n' +
        '                    <td><input placeholder="" type="text" id="idMultiValueAttributeName"\n' +
        '                               name="idMultiValueAttributeName"/></td>\n' +
        '\n' +
        '                </tr>\n' +
        '            </table>\n' +
        '        </div>'




}
function onClickButtonAddCompoundAttribute(){

}