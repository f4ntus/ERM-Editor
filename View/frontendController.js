class FrontendController {
    static updateRelationship(sRelationshipID) {

        $.post(
            "../Interface/Connector.php",
            {
                function: "getRelationship",
                id: sRelationshipID,
            },
            function (result) {
                console.log(result);
                FrontendController.getRelationshipCallback(result);
            }
        );
    }

    static getRelationshipCallback(result) {
        let oAttributeTable = document.getElementById("idTableRelationshipAttributes");

        // clear table before refill
        let tablelenght = oAttributeTable.rows.length;
        for (let i = 0; i < tablelenght; i++) {
            oAttributeTable.deleteRow(-1);
        }
        if (result != "false") {
            let oresult = JSON.parse(result)
            document.getElementById("inputRelationshipName").value = oresult.name;
            document.getElementById(oresult.id).innerHTML = oresult.name;
            let aAttributes = oresult.attributes;
            console.log(oresult.attributes);
            for (let i in aAttributes) {
                let row = oAttributeTable.insertRow(-1);
                let cell1 = row.insertCell(0);
                let cell2 = row.insertCell(1);
                let cell3 = row.insertCell(2);
                cell1.innerHTML = aAttributes[i].typ;
                cell1.style.display = "none";
                cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableRelationshipAttributes\')\">X</button>";
                if (aAttributes[i].typ == 1) {
                    cell3.innerHTML = '{' + aAttributes[i].name + '}';
                } else {
                    cell3.innerHTML = aAttributes[i].name;
                }
                console.log(aAttributes[i].name);
            }

            //console.log(result);
        }
    }

    static pushRelationship() {
        // Informations about the Relationship
        let sRelationshipID = document.getElementById("pRelationshipID").innerHTML;
        let oRelationship = document.getElementById(sRelationshipID);
        let sXaxis = oRelationship.style.left;
        let sYaxis = oRelationship.style.top;
        let sRelationshipName = oRelationship.innerHTML;

        // Informations about Relations
        let oRelTable = document.getElementById("tblRelationship");
        let aRelations = new Array();
        for (let iRow = 2; iRow < oRelTable.rows.length; iRow++) { // beginning by the third row, because of Headlines
            let sNumber = oRelTable.rows[iRow].getElementsByTagName("td")[0].innerHTML;
            let sEntity = oRelTable.rows[iRow].getElementsByTagName("p")[0].innerHTML;
            let sNotation = oRelTable.rows[iRow].getElementsByTagName("p")[1].innerHTML;
            let bWeakness = oRelTable.rows[iRow].getElementsByTagName("input")[0].checked;
            aRelations[iRow - 2] = {
                number: sNumber,
                entity: sEntity,
                notation: sNotation,
                weakness: bWeakness
            }
        }

        // Informations about the Attributes
        let oTable = document.getElementById("idTableRelationshipAttributes");
        let aAttributes = FrontendController.getAttributesAsArray(oTable)

        // pushing the data to backend
        $.post(
            "../Interface/Connector.php",
            {
                function: "updateRelationship",
                id: sRelationshipID,
                name: sRelationshipName,
                xaxis: sXaxis,
                yaxis: sYaxis,
                attributes: aAttributes,
                relations: aRelations
            },
            function (result) {
                console.log(result);
            }
        );
    }


    static changeERMModel() {
        // pushing the data to backend
        $.post(
            "../Interface/Connector.php",
            {
                function: "changeERMModel",
            },
            function (result) {
                console.log(result);
                document.getElementById("rdmOutput").style.visibility = 'visible';
                let newString = FrontendController.changeERMModelCallback(result);
                document.getElementById("rdmOutputText").innerHTML = newString;
            }
        );
    }
    static changeERMModelCallback(result){
        let aResult = JSON.parse(result);
        let newString ='';
        for (let i in aResult){
            newString +=  aResult[i].name + ' ('
            let aAttributes = aResult[i].attributes;
            for (let i in aAttributes){
                console.log(aAttributes[i].primary);
                if (aAttributes[i].primary === 'true'){
                    console.log('test');
                    newString += '<u>' + aAttributes[i].name +' ' + aAttributes[i].reference +  '</u>';
                } else {
                    newString += aAttributes[i].name +' ' + aAttributes[i].reference;
                }
                console.log(aAttributes.length);
                if(i !== aAttributes.length - 1){
                    newString += ' ,';
                }
            }
            newString += ')<br>';
        }
        return newString;
    }

    static getEntityFromBackend(sEntityId) {
        $.post(
            "../Interface/Connector.php",
            {
                function: "getEntity",
                id: sEntityId,
            },
            function (result) {
                console.log(result);
                if (result != "false") {
                    let oResult = JSON.parse(result)
                    document.getElementById("displayEntityName").innerHTML = oResult['name'];
                    document.getElementById(sEntityId).innerHTML = oResult['name'];
                    let oTable = document.getElementById("idTableEntityAttributes");
                    FrontendController.clearAndFillAttributeTable(oTable, oResult);
                }
            }
        );
    }

    static pushEntity(entityID, entityName) {
        let aAttributes = FrontendController.getAttributesAsArray(document.getElementById("idTableEntityAttributes"));
        console.log(aAttributes);
        $.post(
            "../Interface/Connector.php",
            {
                function: "updateEntity",
                id: entityID,
                name: entityName,
                attributes: aAttributes,
            },
            function (result) {
                console.log(result);
            }
        );
    }

    static clearAndFillAttributeTable(oTable, oResult) {
        // clear table before refill
        let tablelenght = oTable.rows.length;
        console.log(tablelenght);
        for (let i = 0; i < tablelenght; i++) {
            console.log(i);
            if (oTable.rows[0].getElementsByTagName("td").length > 0) {
                oTable.deleteRow(0);
            }
        }

        let aAttributes = oResult.attributes;
        for (let i in aAttributes) {
            let sAttributeValue;
            if (aAttributes[i].typ == 1) {
                sAttributeValue = '{' + aAttributes[i].name + '}';
            } else {
                sAttributeValue = aAttributes[i].name;
            }
            FrontendController.addRowAttributeToTable(
                "",
                true,
                aAttributes[i].typ,
                sAttributeValue,
                'entityAttribute',
                1,
                aAttributes[i].primary
            )
        }

    }

    // Table Type: 'entityAttributes' -> Attributes for Entities, 'relationshipAttribute', Attributes for Relationship
    // Call from: 0 -> Client (user add an Attribute), 1 -> Server (update Attributes from Backend)
    static addRowAttributeToTable(idCheckboxPK, primaryKeyNeeded, attributeType, sAttributeValue, tableType, callFrom, bPrimary = false) {
        if (tableType === 'entityAttribute') {
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

        if (tableType === 'entityAttribute') {
            cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableEntityAttributes\')\">X</button>";
        } else { // tableType = relationshipAttribute
            cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableRelationshipAttributes\')\">X</button>";
        }

        cell3.innerHTML = sAttributeValue;

        if (primaryKeyNeeded === true) {
            if (callFrom === 0) {
                bPrimary = document.getElementById(idCheckboxPK).checked;
            }
            cell4.innerHTML = "<label class=\"switch\">\n" +
                "                        <input id='idCheckboxPrimaryKeyMainTable" + table.rows.length + "' type=\"checkbox\">\n" +
                "                        <span class=\"slider round\"></span>\n" +
                "                    </label>";
            if (bPrimary) {
                var sCheckboxId = "idCheckboxPrimaryKeyMainTable" + table.rows.length;
                document.getElementById(sCheckboxId).checked = true;
            }
        } else {
            if (tableType === 'entityAttribute') {
                cell4.innerHTML = "";
            }
        }
        //Metadata for simple/multivalue/compound attribute
        cell1.innerHTML = attributeType;
        cell1.style.display = "none";
        //sortTable();
    }

    static getAttributesAsArray(oTable) {
        // Informations about the Attributes

        let aAttributes = new Array();
        for (let iRow = 0; iRow < oTable.rows.length; iRow++) {
            if (oTable.rows[iRow].getElementsByTagName("td").length > 0) { // skip Headline row
                let sName = oTable.rows[iRow].getElementsByTagName("td")[2].innerHTML;
                let sType = oTable.rows[iRow].getElementsByTagName("td")[0].innerHTML;
                let bPrimary
                if (oTable.rows[iRow].getElementsByTagName("input").length > 0) {
                    bPrimary = oTable.rows[iRow].getElementsByTagName("input")[0].checked;
                } else {
                    bPrimary = false;
                }
                if (sType == 1) {
                    sName = sName.slice(1, -1);
                }
                let aSubattributes = '';
                if (sType == 2) {
                    let mainName = sName.split('(')[0]; // get the main Name before the open bracket (
                    aSubattributes = sName.split('(')[1].split(','); // splice the subattributes into an Array
                    aSubattributes[aSubattributes.length - 1] = aSubattributes[aSubattributes.length - 1].slice(0, -1); // remove the last bracket )
                    sName = mainName;
                }
                aAttributes[iRow] = {
                    name: sName,
                    typ: sType,
                    primary: bPrimary,
                    subattributes: aSubattributes,
                }
            }
        }
        return aAttributes;
    }

    static drawLines(){

       let entity1 = document.getElementById("entity1");
       let relationship = document.getElementById("relationship1");

        $.post(
            "../Interface/Connector.php",
            {
                function: "getPositionEntity",
                id: entity1.id,
            },
            function (result) {
                console.log(result.X);
                console.log(result.Y);

                let line = document.getElementById("line");
                line.setAttribute('x1', result.X);
                line.setAttribute('y1', result.Y);

                console.log(line);

            }, "json"
        );


        $.post(
            "../Interface/Connector.php",
            {
                function: "getPositionRelationship",
                id: relationship.id,
            },
            function (result) {
                console.log(result.X);
                console.log(result.Y);
                let line = document.getElementById("line");
                line.setAttribute('x2', result.X);
                line.setAttribute('y2', result.Y);
                console.log(line);
                // line.style.visibility = "visible";
                // console.log(line);
            }, "json"
        );


    }


}