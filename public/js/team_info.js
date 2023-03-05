
const views = JSON.parse(document.getElementById("views").value)
let totalCones = 0
let mostCones = 0


//*Add the numCones to each junction, finds total cones
views.forEach(function(view){
    for (const [key, move] of Object.entries(JSON.parse(view.moves))){
        if (move.coneType != "miss"){
            totalCones++

            //*Add to num_cones data property
            document.getElementById(move.location).dataset.cones = (parseInt(document.getElementById(move.location).dataset.cones)+1).toString()
        }
    }
})



if(totalCones>0){



    //*Finds max number of cones
    Array.prototype.forEach.call(document.getElementsByClassName("junction"), function(junction){
        if (parseInt(junction.dataset.cones) > mostCones){
            mostCones = junction.dataset.cones
        }
    })


    //*Assigns Draws circles and assigns color values
    Array.prototype.forEach.call(document.getElementsByClassName("junction"), function(junction){
        let numCones = parseInt(junction.dataset.cones)
        if (numCones>0){
            let percent = Math.round((numCones/totalCones)*100)

            circle = document.createElement("div")
            circle.classList.add("junction-cones")
            circle.innerHTML = percent.toString() + "%"

            //*assign shade
            let increment = 255/mostCones
            circle.style.backgroundColor = "rgb(255, " + (255-Math.round(increment*numCones)) + ", "+(255-Math.round(increment*numCones))+")"
            junction.appendChild(circle)
        }
    })

    Array.prototype.forEach.call(document.getElementsByClassName("terminal"), function(terminal){
        let numCones = parseInt(terminal.dataset.cones)
        if (numCones>0){
            let percent = Math.round((numCones/totalCones)*100)

            box = document.createElement("div")
            box.classList.add("terminal-cones")
            box.innerHTML = percent.toString() + "%"

            //*assign shade
            let increment = 255/mostCones
            box.style.backgroundColor = "rgb(255, " + (255-Math.round(increment*numCones)) + ", "+(255-Math.round(increment*numCones))+")"
            terminal.appendChild(box)

        }
    })
    
}

