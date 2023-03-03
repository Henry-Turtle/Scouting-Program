const moves = JSON.parse(document.getElementById("moves").value)
const alliance = document.getElementById("alliance").value
moves.forEach(move=>{
    if (move.coneType === "miss"){
        return
    }

    if (move.location.includes("0") || move.location.includes("6")){
        return //!HANDLE THE CASE OF TERMINAL LOCATIONS
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
        circle.innerHTML = junction.dataset.cones
        junction.appendChild(circle)
    }
    else if (junction.dataset.cones != "0"){
        
        circle = document.createElement("div")
        circle.classList.add("cone-circle")
        circle.classList.add(alliance)
        circle.innerHTML = junction.dataset.cones
        junction.appendChild(circle)
    }
})
