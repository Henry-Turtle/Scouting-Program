const moves = JSON.parse(document.getElementById("moves").value)
const alliance = document.getElementById("alliance").value
moves.forEach(move=>{
    if (move.coneType === "miss"){
        return
    }

    junction = document.getElementById(move.location)
    junction.dataset.cones = (parseInt(junction.dataset.cones)+1).toString()

    if (move.coneType === "beacon"){
        junction.classList.add("beacon")
    }
    
})

Array.prototype.forEach.call(document.getElementsByClassName("junction"), function(junction){
    console.log(junction.dataset.cones)

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