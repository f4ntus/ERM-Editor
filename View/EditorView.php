<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script language="javascript" type="text/javascript" src="DragAndDropScript.js"></script>
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
            <button class="entity" id="entity" onclick="openEntityMenu()">Entity</button>
            <button class="relationship" id="relationship">Relationship</button>
            <button class="isA" id="isA"></button>
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
    <div class="editor">Three </div>
    <div class="rightMenue">
        <h3>Entity bearbeiten:</h3>
        <table id="idTableEntityAttributes" style="width:100%">
            <tr>
                <th colspan="2">
                    <input placeholder="Entity name" type="text" id="idEntityName" name="idEntityName">
                </th>

                <th>PK</th>
            </tr>
            <tr>
                <td><button onclick="onClickDeleteAttribute(this.value)">X</button></td>
                <td>Id</td>
                <td>
                    <label class="switch">
                        <input id="idCheckboxPrimaryKeyMainTable" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </td>
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
        <button onclick="onClickButtonAddSingleValueAttribute()" class="button">Einfaches<br>Attribut<br>hinzufügen</button>
        <button onclick="onClickButtonAddMultiValueAttribute()" class="button">Mehrwertiges<br>Attribut<br>hinzufügen</button>
        <button onclick="onClickButtonAddCompoundAttribute()" class="button">Zusammengesetztes<br>Attribut<br>hinzufügen</button>
        <hr class="hr">
        <div class="row" style="display:block" id="idDivAddSimpleAttribute">

            <h4>Einfaches Attribut hinzufügen:</h4>
            <div class="column" style="width: 30%;">
                <button onclick="onClickAddSimpleAttributeToTable()" class="button2">Einfaches<br>Attribut<br>hinzufügen</button>
            </div>
            <div class="column2" style="width: 60%; ">
                <table style="">
                    <tr>
                        <th>Attributname</th>
                        <th>PK</th>
                    </tr>
                    <tr>
                        <td><input placeholder="" type="text" id="idSimpleAttributeName" name="idSimpleAttributeName"/></td>
                        <td><input type="checkbox" id="idCheckboxPK" name="idCheckboxPK"/></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="display:none" id="idDivAddMultiValueAttribute">

            <h4>Mehrwertiges Attribut hinzufügen:</h4>
            <div class="column" style="width: 30%;">
                <button onclick="onClickAddMultiValueAttributeToTable()" class="button2">Mehrwertiges<br>Attribut<br>hinzufügen
                </button>
            </div>
            <div class="column2" style="width: 65%;">
                <table id="idAddMultiValueAttributeToTable" style="width:70%">
                    <tr>
                        <th style="text-align: center;">Mehrwertiges Attribut</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">

                                { <input placeholder="" type="text" id="idMultiValueAttributeName"
                                         name="idMultiValueAttributeName"/> }
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="display:none" id="idDivAddCompoundAttribute">
            <h4>Zusammengesetztes Attribut Attribut hinzufügen:</h4>
            <div class="column" style="width: 30%;">
                <button onclick="onClickAddCompoundAttributeToTable()" class="button2">Zusammengesetztes<br>Attribut<br>hinzufügen
                </button>
            </div>
            <div class="column2" style="width: 65%;">
                <table id="idTableCompoundAttribute" style="width:70%">
                    <tr>
                        <th style="text-align: center;">Oberattribut</th>
                        <th><input placeholder="" type="text" id="idUpperAttributeName" name="idUpperAttributeName"/></th>
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
        <button style="margin:0 auto; display:block; margin-bottom: 1%; background: blue; color: white;" class="button">
            Fertigstellen
        </button>
    </div>
    <div class="outputBelow">
        <h1> Relationship bearbeiten</h1>
        <table id="tblRelationship">
            <tr>
                <th colspan="4">gehört zu</th>
            </tr>
            <tr>
                <td>Beziehungsnummer</td>
                <td>Entity</td>
                <td>Notation</td>
                <td>schwaches Entity?</td>
            </tr>
            <!-- First row -->
            <tr>
                <td>1</td>
                <td id="colRelEntity">
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownEntityText01">Entity</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" >
                            <a href="#" onclick="selectEntityDropdown('Gebäude','01')">Gebäude</a>
                            <a href="#" onclick="selectEntityDropdown('Raum','01')">Raum</a>
                        </div>
                    </div>
                </td>
                <td id="colRelNotation">
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownNotationText01">n</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" id="entityContent">
                            <a href="#" class="selNotDorp01" onclick="selectNotationDropdown('1','01')">1</a>
                            <a href="#" class="selNotDorp02" onclick="selectNotationDropdown('n','01')">n</a>
                            <a href="#" class="selNotDorp03" onclick="selectNotationDropdown('m','01')">m</a>
                        </div>
                    </div>
                </td >
                <td id="colRelWeakEntity"> <input type="checkbox" name="weakEntity01"></td>
            </tr>
            <!-- Second row -->
            <tr>
                <td>2</td>
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownEntityText02">Entity</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content">
                            <a href="#" onclick="selectEntityDropdown('Gebäude','02')">Gebäude</a>
                            <a href="#" onclick="selectEntityDropdown('Raum','02')">Raum</a>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownNotationText02">n</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content">
                            <a href="#" class="selNotDorp01" onclick="selectNotationDropdown('1','02')">1</a>
                            <a href="#" class="selNotDorp02" onclick="selectNotationDropdown('n','02')">n</a>
                            <a href="#" class="selNotDorp03" onclick="selectNotationDropdown('m','02')">m</a>
                        </div>
                    </div>
                </td>
                <td> <input type="checkbox" name="weakEntity01"></td>
            </tr>
        </table>
        <button id="btnAddRelationship" onclick="onClickButtonAddRelationship(3)">Relationship hinzufügen</button>
    </div>
</div>


</body>
</html>