const moves = JSON.parse(document.getElementById("moves").value)
const alliance = document.getElementById("alliance").value

let selectedMode = document.getElementById("combined")
selectedMode.classList.add("selected-mode")

drawField()

function selectMode(element){
    selectedMode.classList.remove("selected-mode")
    selectedMode = element
    selectedMode.classList.add("selected-mode")
    clearField()
    drawField(selectedMode.id)
}

function clearField(){
    Array.prototype.forEach.call(document.getElementsByClassName("junction"), function(junction){
        junction.dataset.cones = "0"
        junction.innerHTML = ""
    })

    Array.prototype.forEach.call(document.getElementsByClassName("terminal"), function(terminal){
        terminal.dataset.cones = "0"
        terminal.innerHTML = ""
    })
}

function drawField(mode="combined"){
    moves.forEach(move=>{

        if (move.coneType === "miss"){
            return
        }
        if (mode==="autonomous" && parseFloat(move.timestamp) > 10){
            return
        }

        if (mode === "manual" && parseFloat(move.timestamp) < 10){
            return
        }
    
        junction = document.getElementById(move.location)
        junction.dataset.cones = (parseInt(junction.dataset.cones)+1).toString()
    
        if (move.coneType === "beacon"){
            junction.classList.add("beacon")
        }
        
    })
    
    Array.prototype.forEach.call(document.getElementsByClassName("junction"), function(junction){
    
        if (junction.classList.contains("beacon")){
            circle = document.createElement("div")
            circle.classList.add("beacon-circle")
            circle.classList.add(alliance)
    
            numCones = document.createElement("div")
            numCones.innerHTML = junction.dataset.cones
            circle.appendChild(numCones)
    
            junction.appendChild(circle)
        }
        else if (junction.dataset.cones != "0"){
            
            circle = document.createElement("div")
            circle.classList.add("cone-circle")
            circle.classList.add(alliance)
    
            numCones = document.createElement("div")
            numCones.innerHTML = junction.dataset.cones
            circle.appendChild(numCones)
    
            junction.appendChild(circle)
        }
    })
    
    Array.prototype.forEach.call(document.getElementsByClassName("terminal"), function(terminal){
        if (terminal.dataset.cones != "0"){
            filled = document.createElement("div")
    
            filled.classList.add(alliance + "-terminal-filled")
            
            numCones = document.createElement("div")
            numCones.innerHTML = terminal.dataset.cones
            filled.appendChild(numCones)
    
            terminal.appendChild(filled)
        }
    })
}