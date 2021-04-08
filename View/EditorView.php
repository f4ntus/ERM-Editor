<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script language="javascript" type="text/javascript" src="frontendScript.js"></script>
    <title>ERM-Editor</title>
</head>
<body>
<div class="grid-container">
    <div class="headline">
        <ul>
            <li><a href="about.asp">Impressum</a></li>
            <li><a href="contact.asp">Anleitung</a></li>
            <li><a href="news.asp">Laden</a></li>
            <li><a href="default.asp">Speichern</a></li>
        </ul>
    </div>
    <div class="leftMenue">
        <div class="menuGroup">
            <p>Formen</p>
            <button class="shape" id="entity"></button>
            <button class="shape" id="relationship"></button>
            <button class="shape" id="isA"></button>
        </div>
        <div class="menuGroup">
            <from action="">
                <p>Kardinalitätsrestriktionen</p>
                <input type="radio" id="oneNm" name="cardinality" value="oneNm">
                <label for="oneNm">1, n, m</label><br>
                <input type="radio" id="minMax" name="cardinality" value="minMax">
                <label for="minMax">min, max</label><br>
                <input type="submit" value="Aktualisieren">
            </from>
        </div>
        <div class="menuGroup">
            <div class="dropdown">
                <button class="dropbtn">Generalisierung</button>
                <div class="dropdown-content">
                    <a href="#" onclick="generalizationMode('Hausklassenmodell')">Hausklassenmodell</a>
                    <a href="#" onclick="generalizationMode('Partionierungs-Modell')">Partionierungs-Modell</a>
                    <a href="#" onclick="generalizationMode('Volle Redundanz')">Volle Redundanz</a>
                    <a href="#" onclick="generalizationMode('Überrelation')">Überrelation</a>
                </div>
            </div>
            <p id="showGeneralizationMode"></p>
            <button>ERM umwandeln</button>
        </div>
    </div>
    <div class="editor">Three</div>
    <div class="rightMenue">
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

        <button onclick="onClickButtonAddSimpleAttribute()" class="button">Einfaches<br>Attribut<br>hinzufügen</button>
        <button onclick="onClickButtonAddMultiValueAttribute()" class="button">Mehrwertiges<br>Attribut<br>hinzufügen</button>
        <button onclick="onClickButtonAddCompoundAttribute()" class="button">Zusammengesetztes<br>Attribut<br>hinzufügen</button>

        <hr class="hr">

        <div class="row" id="idDivAddAttribute">

            <h4>Zusammengesetztes Attribut Attribut hinzufügen:</h4>
            <div class="column" style="width: 30%;">
                <button id="idCompoundAttributeToTable" class="button2">Zusammengesetztes<br>Attribut<br>hinzufügen</button>
            </div>

            <div class="column2" style="width: 65%;">
                <table id="idTableCompoundAttribute" style="width:70%">
                    <tr>
                        <th style="text-align: center;">Oberattribut</th>
                        <th><input placeholder="" type="text" id="idUpperAttributeName"
                               name="idUpperAttributeName"/>
                        </th>
                    </tr>
                    <tr>
                        <td>Unterattribut</td>
                        <td>
                            <input placeholder="" type="text" id="idSubValueAttribute1" name="idSubValueAttribute1"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Unterattribut</td>
                        <td>
                            <input placeholder="" type="text" id="idSubValueAttribute2" name="idSubValueAttribute2"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">
                            <button onclick="onClickAddSubAttributeRow()" class="buttonPlus">&#43;</button>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <hr class="hr">
        <button style="margin:0 auto; display:block; margin-bottom: 1%; background: blue; color: white;" class="button">Fertigstellen</button>
    </div>
    <div class="outputBelow">Five</div>
</div>
</body>
</html>