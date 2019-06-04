<form id="songForm">
    <div class="form-group">
        <h1>Add song</h1>
        <div class="form-group">
            <label for="formSongYoutubeCode">YouTube identifier code</label>
            <input class="form-control" id="formSongYoutubeCode" aria-describedby="formSongYoutubeCodeHelp" placeholder="VPRjCeoBqrI">
            <small id="formSongYoutubeCodeHelp" class="form-text text-muted">Example: https://www.youtube.com/watch?v=VPRjCeoBqrI => VPRjCeoBqrI</small>
        </div>  
        <div class="form-group">
            <label for="formSelectPlaylist">Save to playlist</label>
            <select class="form-control" id="formSelectPlaylist">
            @foreach ($playlists as $playlist)
                <option>{{ $playlist->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="formSongRating">Select rating</label>
            <select class="form-control" id="formSongRating">
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <p id="formSongStatus" class="statusForm">Unknown</p>
        </div> 
    </div>
    <button type="button" class="btn btn-primary" onclick="sendSongForm()">Submit</button>
</form>
