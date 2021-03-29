<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create four equal columns that floats next to each other */
        .column {
            float: left;
            width: 25%;
            padding: 10px;

        }
        .column2 {
            float: left;



        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table{
            margin-bottom: 20px;
        }

        .button {
            background-color gray;
            color: black;
            padding: 5px;
            margin: 4px 2px;
            border-radius: 12px;
            text-align center;
            height:80px;
            width:140px;
            margin: 2px;

        }
        .hr {
            border: 1px solid black;
            border-radius: 2px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .button2 {
            background-color blue;
            color: white;
            padding: 5px;
            margin: 4px 2px;
            border-radius: 12px;
            text-align center;
            height:60px;
            width:100px;
            margin: 2px;

        }
    </style>
</head>
<body>


<h2>Four Equal Columns</h2>

<div class="row">
    <div class="column" style="background-color:#aaa;">
        <h2>Column 1</h2>
        <p>Some text..</p>
    </div>
    <div class="column" style="background-color:#bbb;">
        <h2>Column 2</h2>
        <p>Some text..</p>
    </div>
    <div class="column" style="background-color:#ccc;">
        <h2>Column 3</h2>
        <p>Some text..</p>
    </div>
    <div class="column" style="background-color:#ddd;">
        <h3>Entity bearbeiten:</h3>
        <table style="width:100%">
            <tr>
                <th colspan="2">
                    <input placeholder="Entity name" type="text" id="idEntityName" name="idEntityName">
                </th>

                <th>PK</th>
            </tr>
            <tr>
                <td>X</td>
                <td>Id</td>
                <td>X</td>
            </tr>
            <tr>
                <td>X</td>
                <td>{Raum}</td>
                <td>X</td>
            </tr>
            <tr>
                <td>X</td>
                <td>Adresse(Straße,PLZ)</td>
                <td>X</td>
            </tr>
        </table>

        <hr class="hr">

        <button class="button">Einfaches<br>Attribut<br>hinzufügen</button>
        <button class="button">Mehrwertiges<br>Attribut<br>hinzufügen</button>
        <button class="button">Zusammengesetztes<br>Attribut<br>hinzufügen</button>

        <hr class="hr">

        <h4>Einfaches Attribut hinzufügen</h4>
        <div class="row">
            <div class="column" style="width: 30%;">
                <button class="button2">Attribut<br>hinzufügen</button>
            </div>
            <div class="column2" style="width: auto;">
                <h2>Column 2</h2>
                <p>Some text..</p>
            </div>
        </div>
</div>

</body>
</html>
