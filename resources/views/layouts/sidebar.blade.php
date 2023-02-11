<!DOCTYPE html>

<html>
    <head>
        <link rel = "stylesheet" href = {{ asset("css/app.css") }}>
        <script src = {{ asset("jquery.js") }}></script>
        <script src = "/js/sidebar.js" defer></script>
        
        <link rel = "stylesheet" href = "/css/sidebar.css">
        @yield("head")
    </head>
    <body>
        <div id = "options">
            <div id = "wrapper"><img src = {{ asset("img/logo.png") }}></div>

            <div id = "buttons">
                <div class = "item" id = "home">
                    <img src = {{ asset("icon/home.svg") }} style = "padding: 10px; -webkit-box-sizing: border-box;">
                    <h2>Home</h2>
                </div>
    
                <div class = "item" id = "new_match">
                    <img src = {{ asset("icon/plus.svg") }}>
                    <h2>New Match</h2>
                </div>
    
                <div class = "item" id = "search">
                    <img src = {{ asset("icon/search.svg") }}>
                    <h2>Search</h2>
                </div>

                <div class = "item" id = "sync">
                    <img src = {{ asset("icon/sync.svg") }} style = "padding: 10px; width: 5vw">
                    <h2>Sync</h2>
                </div>


            </div>
            
        </div>
        <div id = "content" style = "width: 80%; overflow: auto;">
        @yield("content")
        </div>
    </body>
</html>
