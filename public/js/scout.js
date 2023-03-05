//TODO: Rotate view
const circle = document.getElementById("circle");
const central = document.getElementById("central");
const field = document.getElementById("field");
const mode = document.getElementById("mode");

const padding = parseInt(getComputedStyle(document.getElementById("field")).padding);

const smallSize = 15 / 600;
const mediumSize = 18 / 600;
const largeSize = 20 / 600;

const startMode = 0
const autonomousMode = 1
const waitMode = 2
const manualMode = 3
const endMode = 4 

const waitingMode = 0
const playingMode = 1

let time = Date.now()
let moves = []
let heights = [0, 0, 0, 0, 0, 0] //* terminal, ground, low, mid, high,, miss
let numRotations = 0

const modes = [
    {
        name: "start", display: "Press to Start", duration: 0, update: () => { document.getElementById("time").innerHTML = currentMode.display }
    },


    {
        name: "autonomous", display: "Autonomous", duration: 10, update: () => { //*Duration 30s
            document.getElementById("time").innerHTML = currentMode.display + " - " + ((Date.now() - time) / 1000).toFixed(1);
            if ((Date.now() - time) / 1000 > currentMode.duration) { nextMode() }

        }
    },


    { name: "wait", display: "Begin Manual", duration: 0, update: () => { document.getElementById("time").innerHTML = currentMode.display } },


    {
        name: "manual", display: "Manual", duration: 10, update: () => {//*Duration 120s
            document.getElementById("time").innerHTML = currentMode.display + " - " + ((Date.now() - time) / 1000).toFixed(1);
            if ((Date.now() - time) / 1000 > currentMode.duration) { nextMode(); }
        }
    },


    { name: "end", display: "Finish Scout", duration: 0, update: () => { document.getElementById("time").innerHTML = currentMode.display } }
]

let currentMode = modes[0]

function getMode() { return modes.indexOf(currentMode) }
function nextMode() { currentMode = modes[getMode() + 1] }

//*Button logic
var selectedConeType = document.getElementById("cone")

function buttonPress(element) {
    if (selectedConeType === null){
        selectedConeType = element
        element.classList.add("selected")
    }
    else{
        selectedConeType.classList.remove("selected");
        selectedConeType = element;
        selectedConeType.classList.add("selected");
    }
    
}

function rotateButton(){
    let f = document.getElementById("field")
    let c = document.getElementById("central")
    
    numRotations++
    numRotations = numRotations%4
    f.style.transform = ("rotate(" + (90*numRotations) + "deg)")
}


//*ImageMap
document.getElementById("screen").onclick = function (e) {
    if (circle.classList.contains("animation-lock")) return;
    if (getMode() % 2 == waitingMode) return;

    let biggerSide = (central.offsetHeight > central.offsetWidth) ? central.offsetHeight : central.offsetWidth;
    let smallerSide = (central.offsetHeight > central.offsetWidth) ? central.offsetWidth : central.offsetHeight;


    let fieldSize = smallerSide - (padding * 2);
    let fieldOffset = (biggerSide - fieldSize) / 2

    let clickX = (central.offsetWidth == biggerSide) ? e.clientX - fieldOffset : e.clientX - padding
    let clickY = (central.offsetWidth == biggerSide) ? e.clientY - padding - mode.offsetHeight : e.clientY - fieldOffset - mode.offsetHeight



    //* Checks if the mouse click is in one of the top corners
    let isTopTerminal = (clickY < 20) ? true : false
    let isLeftTerminal = (clickX < 20) ? true : false
    let isRightTerminal = ((clickX - fieldSize) > -20) ? true : false
    let isBottomTerminal = ((clickY - fieldSize) > -20) ? true : false

    if ((isLeftTerminal != false || isRightTerminal != false) && (isTopTerminal != false || isBottomTerminal != false)) {
        let xSide = (isLeftTerminal != false) ? 0 : fieldSize
        let ySide = (isTopTerminal != false) ? 0 : fieldSize

        let topOffset = (central.offsetWidth == biggerSide) ? padding + ySide : fieldOffset + ySide
        let leftOffset = (central.offsetWidth == biggerSide) ? fieldOffset + xSide : padding + xSide

        animateCircle(topOffset, leftOffset)

        let timeDelay = (getMode() == manualMode) ? modes[1].duration : 0
        xCoordinate = isLeftTerminal ? 0 : 6
        yCoordinate = isTopTerminal ? 0 : 6
        moves.push(new Action(selectedConeType.value, getRotatedCoordinate(xCoordinate, yCoordinate), "terminal", (((Date.now() - time) / 1000) + timeDelay).toFixed(2)));

        incrementConesDisplay("terminal")
        return
    }

    for (let y = 1; y <= 5; y++) {
        for (let x = 1; x <= 5; x++) {

            //* Returns if user did not click on a junction
            if (!(clickY > ((y / 6) * fieldSize) - 20 && clickY < ((y / 6) * fieldSize) + 20 && clickX > ((x / 6) * fieldSize) - 20 && clickX < ((x / 6) * fieldSize) + 20)) {
                continue 
            }

            //*Animate circle
            let topOffset = (central.offsetWidth == biggerSide) ? padding + (fieldSize * y) / 6 - (circle.clientHeight / 2) : topOffset = fieldOffset + ((fieldSize * y) / 6) - 2
            let leftOffset = (central.offsetWidth == biggerSide) ? fieldOffset + (fieldSize * x) / 6 - (circle.clientWidth / 2) : padding + ((fieldSize * x) / 6) - 2

            animateCircle(topOffset, leftOffset)

            //*Deal with data
            let height = getHeight(x, y)

            let timeDelay = (getMode() == manualMode) ? modes[1].duration : 0

            moves.push(new Action(selectedConeType.value, getRotatedCoordinate(x, y), height, (((Date.now() - time) / 1000) + timeDelay).toFixed(2)));

            incrementConesDisplay(height)

        }
    }
    }

