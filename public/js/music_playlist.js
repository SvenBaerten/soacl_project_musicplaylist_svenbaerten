//
// General code definitions.
//

// Define base url for fetch api calls
var flag_azure = false;
var base_url = '';
if (flag_azure) base_url = "http://laravel-svenbaerten.azurewebsites.net";
else base_url = "http://127.0.0.1:8000";
// base_url = "http://localhost/musicplaylist/public"

//
// Code for handling website navigation and loading html views.
//

/**
 * Get the csrf token (see master.blade for meta tag).
 * 
 * @returns {string} The csrf token.
 */
function getCSRFToken() {
    return document.getElementsByName('csrf-token')[0].getAttribute('content');
}

// Main container in which we load HTML when using hyperlink buttons.
var mainContainer = document.getElementById('container');

// Header hyperlink buttons 
var navPlayMusic = document.getElementById('navPlayMusic');
var navModifyPlaylist = document.getElementById('navModifyPlaylist');
var navModifySong = document.getElementById('navModifySong');
var navUser = document.getElementById('navUser');
var navDocumentation = document.getElementById('navDocumentation');

// Detect click
navPlayMusic.addEventListener("click", loadView_PlayMusic, false);
navModifyPlaylist.addEventListener("click", loadView_PlaylistForm, false);
navModifySong.addEventListener("click", loadView_SongForm, false);
navUser.addEventListener("click", loadView_User, false);

/**
 * Get play music view from Laravel.
 */
function loadView_PlayMusic() {
    var url = base_url + "/playlists";                

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {        
        mainContainer.innerHTML = text;
        loadPlaylistsWithSongs();
    });           
}

/**
 * Get playlist form view from Laravel.
 */
function loadView_PlaylistForm() {
    var url = base_url + "/playlists/create";                

    fetch(url, {
        // credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken(),
        }
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {
        mainContainer.innerHTML = text;
    });          
}

/**
 * Get song form view from Laravel.
 */
function loadView_SongForm() {
    var url = base_url + "/songs/create";   

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {
        mainContainer.innerHTML = text;
    });          
}

/**
 * Get user form view from laravel. 
 */
function loadView_User() {
    var url = base_url + "/user";   

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {
        document.getElementById('container').innerHTML = text;
    });       
}

/**
 * Handle playlist form submit button.
 */
function sendPlaylistForm() {
    var nameField = document.getElementById('formPlaylistName');
    var nameFieldValue = nameField.value;
    var ratingField = document.getElementById('formPlaylistRating');
    var ratingFieldValue = ratingField.value;
    var imageField = document.getElementById('formPlaylistImage');
    var imageFieldValue = imageField.value;

    if (imageFieldValue == "") imageFieldValue = "https://media.tmicdn.com/catalog/product/cache/c687aa7517cf01e65c009f6943c2b1e9/m/u/music-note-temporary-tattoo_2597.jpg";

    if (nameFieldValue == "") {
        nameField.style.backgroundColor = "LightCoral ";
    } else {
        nameField.style.backgroundColor = "lightgreen";
        var url = base_url + "/playlists";               
        var data = {'name': nameFieldValue, 'rating': ratingFieldValue, 'image': imageFieldValue};

        fetch(url, {
            credentials: "same-origin",
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCSRFToken()
            }
        });
    }            
}

/**
 * Handle song form submit button.
 */
function sendSongForm() { 
    var youTubeCodeField = document.getElementById('formSongYoutubeCode');
    var youTubeCodeValue = youTubeCodeField.value;
    var playlistField = document.getElementById('formSelectPlaylist');
    var playlistValue = playlistField.value;
    var ratingField = document.getElementById('formSongRating');
    var ratingFieldValue = ratingField.value;
    
    if (youTubeCodeValue == "") {
        youTubeCodeField.style.backgroundColor = "LightCoral ";
    } else {
        youTubeCodeField.style.backgroundColor = "lightgreen";
        var url = base_url + "/songs";              
        var data = {'youtube_code': youTubeCodeValue, 'playlist_name': playlistValue, 'rating': ratingFieldValue};
        console.log('send song');

        fetch(url, {
            credentials: "same-origin",
            method: 'POST',
            body: JSON.stringify(data),
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCSRFToken()
            }
        });
    }            
}

/**
 * Handle user authorization signup form submit button.
 */
