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
        <button onclick="onClickButtonAddMultiValueAttribute()" class="button">Mehrwertiges<br>Attribut<br>hinzufügen
        </button>
        <button onclick="onClickButtonAddCompoundAttribute()" class="button">Zusammengesetztes<br>Attribut<br>hinzufügen
        </button>

        <hr class="hr">

        <div class="row" id="idDivAddAttribute">

        </div>
    </div>
    <div class="outputBelow">
        <h1> Relationship bearbeiten</h1>
        <table>
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
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownEntityText01">Entity</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" id="entityContent">
                            <a href="#" onclick="selectEntityDropdown('Gebäude','01')">Gebäude</a>
                            <a href="#" onclick="selectEntityDropdown('Raum','01')">Raum</a>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownNotationText01">n</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" id="entityContent">
                            <a href="#" onclick="selectNotationDropdown('1','01')">1</a>
                            <a href="#" onclick="selectNotationDropdown('n','01')">n</a>
                            <a href="#" onclick="selectNotationDropdown('m','01')">m</a>
                        </div>
                    </div>
                </td>
                <td> <input type="checkbox" name="weakEntity01"></td>
            </tr>
            <!-- Second row -->
            <tr>
                <td>2</td>
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownEntityText02">Entity</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" id="entityContent">
                            <a href="#" onclick="selectEntityDropdown('Gebäude','02')">Gebäude</a>
                            <a href="#" onclick="selectEntityDropdown('Raum','02')">Raum</a>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <p class="dorpdowntext" id="dropdownNotationText02">n</p>
                        <button class="dropbtnArrow"></button>
                        <div class="dropdown-content" id="entityContent">
                            <a href="#" onclick="selectNotationDropdown('1','02')">1</a>
                            <a href="#" onclick="selectNotationDropdown('n','02')">n</a>
                            <a href="#" onclick="selectNotationDropdown('m','02')">m</a>
                        </div>
                    </div>
                </td>
                <td> <input type="checkbox" name="weakEntity01"></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>