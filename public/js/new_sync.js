const views = JSON.parse(document.getElementById("views").value)

window.onload = function(){
    $.ajax({
        type: "POST",
        url: "http://34.125.191.138/",
        data: {"aim": "ping"},
        crossDomain: true,
        success: function(data){
            realData = JSON.parse(data)
            if (realData.response === "success"){
                document.getElementById("good").innerHTML = "Online";
                document.getElementById("bad").innerHTML = "";
            }
        }

    })
}

var newPackets = []
let finished = false;

function syncData(){
    //*For the second time around, when merging with local db
    if (finished){
        let queues = document.createElement("input")
        queues.name = "queues"
        queues.value = JSON.stringify(newPackets)
        document.getElementById("secret").appendChild(queues)

        //localStorage.setItem("last_update", Date.now())

        document.getElementById("secret").submit()
        return
    }

    
    let numViews = views.length
    let currentView = 0;
    showConsole("Uploading " + numViews + " views")
    //*Send over views
    while (currentView<numViews){
        $.ajax({
            type: "POST",
            url: "http://34.125.191.138",
            data: {"aim": "push", "packet": JSON.stringify(views[currentView])},
            async: false,
            success: function(data){
                showConsole(data)
            },
            error: function(e){
                showConsole(e, error=true)
            }
        })
        currentView++
        return
    }

}

function showConsole(message, error = false){
    p = document.createElement("p");
    p.innerHTML = message;
    if (error) p.style.color = "#ff4530"
    document.getElementById("console").append(p)
}