<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" href = {{ asset("css/app.css") }}>
        <link rel = "stylesheet" href = {{ asset("css/scout.css") }}>
        <script src = {{ asset("jquery.js") }}></script>
        <script src = {{ asset("js/scout.js") }} defer></script>
        <title>GNCE Scouting</title>
    </head>

    <body>
        <div id = "hidden-form" style = "display:none;">
            <form method = "POST" id = "form">
                
                <input type = "hidden" name = "pov" value = {{ app("request")->input("pov") }}>
                <input type = "hidden" name = "teams" value = {{ app("request")->input("teams") }}>
            </form>
        </div>
        <div id = "display">
            <div id = "mode">
                <h1 class = "center" id = "time" style = "z-index: 5">Press to Start</h1>
            </div>
            
            <div id = "central">
                <div id = 'circle' class = '' style = "z-index: 10"></div>
                
                <img draggable = "false" src = "/img/field.svg" id = "field" usemap = "#field">
                <map name = "field" draggable="false" id = "imagemap" width = "400" height = "400">
                    <area shape = "default" href = "#" class = "map-element" onclick = "mapClicked(this)" id = "screen">
                </map>
            </div>
        </div>
            
        


        <div id = "options">
            <h1 id = "options-header">Options</h1>
            <hr>
            <ul id = "cone-selector">
                <br>
                <li>
                    <button class = "cone-option selected" id = "cone" value = "cone" onclick = "buttonPress(this)">Cone</button>
                </li>
                <br>
                <li>
                    <button class = "cone-option" id = "beacon" value = "beacon" onclick="buttonPress(this)">Beacon</button>
                </li>
                <br>
                <li>
                    <button class = "cone-option" id = "miss" value = "miss" onclick="buttonPress(this)">Miss</button>
                </li>
                <br>

                <li> 
                    <button id = "undo" onclick = undo()>Undo</button>
                </li>

                <li>
                    <div id = "cones">
                        Terminal: <p id = "terminal">0</p>
                        <br>
                        Ground: <p id = "ground">0</p>
                        <br>
                        Low: <p id = "low">0</p>
                        <br>
                        Mid: <p id = "mid">0</p>
                        <br>
                        High: <p id = "high">0</p>
                        <br>
                        Misses: <p id = "misses">0</p>

                    </div>
                </li>

                <br>

                <li>
                    <button id = "rotate" onclick = rotateButton() style = "transform: rotate(0deg)">Rotate</button>
                </li>
            </ul>
        </div>


    </body>

</html> 