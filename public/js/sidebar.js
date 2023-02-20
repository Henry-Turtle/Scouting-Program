//TODO: Currently, searching for game ID then using sidebar bugs by going to /search/home, etc
Array.from($(".item")).forEach(element => {
    
    element.addEventListener("click", ()=> window.location.href = element.id)
});