function sendAuthUserSignupForm() {
    var name = document.getElementById('formAuthUserSignupName');
    var nameValue = name.value;
    var email = document.getElementById('formAuthUserSignupEmail');
    var emailValue = email.value;
    var password = document.getElementById('formAuthUserSignupPassword');
    var passwordValue = password.value;
    var passwordConfirmation = document.getElementById('formAuthUserSignupPasswordConfirm');
    var passwordConfirmationValue = passwordConfirmation.value;
    var status = document.getElementById('formAuthUserSignupStatus');

    if (nameValue == '' || emailValue == '' || passwordValue == '' || passwordConfirmationValue == '') {
        status.innerText = 'Fill in all fields!'
        return;
    }
    else if (passwordValue != passwordConfirmationValue) {
        status.innerText = 'Passwords are not equal!'
        return;
    }

    var url = base_url + "/api/auth/signup";
    var data = {'name': nameValue, 'email': emailValue, 'password': passwordValue, 'password_confirmation': passwordConfirmationValue};

    fetch(url, {
        credentials: "same-origin",
        method: 'POST',
        body: JSON.stringify(data),
        headers:{
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        status.innerText = JSON.stringify(json);
    }); 
}

/**
 * Handle user authorization login form submit button.
 */
function sendAuthUserLoginForm() {
    var email = document.getElementById('formAuthUserLoginEmail');
    var emailValue = email.value;
    var password = document.getElementById('formAuthUserLoginPassword');
    var passwordValue = password.value;
    var status = document.getElementById('formAuthUserLoginStatus');

    if (emailValue == '' || passwordValue == '') {
        status.innerText = 'Fill in all fields!'
        return;
    }

    var url = base_url + "/api/auth/login";
    var data = {'email': emailValue, 'password': passwordValue};

    fetch(url, {
        credentials: "same-origin",
        method: 'POST',
        body: JSON.stringify(data),
        headers:{
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        status.innerText = JSON.stringify(json);
    });     
}

/**
 * Handle user authorization logout form submit button.
 */
function sendAuthUserLogoutForm() {
    var token = document.getElementById('formAuthUserLogoutToken');
    var tokenValue = token.value;
    var status = document.getElementById('formAuthUserLogoutStatus');
    
    if (tokenValue == '') {
        status.innerText = 'Token field is empty!';
        return;
    }

    var url = base_url + "/api/auth/logout";

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCSRFToken(),
            'Authorization': 'Bearer ' + tokenValue
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        status.innerText = JSON.stringify(json);
    });           
}


//
// Code to visualize playlists and songs. 
// Code to control the embedded YouTube player.
//

var playlists;  // All playlists
var songs;      // Songs in selected playlist
var YouTubePlayer;  // YouTube video control based on https://tutorialzine.com/2015/08/how-to-control-youtubes-video-player-with-javascript
var currentYouTubeCode; // The video that is loaded.
var isVideoPlaying = false;
var previousSongId; // We need to remember our last selected song for resetting purposes.
var timerInterval; // A periodic timer for refreshing the song tile time.

/**
 * Get playlists with songs.
 */ 
function loadPlaylistsWithSongs() {
    var url = base_url + "/playlists/playlistswithsongs";

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        playlists = json;
        showPlaylists();
    }); 
}

/**
 * Show playlists.
 */
function showPlaylists() {
    var playlistContainer = document.getElementById("playlist_container");
    playlistContainer.innerHTML = '';
    var songContainer = document.getElementById("song_container");
    songContainer.innerHTML = '';

    for (var playlist_nr = 0; playlist_nr < playlists.length; playlist_nr++) {
        var playlist = playlists[playlist_nr];

        var x =
        '<div id="playlist' + playlist_nr.toString() + '" class="card mb-1 text-white bg-dark" onclick="showSongs(' + playlist['id'].toString() + ')">' +
            '<div class="row no-gutters">' +
             
              '<div class="col-md-2" style="border: 1px solid green">' +
                '<img src="' + playlist['image'] + '" class="card-img" style="object-fit: cover; width: 100%;" >' +
              '</div>' +

              '<div class="col-md-10">' +
                '<div class="card-body d-flex justify-content-between">' +
                  '<h6 class="card-title">' + playlist['name'] + '</h6>' +
                  '<button type="button" class="btn btn-danger btn-sm" onclick="deletePlaylist(' +  playlist['id'].toString() + ')"><i class="fa fa-trash"></i></button>' +
                '</div>' +
              '</div>' +

            '</div>' +
        '</div>';

        playlistContainer.innerHTML += x;       
	}
}

