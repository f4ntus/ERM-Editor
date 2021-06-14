class FrontendController{
    static updateRelationship(sRelationshipID){

        $.post(
            "../Interface/Connector.php",
            {
                function: "getRelationship",
                id: sRelationshipID,
            },
            function(result){
                console.log(result);
                FrontendController.getRelationshipCallback(result);
            }
        );
    }
    static getRelationshipCallback(result){
        let oAttributeTable = document.getElementById("idTableRelationshipAttributes");

        // clear table before refill
        let tablelenght = oAttributeTable.rows.length;
        for (let i =0; i < tablelenght; i++){
            oAttributeTable.deleteRow(-1);
        }
        if (result != "false"){
            let oresult = JSON.parse(result)
            document.getElementById("inputRelationshipName").value = oresult.name;
            document.getElementById(oresult.id).innerHTML = oresult.name;
            let aAttributes = oresult.attributes;
            console.log(oresult.attributes);
            for (let i in aAttributes){
                let row = oAttributeTable.insertRow(-1);
                let cell1 = row.insertCell(0);
                let cell2 = row.insertCell(1);
                let cell3 = row.insertCell(2);
                cell1.innerHTML = aAttributes[i].typ;
                cell1.style.display = "none";
                cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableRelationshipAttributes\')\">X</button>";
                if (aAttributes[i].typ == 1){
                    cell3.innerHTML = '{' + aAttributes[i].name + '}';
                } else {
                    cell3.innerHTML = aAttributes[i].name;
                }
                console.log(aAttributes[i].name);
            }
            //console.log(result);
            let aRelations = oresult.relations;
            let oRelationsTable = document.getElementById("tblRelationship")
            for (let i in aRelations) {
                let iRow = parseInt(i) + 2;
                if (parseInt(i) < 2) {
                    oRelationsTable.rows[iRow].getElementsByTagName("td")[0].innerHTML = parseInt(i) + 1;
                    oRelationsTable.rows[iRow].getElementsByTagName("p")[0].innerHTML = aRelations[i].entity;
                    oRelationsTable.rows[iRow].getElementsByTagName("p")[1].innerHTML = aRelations[i].notation;
                    if (aRelations[i].weakness === 'true') {
                        oRelationsTable.rows[iRow].getElementsByTagName("input")[0].checked = true;
                    } else {
                        oRelationsTable.rows[iRow].getElementsByTagName("input")[0].checked = false;
                    }
                }
            }
        }


    }
    static pushRelationship (){
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

        this.drawLines(sRelationshipID);
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

    static changeERMModelCallback(result) {
        let oResult = JSON.parse(result);
        let newString = '';
        for (let i in oResult) {
            newString += oResult[i].name + ' ('
            let oAttributes = oResult[i].attributes;
            for (let i in oAttributes) {
                console.log(oAttributes[i].primary);
                if (oAttributes[i].primary === 'true') {
                    console.log('test');
                    newString += '<u>' + oAttributes[i].name + ' ' + oAttributes[i].reference + '</u>';
                } else {
                    newString += oAttributes[i].name + ' ' + oAttributes[i].reference;
                }
                let iLength = Object.keys(oAttributes).length;
                if (parseInt(i) !== iLength - 1) {
                    newString += ', ';
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
                   // document.getElementById("displayEntityName").innerHTML = oResult['name'];
                    document.getElementById(sEntityId).innerHTML = oResult['name'];
                    let oTable = document.getElementById("idTableEntityAttributes");
                    FrontendController.clearAndFillAttributeTable(oTable, oResult);
                }
            }
        );
    }

    static getGeneralisationFromBackend(sGeneralisationId) {
        $.post(
            "../Interface/Connector.php",
            {
                function: "getGeneralisation",
                id: sGeneralisationId,
            },
            //
            function (result) {
                console.log(result);
                var table = document.getElementById("tableGeneralisation");
                while(table.rows.length > 3){
                    table.deleteRow(3);
                }
                if(result == "false"){

                    document.getElementById("dropdownGeneralisationText01").innerText = "default";
                    document.getElementById("dropdownGeneralisationText02").innerText = "default";
                    document.getElementById("dropdownGeneralisationText03").innerText = "default";
                }
                else{
                    let oResult = JSON.parse(result);
                    let oTable = document.getElementById("tableGeneralisation");
                    FrontendController.clearAndFillGeneralisationTable(oTable, oResult);
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

    static resetRelationsTable() {
        let oRelationsTable = document.getElementById("tblRelationship");
        let tableLength = oRelationsTable.rows.length;
        for (let iRow = 0; iRow < tableLength; iRow++) {
            if (iRow <= 3 && iRow > 1) { // resetting necessary rows
                oRelationsTable.rows[iRow].getElementsByTagName('td')[0].innerHTML = iRow - 1;
                oRelationsTable.rows[iRow].getElementsByTagName('p')[0].innerHTML = 'Entity';
                // ToDo: implement if for the right notation
                oRelationsTable.rows[iRow].getElementsByTagName('p')[1].innerHTML = 'n';
                oRelationsTable.rows[iRow].getElementsByTagName('input')[0].checked = false;
            }
            if (iRow > 3) {
                oRelationsTable.deleteRow(-1);
            }
        }
    }

    static clearAndFillAttributeTable(oTable, oResult) {
        // clear table before refill
        for(var i = 1;i<oTable.rows.length;){
            oTable.deleteRow(i);
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
                aAttributes[i].name,
                sAttributeValue,
                'entityAttribute',
                1,
                aAttributes[i].primary
            )
        }

    }

    static clearAndFillGeneralisationTable(oTable, oResult) {

        for(var i = 3 ; i<oTable.rows.length; i++){
            if(oTable.rows[i]=!undefined){
                oTable.deleteRow(i);
            }
        }

        for(let i=0; i<(Object.keys(oResult.subtypes).length)+1; i++){
            if(i===0){
                oTable.rows[i].cells[1].children[0].children[0].innerText = oResult.supertype.name;
            }
            else{
                if(typeof(oTable.rows[i]) != 'undefined' && oTable.rows[i] != null){
                    oTable.rows[i].cells[1].children[0].children[0].innerText = oResult.subtypes[i-1].name;
                }
                else{
                    //create clone
                    onClickAddSubtypeRow();
                    oTable.rows[i].cells[1].children[0].children[0].innerText = oResult.subtypes[i-1].name;
                }
            }
        }
    }

    // Table Type: 'entityAttributes' -> Attributes for Entities, 'relationshipAttribute', Attributes for Relationship
    // Call from: 0 -> Client (user add an Attribute), 1 -> Server (update Attributes from Backend)
    static addRowAttributeToTable(idCheckboxPK, primaryKeyNeeded, attributeType, sAttributeName, sAttributeValue, tableType, callFrom, bPrimary = false) {
        let iStartingNumber;
        if (tableType === 'entityAttribute') {
            var table = document.getElementById("idTableEntityAttributes");
            iStartingNumber = 1;
        } else { // tableType = relationshipAttribute
            var table = document.getElementById("idTableRelationshipAttributes");
            iStartingNumber = 0;
        }
        var numberRows = table.rows.length;
        if (numberRows === 20) {
            // ToDo: Maximale Anzahl an Attributen erreicht Fehlermeldung
            return;
        }
        if (callFrom === 0 && table.rows.length > iStartingNumber){
            // Check if Attributename is already given
           let aAttributes = this.getAttributesAsArray(table);
           for ( let i in aAttributes){
               console.log(aAttributes[i].name);
               if (aAttributes[i].name === sAttributeName){
                   alert("Der Attribute Name ist bereits vorhanden");
                   return;
               }
           }
        }
        var row = table.insertRow(numberRows);
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
            } else {
                // parse into boolean, because it comes as a String from the Backend
                bPrimary = bPrimary === 'true' ? true : false;
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


    static drawLines(sRelationshipID){

        //get all relations from current relationship
        $.post(
            "../Interface/Connector.php",
            {
                function: "getRelations",
                id: sRelationshipID,
            },
            function (result) {

                console.log(result);
                let oresult = JSON.parse(result);
                console.log(oresult);
                //create a new line for each relation
                for (let i in oresult) {

                    lineNumber++;
                    let lineID = 'line' + lineNumber;
                    rectNumber++;
                    let rectID = 'rect' + rectNumber;
                    textNumber++;
                    let textID = 'text' + textNumber;

                    $.post(
                        "../Interface/Connector.php",
                        {
                            function: "getPositionRelationship",
                            id: sRelationshipID,
                        },
                        function (result) {
                            console.log(sRelationshipID + " resultX: " + result.X + " resultY: " + result.Y);
                            //adjust position from left upper corner of the element to the middle
                            let posX1 = result.X + 20 + 28;
                            let posY1 = result.Y + 20 + 20;

                            console.log(sRelationshipID + " posX1: " + posX1 + " posY1: " + posY1);

                            let line = document.getElementById("line");
                            let lineClone = line.cloneNode();

                            lineClone.setAttribute('id', lineID)
                            //set position of the beginning of the line
                            lineClone.setAttribute('x1', posX1);
                            lineClone.setAttribute('y1', posY1);
                            lineClone.removeAttribute('style');

                            document.getElementById("svg1").appendChild(lineClone);
                            console.log(lineClone);


                            $.post(
                                "../Interface/Connector.php",
                                {
                                    function: "getPositionEntity",
                                    id: oresult[i].id,
                                },
                                function (result) {
                                    console.log(oresult[i].id + " resultX: " + result.X + " resultY: " + result.Y);
                                    //adjust position from left upper corner of the element to the middle
                                    let posX2 = result.X + 20 + 40;
                                    let posY2 = result.Y + 20 + 20;
                                    console.log(oresult[i].id + " posX2: " + posX2 + " posY2: " + posY2);

                                    let lineClone = document.getElementById(lineID);

                                    //set position of the end of the line
                                    lineClone.setAttribute('x2', posX2);
                                    lineClone.setAttribute('y2', posY2);
                                    lineClone.setAttribute('class', oresult[i].id + " " + sRelationshipID);

                                    console.log(lineClone);

                                    let textPosX = 0;
                                    let textPosY = 0;
                                    let rectPosX = 0;
                                    let rectPosY = 0;

                                    if(posX1<posX2){
                                        textPosX = (posX1 + posX2) / 2;
                                        rectPosX = textPosX - 25;
                                    }else if (posX1>posX2){
                                        textPosX = (posX2 + posX1) / 2;
                                        rectPosX = textPosX - 25;
                                    }

                                    if (posY1<posY2){
                                        textPosY = (posY1 + posY2) / 2;
                                        rectPosY = textPosY - 15;
                                    }else if (posY1>posY2){
                                        textPosY = (posY1 + posY2) / 2;
                                        rectPosY = textPosY - 15;
                                    }


                                    let rect = document.getElementById("rect");
                                    let rectClone = rect.cloneNode();
                                    rectClone.setAttribute('id', rectID)
                                    rectClone.setAttribute('x', rectPosX);
                                    rectClone.setAttribute('y', rectPosY);
                                    rectClone.removeAttribute('style');
                                    document.getElementById("svg1").appendChild(rectClone);
                                    console.log(rectClone);

                                    let text = document.getElementById("text");
                                    let textClone = text.cloneNode();
                                    textClone.setAttribute('id', textID)
                                    textClone.setAttribute('x', textPosX);
                                    textClone.setAttribute('y', textPosY);
                                    textClone.removeAttribute('style');
                                    textClone.innerHTML = oresult[i].notation;
                                    document.getElementById("svg1").appendChild(textClone);
                                    console.log(textClone);

                                }, "json"
                            );
                        }, "json"
                    );




                }

            });

    }

    //update position of all lines attached to an element which is moved to a new position
    static updateLines(elementID){

        if (elementID.includes("entity")){

            $.post(
                "../Interface/Connector.php",
                {
                    function: "getPositionEntity",
                    id: elementID,
                },
                function (result) {
                    let posX = result.X + 20 + 40;
                    let posY = result.Y + 20 + 20;

                    let lines = document.getElementsByClassName(elementID);
                    console.log(lines);

                    for(let line of lines){
                        line.setAttribute('x2', posX);
                        line.setAttribute('y2', posY);
                        console.log(line);
                    }

                }, "json"
            );

        }else if(elementID.includes("relationship")){

            $.post(
                "../Interface/Connector.php",
                {
                    function: "getPositionRelationship",
                    id: elementID,
                },
                function (result) {
                    let posX = result.X + 20 + 50;
                    let posY = result.Y + 20 + 20;

                    let lines = document.getElementsByClassName(elementID);
                    console.log(lines);

                    for(let line of lines){
                        line.setAttribute('x1', posX);
                        line.setAttribute('y1', posY);
                        console.log(line);
                    }

                }, "json"
            );
        }

    }


    static checkEntityName(EntityName){
        let oEntities = document.getElementsByClassName("entity");
        let j =0;
        for (let i in oEntities){
            if (oEntities[i].innerHTML === EntityName){
                j++;
            }
        }
        if (j>1){
            alert("der Name ist bereits vergeben!");
            return false;
        }else {
            return true; 
        }
    }

    static pushGeneralisation (idGeneralisation, arrayGeneralisation){
        $.post(
            "../Interface/Connector.php",
            {
                function: "updateGeneralisation",
                id: idGeneralisation,
                array: arrayGeneralisation
            },
            function(result){

            }
        );
    }

}