function animateCircle(topOffset, leftOffset) {

    circle.style.top = topOffset + "px"
    circle.style.left = leftOffset + "px"

    circle.classList.add("cone-pressed");
    circle.classList.add("animation-lock")
    circle.addEventListener("transitionend", () => circle.classList.remove("cone-pressed"));
    setTimeout(() => {
        circle.style.backgroundColor = "#2eb555";
        circle.style.top = "0px";
        circle.style.left = "0px";

        circle.style.display = "none";
        circle.classList.remove("animation-lock")
    }, 1000);

    circle.style.display = "block";
}

function getHeight(x, y) {
    let height
    if (y == 1 || y == 5) {
        if (x == 2 || x == 4) {
            height = "low"
        }

        if (x == 1 || x == 3 || x == 5) {
            height = "ground"
        }


    }
    if (y == 2 || y == 4) {
        if (x == 3) {
            height = "high"
        }
        if (x == 2 || x == 4) {
            height = "mid"
        }
        if (x == 1 || x == 5) {
            height = "low"
        }
    }
    if (y == 3) {
        if (x == 1 || x == 3 || x == 5) {
            height = "ground"
        }
        if (x == 2 || x == 4) {
            height = "high"
        }
    }
    return height
}

function getRotatedCoordinate(x, y){
    newCoords = [x-3, 3-y]
    for (let rotations = 0; rotations<numRotations; rotations++){ 
        //* This is equivalent to multiplying by i
        let temp = newCoords[0]
        newCoords[0] = newCoords[1]* -1
        newCoords[1] = temp 
    }
    return "" + (newCoords[0]+3) + ((newCoords[1]*-1)+3)
}

function incrementConesDisplay(height){
    if (selectedConeType.value == "miss"){
        heights[5]++
        updateConesDisplay()
        return
    }
    switch (height) {
        case "terminal":
            heights[0]++
            break
        case "ground":
            heights[1]++
            break

        case "low":
            heights[2]++
            break

        case "mid":
            heights[3]++
            break

        case "high":
            heights[4]++
            break
    }
    updateConesDisplay()
}

function undo() {
    if (moves.length == 0) {return}

    let move = moves.pop()

    if (move.coneType == "miss") {
        heights[4]--
        updateConesDisplay()
        return
    }

    let h = move.height
    switch (h) {
        case "terminal":
            heights[0]--
            break
        case "ground":
            heights[1]--
            break

        case "low":
            heights[2]--
            break

        case "mid":
            heights[3]--
            break

        case "high":
            heights[4]--
            break

        default:
            alert("If you're seeing this, something terrible has gone wrong.")
    }
    updateConesDisplay()

}

function updateConesDisplay() {
    document.getElementById("terminal").innerHTML = heights[0]
    document.getElementById("ground").innerHTML = heights[1]
    document.getElementById("low").innerHTML = heights[2]
    document.getElementById("mid").innerHTML = heights[3]
    document.getElementById("high").innerHTML = heights[4]
    document.getElementById("misses").innerHTML = heights[5]

}

//*Updates time
setInterval(updateTime, 50);
function updateTime() {
    currentMode.update();
}

document.getElementById("mode").addEventListener("click", function () {
    console.log(getMode())
    if (getMode() == endMode) {
        submitData();
    }
    if (getMode() == startMode || getMode() == waitMode) {
        time = Date.now();
        nextMode();
        return;
    }
})

//* allow hotkeying coneTypes
document.onkeyup = function (e) {
    let hotkey
    switch (e.key) {
        case "m":
            hotkey = "miss"
            break
        case "c":
            hotkey = "cone"
            break
        case "b":
            hotkey = "beacon"
            break
        case "u":
            undo()
            return
    }
    if (selectedConeType === null){
        selectedConeType = document.getElementById(hotkey)
        selectedConeType.classList.add("selected")
    }
    else{
        selectedConeType.classList.remove("selected");
        selectedConeType = document.getElementById(hotkey);
        selectedConeType.classList.add("selected");
    }
    

}

//* Submit data to database

function submitData() {
    let form, actions

    form = document.getElementById("form");

    actions = document.createElement("input");
    actions.type = "hidden";
    actions.name = "actions";
    actions.value = JSON.stringify(moves);

    form.appendChild(actions);

    form.submit();
}

class Action {
    constructor(coneType, location, coneHeight, timestamp,) {
        this.coneType = coneType;
        this.location = location;
        this.height = coneHeight
        this.timestamp = timestamp;
    }
}
//@
//!
//todo
//*
//&