/**
 * Show songs.
 * 
 * @param {number} playlistId The id of the selected playlist in playlists.
 */
function showSongs(playlistId) {
    var songContainer = document.getElementById("song_container");

    songs = playlists[playlistId]['songs'];

    songContainer.innerHTML = '';
    var song_tiles = '<div class="card-deck">';

    for (var song_nr = 0; song_nr < songs.length; song_nr++) {
        var song = songs[song_nr];
        var tile = 
            '<div id="songTile'+ song_nr.toString() + '" class="card text-center songTile">' +
                '<img class="card-img-top" src="' + song['spotify_album_cover'] + '"/>' +

                '<div class="card-body">' +

                    '<h6 class="card-title">' + song['title'] + 
                        ' <a class="spotify" href="https://open.spotify.com/track/' + song['spotify_code'] + '" target="_blank"><i class="fab fa-spotify"></i></a>' + 
                        ' <a class="youtube" href="https://www.youtube.com/watch?v=' + song['youtube_code'] + '" target="_blank"><i class="fab fa-youtube"></i></a>' +  
                        ' <a class="lyrics" href="javascript:void(0)" onclick="showSongLyricsByArtistTitle(\'' + song['artist'].replace("'", "") + '\', \'' + song['title'].replace("'", "") + '\');" ><i class="fa fa-align-justify"></i></a>' +  
                    '</h6>' +
                    '<p class="card-text card_p">' +
                        '<strong>Artist</strong>' + ' <a class="spotify" href="https://open.spotify.com/artist/' + song['spotify_artist_code'] + '" target="_blank"><i class="fab fa-spotify"></i></a>' + 
                        '<br/>' + song['artist'] + '<br/>' +
                        '<strong>Album</strong>' + ' <a class="spotify" href="https://open.spotify.com/album/' + song['spotify_album_code'] + '" target="_blank"><i class="fab fa-spotify"></i></a>' + 
                        '<br/>' + song['album'] + '<br/>' +
                        '<strong>Release date</strong>' +
                        '<br/>' + song['day'] + ' ' + song['month_name'] + ' ' + song['year'] + '<br/>' +
                    '</p>' +

                    '<span>' + 
                        '<button type="button" class="btn btn-default btn-sm" onclick="fastBackward()"><i class="fas fa-fast-backward"></i></button>' +
                        '<button id="playbackButton'+ song_nr.toString() + '" type="button" class="btn btn-default btn-sm" onclick="loadVideo(' + song_nr.toString() + ')"><i class="fa fa-play"></i></button>' +
                        '<button type="button" class="btn btn-default btn-sm" onclick="fastForward()"><i class="fas fa-fast-forward"></i></button>' +
                    '</span>' +

                    '<p id="songTime'+ song_nr.toString() + '">00:00 / 00:00</p>' +
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteSong(' + song['id'].toString() + ')"><i class="fa fa-trash"></i></button>' +

                '</div>' +
            '</div>';

        song_tiles += tile;
    }
    song_tiles += '</div>';

    songContainer.innerHTML = song_tiles;
}

/**
 * Remove a playlist by its id.
 * 
 * @param {number} playlistId The playlist id of the playlist to be removed.
 */
function deletePlaylist(playlistId) {
    var result = confirm("Do you want to delete this playlist?");
    if (result == false) {
        return;
    }

    var url = base_url + "/playlists/" + playlistId.toString();    

    fetch(url, {
        credentials: "same-origin",
        method: 'DELETE',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        showPlaylists();
    });
}

/**
 * Show new tab with the lyrics of a song with the given artist and title.
 * 
 * @param {string} artist The artist of the song.
 * @param {string} title The title of the song.
 */
function showSongLyricsByArtistTitle(artist, title) {
    var url = base_url + "/getLyricsByArtistTitle/" + artist + "/" + title;    

    fetch(url, {
        credentials: "same-origin",
        method: 'GET',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()
        }
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(text) {
        // console.log(text);
        // Based on code from Ray Joe https://stackoverflow.com/questions/34735467/open-html-text-in-new-tab-using-window-open
        var content = document.createElement('div');
        var song_text;
        if (text == '') song_text = 'Lyrics are not found.';
        else song_text = text;
        content.innerHTML = '<h2>' + artist + ' - ' + title + '</h2>' + '<p>' + song_text + '</p>';
        var w = window.open("", "_blank");
        w.document.title = 'Song lyrics'
        w.document.body.appendChild(content);
    }); 
}

/**
 * Starts when the YouTube Video API is loaded.
 */
