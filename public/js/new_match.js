
var selectedColor

window.addEventListener("DOMContentLoaded", function() {
    selectedColor = document.getElementById("blue")
}, false);

function clicked(element){
    selectedColor.classList.remove("selected")

    selectedColor = element

    selectedColor.classList.add("selected")


}

function beginScout(){

    let arr = []
    
    arr.push(document.getElementById("pov_entry").value)
    arr.push(document.getElementById("t2").value)
    arr.push(document.getElementById("t3").value)
    arr.push(document.getElementById("t4").value)

    arr = arr.sort(function (a, b){return parseInt(a)-parseInt(b)})

    let form = document.getElementById("hidden");

    let pov = document.createElement("input");
    pov.type = "hidden";
    pov.name = "pov";
    pov.value = document.getElementById("pov_entry").value;

    let alliance = document.createElement("input")
    alliance.type = "hidden"
    alliance.name = "alliance"
    alliance.value = selectedColor.value

    let teams = document.createElement("input");
    teams.type = "hidden";
    teams.name = "teams";
    teams.value = arr[0] + "," + arr[1] + "," + arr[2] + "," + arr[3]


    form.appendChild(pov);
    form.appendChild(alliance)
    form.appendChild(teams);
    

    form.submit();
}