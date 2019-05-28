<form id="playlistForm">
    <div class="form-group">
        <h1>Create playlist</h1>
        <div class="form-group">
            <label for="formPlaylistName">Playlist name</label>
            <input class="form-control" id="formPlaylistName" placeholder="Enter playlist name">
        </div>    
        <div class="form-group">
            <label for="formPlaylistRating">Select rating</label>
            <select class="form-control" id="formPlaylistRating">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label>Playlist image</label>
            <input class="form-control" id="formPlaylistImage" aria-describedby="playlistImageHelp" placeholder="">
            <small id="playlistImageHelp" class="form-text text-muted">Optional URL to an image</small>
        </div>  
    </div>
    <button type="button" class="btn btn-primary" onclick="sendPlaylistForm()">Submit</button>
</form>