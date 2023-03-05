@extends("layouts.sidebar")

@section("head")
<link href = "/css/sync.css" rel = "stylesheet">
<script src = "/js/sync.js" defer></script>
<script src = {{ asset("jquery.js") }}></script>


@endsection


@section("content")



<div id = "all">
    <div id = "status-container">
        <h1>Server Status:</h1>
        <h1 id = "good"></h1>
        <h1 id = "bad">Offline</h1>
    </div>

    <button id = "sync-button" onclick = "syncData()">Sync Data</button>
    
    <div id = "console"></div>

    <form id = "secret" style = "display:none" action = "/sync", method = "POST">
        @csrf <!-- {{ csrf_field() }} -->
    </form>
    
</div>

<div id = "hidden">
    <input type = "hidden" value = {{ json_encode($views) }} id = "views">
</div>
@endsection
