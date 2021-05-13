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
            }
        );
    }
}