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
        }
    }
    static pushRelationship (){
        // Informations about the Relationship
        let sRelationshipID = document.getElementById("pRelationshipID").innerHTML;
        let oRelationship = document.getElementById(sRelationshipID);
        let sXaxis = oRelationship.style.left;
        let sYaxis = oRelationship.style.top;
        let sRelationshipName = oRelationship.innerHTML;

        // Informations about the Attributes
        let oTable = document.getElementById("idTableRelationshipAttributes");
        let aAttributes = new Array();
        for (let iRow = 0; iRow < oTable.rows.length; iRow ++){
            let sName =  oTable.rows[iRow].getElementsByTagName("td")[2].innerHTML;
            let sType =  oTable.rows[iRow].getElementsByTagName("td")[0].innerHTML;
            if (sType == 1){
                sName = sName.slice(1,-1);
            }
            let aSubattributes = '';
            if (sType == 2){
                let mainName = sName.split('(')[0]; // get the main Name before the open bracket (
                aSubattributes = sName.split('(')[1].split(','); // splice the subattributes into an Array
                aSubattributes[aSubattributes.length-1] = aSubattributes[aSubattributes.length-1].slice(0,-1); // remove the last bracket )
                sName = mainName;
            }
            aAttributes[iRow] = {
                name: sName,
                typ: sType,
                primary: 'false',
                subattributes: aSubattributes
            }
        }
        console.log(aAttributes);

        // pushing the data to backend
        $.post(
            "../Interface/Connector.php",
            {
                function: "updateRelationship",
                id: sRelationshipID,
                name: sRelationshipName,
                xaxis: sXaxis,
                yaxis: sYaxis,
                attributes: aAttributes
            },
            function(result){
                console.log(result);
            }
        );
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
                alert(result);
            }
        );
    }
}