const views = JSON.parse(document.getElementById("views").value)
window.onload = function(){
    let test = new WebSocket('ws://172.104.22.21');
    test.addEventListener('open', function(event){
        document.getElementById("good").innerHTML = "Online";
        document.getElementById("bad").innerHTML = "";
        test.send(JSON.stringify({"aim":"test"}))
    })
    setTimeout(()=>(test.close()), 5000)
    if (localStorage.getItem("last_update") == null){
        localStorage.setItem("last_update", 0)
    }

    
}

var newPackets = [];
let finished = false;


function syncData(){
    if(finished){
        let queues = document.createElement("input")
        queues.name = "queues"
        queues.value = JSON.stringify(newPackets)
        document.getElementById("secret").append(queues)

        localStorage.setItem("last_update", Date.now())

        document.getElementById("secret").submit()
        return
    }

    var server = new WebSocket('ws://172.104.22.21')

    showConsole("Uploading " + views.length + " views");

    let numViews = views.length;
    let currentView = 0;

    server.addEventListener("open", function(event){
        server.send(makePacket(views[currentView]))
        currentView++
    })

    server.addEventListener("error", function(event){
        showConsole("Error: " + event)
    })

    server.addEventListener("message", function(event){
        let packet = JSON.parse(JSON.parse(JSON.stringify(event.data)))
        

        if (packet.aim == "continue"){

            if (currentView == numViews){
                showConsole("Pulling data")
                request = {"aim": "pull", "last_update": localStorage.getItem("last_update")}
                server.send(JSON.stringify(request))
            }
            else{
                showConsole("Sending packet" + makePacket(views[currentView]))
                server.send(makePacket(views[currentView]))
                currentView++
                
            }

        }

        if (packet.aim == "pull"){
            showConsole("Pulling " + packet["data"].length + " entries") 

            packet["data"].forEach(element=>{
                
                
                newPackets.push(JSON.stringify(element))
                
                showConsole(JSON.stringify(element))
            })
            
            document.getElementById("sync-button").innerHTML = "Click to Merge"
            finished=true
            showConsole("Done!")
        }
    })


}




function makePacket(view){
    str = JSON.stringify(view)

    packet = {
        "aim" : "push",
        "content": {
            "pov": view.pov,
            "alliance": view.alliance,
            "teams": view.teams,
            "moves": view.moves,
            "created_at": view.created_at,
            "updated_at": view.updated_at
        },
    }
    console.log(JSON.stringify(packet))
    return JSON.stringify(packet);

}


function showConsole(message, error = false){
    p = document.createElement("p");
    p.innerHTML = message;
    if (error) p.style.color = "#ff4530"
    document.getElementById("console").append(p)
}