function onYouTubeIframeAPIReady() {
    YouTubePlayer = new YT.Player('video-placeholder', {
        width: 400,
        height: 400,
        videoId: 'VPRjCeoBqrI',
        playerVars: {
            'color': 'white',
            'playlist': 'taJ60kskkns,FG0fTKAqZ5g',
            // 'origin': "http://www.youtube.com"           
        },
        events: {
            onReady: initialize
        }
    });
}

/**
 * Method called by onYouTubeIframeAPIReady() on start.
 */
function initialize() {
    //
}

/**
 * Handles the video loading, playing and pausing.
 * 
 * @param {number} songId The id of the selected song in songs.
 */
function loadVideo(songId) {
    if (previousSongId != songId || previousSongId == null) {
        var YouTubeCode = songs[songId]['youtube_code'];

        YouTubePlayer.loadVideoById(YouTubeCode); // Load the new YouTube code.
        YouTubePlayer.setPlaybackQuality("medium"); 
        currentYouTubeCode = YouTubeCode;  
        isVideoPlaying = false; 
        
        window.clearInterval(timerInterval);
        timerInterval = setInterval(function () {
            updateTimerDisplay(songId);
        }, 1000);

        if (previousSongId != null) {
            document.getElementById('songTime' + previousSongId.toString()).innerHTML = '<p>00:00 / 00:00</p>';             // Reset previous selected song.
            document.getElementById('songTile' + previousSongId.toString()).style = "background-color:initial ";            // Reset previous selected song.
            document.getElementById('playbackButton'+ previousSongId.toString()).innerHTML = '<i class="fa fa-play"></i>';  // Set new selected song.
        }
        document.getElementById('songTile' + songId.toString()).style = "background-color:LightGrey";
        previousSongId = songId;
    }

    if (isVideoPlaying == false) {
        playVideo();
        document.getElementById('playbackButton'+ songId.toString()).innerHTML = '<i class="fa fa-pause"></i>';
        isVideoPlaying = true;
    }
    else {
        pauseVideo();
        document.getElementById('playbackButton'+ songId.toString()).innerHTML = '<i class="fa fa-play"></i>';
        isVideoPlaying = false;
    }
}

/**
 * Play the YouTube video.
 */
function playVideo() {
    YouTubePlayer.playVideo();
}

/**
 * Pause the YouTube video.
 */
function pauseVideo() {
    YouTubePlayer.pauseVideo();
}

/**
 * Fast forward in the video by 10 seconds.
 */
function fastBackward() {
    var currentTime = YouTubePlayer.getCurrentTime(); // Time in seconds.
    if (currentTime - 10 >= 0) {
        YouTubePlayer.seekTo(currentTime - 10, true);
    }
    else {
        YouTubePlayer.seekTo(0);
    }
}

/**
 * Fast forward in the video by 10 seconds.
 */
function fastForward() {
    var currentTime = YouTubePlayer.getCurrentTime(); // Time in seconds.
    var totalTime = YouTubePlayer.getDuration();
    if (currentTime + 10 <= totalTime) {
        YouTubePlayer.seekTo(currentTime + 10, true);
    } 
    else {
        YouTubePlayer.seekTo(totalTime);
    }
}

/**
 * Make timer that shows the elapsed time of the selected song.
 * We also check if the selected song is no longer visible on 
 * the screen and if necessary stop the time updates and video 
 * playback.
 * 
 *  @param {number} songId The id of the selected song in songs.
 */
function updateTimerDisplay(songId){
    // Update current time text display.

    if (!document.getElementById('songTime' + songId.toString())) {
        window.clearInterval(timerInterval);
        YouTubePlayer.stopVideo();
        return;
    }
    document.getElementById('songTime' + songId.toString()).innerHTML = '<p>' + formatTime(YouTubePlayer.getCurrentTime()) + ' / ' + formatTime(YouTubePlayer.getDuration()) + '</p>'; // Format: 00:00 / 00:00
}

/**
 * Convert the time in seconds to a string.
 * 
 * @param {number} time The time in seconds.
 * @returns {string} Time in format 'minutes:seconds' with zero padding for 2 digits.
 */
function formatTime(time) {
    time = Math.round(time);
    var minutes = Math.floor(time / 60),
    seconds = time - minutes * 60;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    return minutes.toString().padStart(2, '0') + ":" + seconds.toString().padStart(2, '0');
}

// Call this by default;
loadPlaylistsWithSongs();
