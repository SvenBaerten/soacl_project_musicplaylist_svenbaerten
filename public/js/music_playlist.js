/**
 * Script for header navigation.
 */

// Header hyperlink buttons 
var navPlayMusic = document.getElementById('navPlayMusic');
var navModifyPlaylist = document.getElementById('navModifyPlaylist');
var navModifySong = document.getElementById('navModifySong');
var navUser = document.getElementById('navUser');
var navDocumentation = document.getElementById('navDocumentation');

navPlayMusic.addEventListener("click", loadView_PlayMusic, false);
navModifyPlaylist.addEventListener("click", loadView_PlaylistForm, false);
navModifySong.addEventListener("click", loadView_SongForm, false);
navUser.addEventListener("click", loadView_User, false);

// Get the csrf-token (see master.blade for meta tag).
function getCSRFToken() {
    return document.getElementsByName('csrf-token')[0].getAttribute('content');
}

// Get view from Laravel
function loadView_PlayMusic() {
    // var url = "http://localhost/musicplaylist/public/playlists";    // TODO: Vervangen door URL van Azure!            
    var url = "http://127.0.0.1:8000/playlists/";                

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
        showPlaylistsWithSongs();
        return console.log(JSON.stringify(text));
    });           
}

function loadView_PlaylistForm() {
    // var url = "http://localhost/musicplaylist/public/playlists/create";
    var url = "http://127.0.0.1:8000/playlists/create";                

    let view = 
        fetch(url, {
            credentials: "same-origin",
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
            document.getElementById('container').innerHTML = text;
            return console.log(text);
        });          
}

function loadView_SongForm() {
    // var url = "http://localhost/musicplaylist/public/songs/create";  
    var url = "http://127.0.0.1:8000/songs/create";   

    let view = 
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
            return console.log(text);
        });          
}

function loadView_User() {
    // var url = "http://localhost/musicplaylist/public/user";  
    var url = "http://127.0.0.1:8000/user";   

    let view = 
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
            return console.log(text);
        });       
}

// Handling form submit buttons
function sendPlaylistForm() {
    let nameField = document.getElementById('formPlaylistName');
    let nameFieldValue = nameField.value;
    let ratingField = document.getElementById('formPlaylistRating');
    let ratingFieldValue = ratingField.value;
    let imageField = document.getElementById('formPlaylistImage');
    let imageFieldValue = imageField.value;

    if (imageFieldValue == "") imageFieldValue = "https://media.tmicdn.com/catalog/product/cache/c687aa7517cf01e65c009f6943c2b1e9/m/u/music-note-temporary-tattoo_2597.jpg";

    if (nameFieldValue == "") {
        nameField.style.backgroundColor = "LightCoral ";
    } else {
        nameField.style.backgroundColor = "lightgreen";
        // var url = "http://localhost/musicplaylist/public/playlists";  
        var url = "http://127.0.0.1:8000/playlists";               
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

function sendSongForm() { 
    let youTubeCodeField = document.getElementById('formSongYoutubeCode');
    let youTubeCodeValue = youTubeCodeField.value;
    let playlistField = document.getElementById('formSelectPlaylist');
    let playlistValue = playlistField.value;
    let ratingField = document.getElementById('formSongRating');
    let ratingFieldValue = ratingField.value;
    
    if (youTubeCodeValue == "") {
        youTubeCodeField.style.backgroundColor = "LightCoral ";
    } else {
        youTubeCodeField.style.backgroundColor = "lightgreen";
        // var url = "http://localhost/musicplaylist/public/songs";  
        var url = "http://127.0.0.1:8000/songs";              
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

function sendFormAuthUserSignup() {
    let name = document.getElementById('formAuthUserSignupName');
    let nameValue = name.value;
    let email = document.getElementById('formAuthUserSignupEmail');
    let emailValue = email.value;
    let password = document.getElementById('formAuthUserSignupPassword');
    let passwordValue = password.value;
    let passwordConfirmation = document.getElementById('formAuthUserSignupPasswordConfirm');
    let passwordConfirmationValue = passwordConfirmation.value;
    let status = document.getElementById('formAuthUserSignupStatus');

    if (nameValue == '' || emailValue == '' || passwordValue == '' || passwordConfirmationValue == '') {
        status.innerText = 'Fill in all fields!'
        return;
    }
    else if (passwordValue != passwordConfirmationValue) {
        status.innerText = 'Passwords are not equal!'
        return;
    }

    // let url = "http://localhost/musicplaylist/public/api/auth/signup";
    let url = "http://127.0.0.1:8000/api/auth/signup";
    let data = {'name': nameValue, 'email': emailValue, 'password': passwordValue, 'password_confirmation': passwordConfirmationValue};

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
        return;
    }); 
}

function sendFormAuthUserLogin() {
    let email = document.getElementById('formAuthUserLoginEmail');
    let emailValue = email.value;
    let password = document.getElementById('formAuthUserLoginPassword');
    let passwordValue = password.value;
    let status = document.getElementById('formAuthUserLoginStatus');

    if (emailValue == '' || passwordValue == '') {
        status.innerText = 'Fill in all fields!'
        return;
    }

    // let url = "http://localhost/musicplaylist/public/api/auth/login";                
    let url = "http://127.0.0.1:8000/api/auth/login";
    let data = {'email': emailValue, 'password': passwordValue};

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
        return;
    });     
}

