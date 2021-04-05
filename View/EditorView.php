<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
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
                        <a href="#">Hausklassenmodell</a>
                        <a href="#">Partionierungs-Modell</a>
                        <a href="#">Volle Redundanz</a>
                        <a href="#">Überrelation</a>
                    </div>
                </div>
                <button>ERM umwandeln</button>
            </div>
        </div>
        <div class="editor">Three</div>
        <div class="rightMenue">Four</div>
        <div class="outputBelow">Five</div>
    </div>
</body>
</html>