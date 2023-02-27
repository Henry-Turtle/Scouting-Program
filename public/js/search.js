function getGame(element){
    alert(true)
    window.location.href = "/game_info/" + element.id;
}

function search(){
    let team_id = document.getElementById("team").value
    window.location.href = "/search/" + team_id
}