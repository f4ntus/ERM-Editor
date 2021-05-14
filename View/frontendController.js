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
            let aAttributes = oresult.attributes;
            //console.log(oresult.attributes);
            for (let attribute in aAttributes){
                let row = oAttributeTable.insertRow(-1);
                let cell1 = row.insertCell(0);
                let cell2 = row.insertCell(1);
                let cell3 = row.insertCell(2);
                cell1.innerHTML = attribute.typ;
                cell2.innerHTML = "<button onclick=\"onClickDeleteAttribute(this, \'idTableRelationshipAttributes\')\">X</button>";
                cell3.innerHTML = attribute.name;
                console.log(attribute);
            }
            //console.log(result);
        }
    }
}