function sendFormAuthUserLogout() {
    let token = document.getElementById('formAuthUserLogoutToken');
    let tokenValue = token.value;
    let status = document.getElementById('formAuthUserLogoutStatus');
    
    if (tokenValue == '') {
        status.innerText = 'Token field is empty!';
        return;
    }

    // let url = "http://localhost/musicplaylist/public/api/auth/logout";  
    let url = "http://127.0.0.1:8000/api/auth/logout";

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
        return;
    });           
}


/**
 * Generating the view for playing songs from playlists.
 */

var playlists;
var songs; // Songs in selected playlist

var YouTubePlayer;
var currentYouTubeCode;
var isVideoPlaying = false;

 // Sow playlists with songs
function showPlaylistsWithSongs() {
    // alert('load');
    // var url = "http://localhost/musicplaylist/public/playlists/playlistswithsongs";    
    var url = "http://127.0.0.1:8000/playlists/playlistswithsongs";    

    var x =
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
        loadPlaylists();
        return;
    }); 
}

function loadPlaylists() {
    var playlistContainer = document.getElementById("playlist_container");
    playlistContainer.innerHTML = '';
    for (var playlist_nr = 0; playlist_nr < playlists.length; playlist_nr++) {
        var playlist = playlists[playlist_nr];

        var x =
        '<div id="playlist' + playlist_nr.toString() + '" class="card mb-1 text-white bg-dark" style="border:1px purple solid;" onclick="showSongs(' + playlist_nr.toString() + ')">' +
            '<div class="row no-gutters">' +
             
              '<div class="col-md-2" style="border: 1px solid green">' +
                '<img src="' + playlist['image'] + '" class="card-img" style="object-fit: cover; width: 100%;" >' +
              '</div>' +

              '<div class="col-md-10">' +
                '<div class="card-body">' +
                  '<h6 class="card-title">' + playlist['name'] + '</h6>' +
                '</div>' +
              '</div>' +

            '</div>' +
        '</div>';

        playlistContainer.innerHTML += x;       
	}
}

function showSongs(playlistId) {
    // YouTube video control based on https://tutorialzine.com/2015/08/how-to-control-youtubes-video-player-with-javascript
    var songContainer = document.getElementById("song_container");

    songs = playlists[playlistId]['songs'];

    songContainer.innerHTML = '';
    var song_tiles = '<div class="card-deck">';

    for (var song_nr = 0; song_nr < songs.length; song_nr++) {
        var song = songs[song_nr];
        var tile = 
            '<div class="card text-center card_custom">' +
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
                        '<button type="button" class="btn btn-default btn-sm" onclick="loadVideo(' + song_nr.toString() + ')"><i class="fas fa-fast-backward"></i></button>' +
                        '<button type="button" class="btn btn-default btn-sm" onclick="loadVideo(' + song_nr.toString() + ')"><i class="fa fa-play"></i></button>' +
                        '<button type="button" class="btn btn-default btn-sm" onclick="loadVideo(' + song_nr.toString() + ')"><i class="fas fa-fast-forward"></i></button>' +
                    '</span>' +

                    '<p>00 : 00</p>' +

                '</div>' +
            '</div>';

        song_tiles += tile;
    }
    song_tiles += '</div>';

    songContainer.innerHTML = song_tiles;
}

function showSongLyricsByArtistTitle(artist, title) {
    var url = "http://localhost/musicplaylist/public/getLyricsByArtistTitle/" + artist + "/" + title;    
    console.log(artist);
    console.log(title);
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
        console.log(text);
        // Based on code from Ray Joe https://stackoverflow.com/questions/34735467/open-html-text-in-new-tab-using-window-open
        var content = document.createElement('div');
        var song_text;
        if (text == '') song_text = 'Lyrics are not found.';
        else song_text = text;
        content.innerHTML = '<h2>' + artist + ' - ' + title + '</h2>' + '<p>' + song_text + '</p>';
        var w = window.open("", "_blank");
        w.document.title = 'Song lyrics'
        w.document.body.appendChild(content);
        return;
    }); 
}

function onYouTubeIframeAPIReady() {
    YouTubePlayer = new YT.Player('video-placeholder', {
        width: 400,
        height: 400,
        videoId: 'Xa0Q0J5tOP0',
        playerVars: {
            color: 'white',
            playlist: 'taJ60kskkns,FG0fTKAqZ5g'
        },
        events: {
            onReady: initialize
        }
    });
}

function initialize() {
    // alert('done');
}

function loadVideo(songId) {
    YouTubeCode = songs[songId]['youtube_code'];
    if (songId != currentYTId) {
        YouTubePlayer.loadVideoById(YouTubeCode);
        currentYouTubeCode = YouTubeCode;
    }
    if (isVideoPlaying == false)  {
        playVideo();
        isVideoPlaying = true;
    }
    else {
        pauseVideo();
        isVideoPlaying = false;
    }
}

function playVideo(){
    YouTubePlayer.playVideo();
}

function pauseVideo(){
    YouTubePlayer.pauseVideo();
}


showPlaylistsWithSongs();
