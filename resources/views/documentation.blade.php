<h2><u>Documentation</u></h2>
<br>
<ol>
    <h4><li>About the application</li></h4>
    <ul>
        <li>This application functions as a media player with which you can create and listen to playlists of your favorite songs.</li>
        <li>There are 5 tabs in the navigation bar:
            <ul>
                <li>Play music: This option shows the playlists and songs. Click on a playlist to view and listen to the songs. The garbage bin can be used to remove a playlist or song.</li>
                <li>Make playlist: This option opens a playlist form. Fill in the information to make a new playlist. </li>
                <li>Add song: This option opens a song form. Fill in the information to add a song to a playlist. </li>
                <li>User: This option opens forms for user authentication. Here, the user can get an authentication token to access the REST API. First, if you have no account, you need to sign up. Then, you can log in to receive a token. Finally, if you want to no longer access the API, you can log out using the token.</li>
                <li>Documentation: This option shows the documentation.</li>
            </ul>
        </li>
        <li>This is a project for the course "SOA & Cloud computing [SOACL]" (2018-2019) from Prof. Kris AERTS & Stijn SCHILDERMANS at Hasselt University & KU Leuven.</li>
    </ul>

    <br>
    
    <h4><li>Laravel REST API</li></h4>
    <ul>
        <li>
            Get playlists with songs as a JSON object. An API token is required.
            <ul>
                <li>URL: /api/playlists</li>
                <li>Method: GET</li>
                <li>
                    URL parameters:
                    <ul>
                        <li>None</li>
                    </ul>
                </li>
                <li>
                    Headers:
                    <ul>
                        <li>X-Requested-With: XMLHttpRequest</li>
                        <li>Content-Type: application/json</li>
                        <li>Authorization: Bearer [token, obtainable in 'User' tab or authentication REST API (see below)]</li>
                    </ul>
                </li>
                <li>
                    Body parameters:
                    <ul>
                        <li>
                            None
                        </li>
                    </ul>
                </li>
                <li>
                    Success response:
                    <ul>
                        <li>Code 200 (OK) with response a JSON object with playlists and songs like in 'Sample call - Response'</li>
                    </ul>
                </li>
                <li>
                    Error response:
                    <ul>
                        <li>Code 401 (Unauthorized) with response {"message": "Unauthorized!"}</li>
                        <li>Code 500 (Internal Server Error)</li>
                    </ul>
                </li>
                <li>
                    Sample call:
                    <ul>
                        <li>
                            Command:
                            <p style="word-wrap:break-word; height:100px; overflow-y:scroll; margin:0px;">curl -X GET -H "Content-Type: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEwM2NlOTI0MWVhMGIxNjFmNGU4MjVkNTc5NGY5ZDIyNjc4ZTJlMzMxMDc5ZDBmMmVkZmM0MzExY2RjYTY0YmQzMmM3MzIyMmFiYTUyMDU5In0.eyJhdWQiOiIzIiwianRpIjoiMTAzY2U5MjQxZWEwYjE2MWY0ZTgyNWQ1Nzk0ZjlkMjI2NzhlMmUzMzEwNzlkMGYyZWRmYzQzMTFjZGNhNjRiZDMyYzczMjIyYWJhNTIwNTkiLCJpYXQiOjE1NTk1OTkyNzgsIm5iZiI6MTU1OTU5OTI3OCwiZXhwIjoxNTkxMjIxNjc4LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.w_aQkSThoiZG-z6wIqqMVleb6xwvHpyLLGZrcUbl_F-OY4yEX9-3CVSAEC-2FGQUnQs7xMjMWbDBEHaLz1PgnVdcE-WpwXdaUT3dH4nNo6ubg-HZ0XsgMnlAOzKbtajxp0RhHfZGy89AO-8xfnfE_UzQrLxcsHrGqghsTqvTiADM3GJCtFLxggWcT9Tod6LWXeEtbmZ8Cz09X6gRtO1ioKc6SCTruqq-nPl7ffGvxpqjzej8Qj4bbZyIaXYIvwuOldVjkt3T8kTT2LkgNBCJ-XpT3aAitB87sjENFghq99eJOF3hZfmiPX6Sc1dwrlBGECZQB1UiV3NOAeYnUcP1xjKRvy61NMKsqloRsAzndzL7EQ1Am38jFzyVgPN4HQPsDU5tT-XZJw34Ps4Ch-rtSxFkH2ysrV46NLcgU3k1PaZxiPB1gNRVGpwoSj-jq1s8OsnZ3w7IiGgybMr6BkdouCbJbIHsbbwVcC0bl2Kr_VOOx0YfdqxEBDUXj2Q1XO0JZzGcLGh7DBFhQjXcu28NkcOomIquV34vwuBhbxjpHg4jLEbHQLiVT_xXWTFMHCcs3LRGWuPFqNaVWX22b0riuMSUS4uzwOTWG16DMMMDe8Xwhe-3xDnGMSFsXWQfnK2ZzB1epRMcZf4JlyaTruiPQDrH99HfjIai8Ph8pdJzOS0" "http://laravel-svenbaerten.azurewebsites.net/api/playlists"</p>
                        </li>
                        <li>
                            Response:
                            <pre style="word-wrap:break-word; height:100px; overflow-y:scroll; white-space:pre-line; margin:0px;">
                            [
                                {
                                    "id": 2,
                                    "name": "Coldplay",
                                    "image": "https://www.music-bazaar.com/album-images/vol31/1139/1139039/3006145-big/The-Best-Songs-cover.jpg",
                                    "rating": 0,
                                    "created_at": "2019-06-02 16:52:42",
                                    "updated_at": "2019-06-02 16:52:42",
                                    "songs": [
                                    {
                                        "id": 7,
                                        "playlist_id": 2,
                                        "title": "The Scientist",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "A Rush Of Blood To The Head",
                                        "year": 2002,
                                        "month": 8,
                                        "month_name": "August",
                                        "day": 8,
                                        "rating": 0,
                                        "youtube_code": "RB-RcX5DS5A",
                                        "youtube_title": "Coldplay - The Scientist",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/RB-RcX5DS5A/mqdefault.jpg",
                                        "spotify_code": "75JFxkI2RXiU7L9VXzMkle",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "0RHX9XECH8IVI3LNgWDpmQ",
                                        "spotify_album_cover": "https://i.scdn.co/image/70d8660d8b802835a280ce75799d30db262f7094",
                                        "created_at": "2019-06-02 20:39:04",
                                        "updated_at": "2019-06-02 20:39:04"
                                    },
                                    {
                                        "id": 13,
                                        "playlist_id": 2,
                                        "title": "Adventure Of A Lifetime",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "A Head Full Of Dreams",
                                        "year": 2015,
                                        "month": 12,
                                        "month_name": "December",
                                        "day": 4,
                                        "rating": 0,
                                        "youtube_code": "QtXby3twMmI",
                                        "youtube_title": "Coldplay - Adventure Of A Lifetime (Official Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/QtXby3twMmI/mqdefault.jpg",
                                        "spotify_code": "69uxyAqqPIsUyTO8txoP2M",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "3cfAM8b8KqJRoIzt3zLKqw",
                                        "spotify_album_cover": "https://i.scdn.co/image/9c2c4a9ac9726bfd996ff96383178bbb5efc59ab",
                                        "created_at": "2019-06-02 20:40:31",
                                        "updated_at": "2019-06-02 20:40:31"
                                    },
                                    {
                                        "id": 14,
                                        "playlist_id": 2,
                                        "title": "Hymn For The Weekend",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "A Head Full Of Dreams",
                                        "year": 2015,
                                        "month": 12,
                                        "month_name": "December",
                                        "day": 4,
                                        "rating": 0,
                                        "youtube_code": "YykjpeuMNEk",
                                        "youtube_title": "Coldplay - Hymn For The Weekend (Official Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/YykjpeuMNEk/mqdefault.jpg",
                                        "spotify_code": "3RiPr603aXAoi4GHyXx0uy",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "3cfAM8b8KqJRoIzt3zLKqw",
                                        "spotify_album_cover": "https://i.scdn.co/image/9c2c4a9ac9726bfd996ff96383178bbb5efc59ab",
                                        "created_at": "2019-06-02 20:40:44",
                                        "updated_at": "2019-06-02 20:40:44"
                                    },
                                    {
                                        "id": 15,
                                        "playlist_id": 2,
                                        "title": "A Sky Full Of Stars",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "Ghost Stories",
                                        "year": 2014,
                                        "month": 5,
                                        "month_name": "May",
                                        "day": 19,
                                        "rating": 0,
                                        "youtube_code": "VPRjCeoBqrI",
                                        "youtube_title": "Coldplay - A Sky Full Of Stars (Official Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/VPRjCeoBqrI/mqdefault.jpg",
                                        "spotify_code": "0FDzzruyVECATHXKHFs9eJ",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "2G4AUqfwxcV1UdQjm2ouYr",
                                        "spotify_album_cover": "https://i.scdn.co/image/6218fc701d5c6e66c200f29b57fc4cd5f979313f",
                                        "created_at": "2019-06-02 20:40:50",
                                        "updated_at": "2019-06-02 20:40:50"
                                    },
                                    {
                                        "id": 16,
                                        "playlist_id": 2,
                                        "title": "Viva La Vida",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "Viva La Vida Or Death And All His Friends",
                                        "year": 2008,
                                        "month": 5,
                                        "month_name": "May",
                                        "day": 26,
                                        "rating": 0,
                                        "youtube_code": "dvgZkm1xWPE",
                                        "youtube_title": "Coldplay - Viva La Vida",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/dvgZkm1xWPE/mqdefault.jpg",
                                        "spotify_code": "1mea3bSkSGXuIRvnydlB5b",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "1CEODgTmTwLyabvwd7HBty",
                                        "spotify_album_cover": "https://i.scdn.co/image/009aa1548af52b1d834648c6452f3804f086fead",
                                        "created_at": "2019-06-02 20:40:54",
                                        "updated_at": "2019-06-02 20:40:54"
                                    },
                                    {
                                        "id": 17,
                                        "playlist_id": 2,
                                        "title": "Paradise",
                                        "artist": "Coldplay",
                                        "genre": "pop",
                                        "album": "Mylo Xyloto",
                                        "year": 2011,
                                        "month": 10,
                                        "month_name": "October",
                                        "day": 24,
                                        "rating": 0,
                                        "youtube_code": "1G4isv_Fylg",
                                        "youtube_title": "Coldplay - Paradise (Official Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/1G4isv_Fylg/mqdefault.jpg",
                                        "spotify_code": "6nek1Nin9q48AVZcWs9e9D",
                                        "spotify_artist_code": "4gzpq5DPGxSnKTe4SA8HAU",
                                        "spotify_artist_image": "https://i.scdn.co/image/d5fcdc130ec341b3e8814da749ba260191c938aa",
                                        "spotify_album_code": "2R7iJz5uaHjLEVnMkloO18",
                                        "spotify_album_cover": "https://i.scdn.co/image/e7a649b3890dc849e0f1597d6d12b4342e03ce5f",
                                        "created_at": "2019-06-02 20:41:00",
                                        "updated_at": "2019-06-02 20:41:00"
                                    }
                                    ]
                                },
                                {
                                    "id": 3,
                                    "name": "The Black Eyed Peas",
                                    "image": "https://thatgrapejuice.net/wp-content/uploads/2010/10/thebeginning.jpg",
                                    "rating": 0,
                                    "created_at": "2019-06-02 20:42:23",
                                    "updated_at": "2019-06-02 20:42:23",
                                    "songs": [
                                    {
                                        "id": 19,
                                        "playlist_id": 3,
                                        "title": "Pump It",
                                        "artist": "The Black Eyed Peas",
                                        "genre": "pop rap",
                                        "album": "Monkey Business",
                                        "year": 2005,
                                        "month": 1,
                                        "month_name": "January",
                                        "day": 1,
                                        "rating": 0,
                                        "youtube_code": "ZaI2IlHwmgQ",
                                        "youtube_title": "The Black Eyed Peas - Pump It (Official Music Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/ZaI2IlHwmgQ/mqdefault.jpg",
                                        "spotify_code": "6btyEL6NwUa97Nex9cZFvo",
                                        "spotify_artist_code": "1yxSLGMDHlW21z4YXirZDS",
                                        "spotify_artist_image": "https://i.scdn.co/image/8187a0a248d8d17c6fbec79f8fdc2aa87a953369",
                                        "spotify_album_code": "2szeSQtOcJgRhDXmTS3SIf",
                                        "spotify_album_cover": "https://i.scdn.co/image/b90d6d82f38fae435f45c8a3083608a17deca341",
                                        "created_at": "2019-06-02 20:42:41",
                                        "updated_at": "2019-06-02 20:42:41"
                                    },
                                    {
                                        "id": 20,
                                        "playlist_id": 3,
                                        "title": "I Gotta Feeling",
                                        "artist": "The Black Eyed Peas",
                                        "genre": "pop rap",
                                        "album": "THE E.N.D. (THE ENERGY NEVER DIES)",
                                        "year": 2009,
                                        "month": 1,
                                        "month_name": "January",
                                        "day": 1,
                                        "rating": 0,
                                        "youtube_code": "uSD4vsh1zDA",
                                        "youtube_title": "The Black Eyed Peas - I Gotta Feeling (Official Music Video)",
                                        "youtube_thumbnail": "https://i.ytimg.com/vi/uSD4vsh1zDA/mqdefault.jpg",
                                        "spotify_code": "4vp2J1l5RD4gMZwGFLfRAu",
                                        "spotify_artist_code": "1yxSLGMDHlW21z4YXirZDS",
                                        "spotify_artist_image": "https://i.scdn.co/image/8187a0a248d8d17c6fbec79f8fdc2aa87a953369",
                                        "spotify_album_code": "36fdxiOzdlmsrHgGcfvqUJ",
                                        "spotify_album_cover": "https://i.scdn.co/image/460fe4532ae54cac910c69a9b46a03e17a54d025",
                                        "created_at": "2019-06-02 20:42:46",
                                        "updated_at": "2019-06-02 20:42:46"
                                    }
                                    ]
                                }
                            ]
                            </pre>
                        </li>
                    </ul>
                </li>                
            </ul>
        </li>
        
        <br>
        
        <li>
            Get lyrics of a song by its artist and title.
            <ul>
                <li>URL: /api/getSongLyricsByArtistTitle?artist=[artist]&title=[song title]</li>
                <li>Method: GET</li>
                <li>
                    URL parameters:
                    <ul>
                        <li>artist: the artist of the song</li>
                        <li>title: the title of the song</li>
                    </ul>
                </li>
                <li>
                    Headers:
                    <ul>
                        <li>
                            None
                        </li>
                    </ul>
                </li>
                <li>
                    Body parameters:
                    <ul>
                        <li>
                            None
                        </li>
                    </ul>
                </li>
                <li>
                    Success response:
                    <ul>
                        <li>Code 200 (OK) with response the song lyrics string like in 'Sample call - Response'</li>
                    </ul>
                </li>
                <li>
                    Error response:
                    <ul>
                        <li>Code 500 (Internal Server Error)</li>
                    </ul>
                </li>
                <li>
                    Sample Call:
                    <ul>
                        <li>
                            Command:
                            <p style="word-wrap: break-word; margin: 0px;">curl -X GET "http://laravel-svenbaerten.azurewebsites.net/api/getSongLyricsByArtistTitle?artist=coldplay&title=viva la vida"</p>
                        </li> 
                        <li>
                            Response:
                            <pre style="word-wrap: break-word; height: 100px; overflow-y: scroll; white-space: pre-line; margin: 0px;">
                                I used to rule the world
                                Seas would rise when I gave the word
                                Now in the morning I sleep alone
                                Sweep the streets I used to own

                                I used to roll the dice
                                Feel the fear in my enemy's eyes
                                Listen as the crowd would sing
                                "Now the old king is dead! Long live the king!"

                                One minute I held the key
                                Next the walls were closed on me
                                And I discovered that my castles stand
                                Upon pillars of salt and pillars of sand

                                I hear Jerusalem bells a ringing
                                Roman Cavalry choirs are singing
                                Be my mirror, my sword and shield
                                My missionaries in a foreign field

                                For some reason I can't explain
                                Once you go there was never
                                Never an honest word
                                And that was when I ruled the world

                                It was the wicked and wild wind
                                Blew down the doors to let me in
                                Shattered windows and the sound of drums
                                People couldn't believe what I'd become

                                Revolutionaries wait
                                For my head on a silver plate
                                Just a puppet on a lonely string
                                Oh who would ever want to be king?

                                I hear Jerusalem bells a ringing
                                Roman Cavalry choirs are singing
                                Be my mirror, my sword and shield
                                My missionaries in a foreign field

                                For some reason I can't explain
                                I know Saint Peter won't call my name
                                Never an honest word
                                But that was when I ruled the world

                                I hear Jerusalem bells a ringing
                                Roman Cavalry choirs are singing
                                Be my mirror, my sword and shield
                                My missionaries in a foreign field

                                For some reason I can't explain
                                I know Saint Peter won't call my name
                                Never an honest word
                                But that was when I ruled the world
                            </pre>
                        </li>                    
                    </ul>
                </li> 
                
                <li>
                    Notes:
                    <ul>
                        <li>
                            This Laravel web service uses a SOAP web service from <a href="http://www.chartlyrics.com" target="_blank">"http://www.chartlyrics.com/"</a> which only has lyrics of songs up to 2011.
                        </li>
                    </ul>
                </li>

            </ul>
        </li>        

        <br>
        
        <li>
            Sign in to make a user account.
            <ul>
                <li>URL: /api/auth/signup</li>
                <li>Method: POST</li>
                <li>
                    URL parameters:
                    <ul>
                        <li>None</li>
                    </ul>
                </li>
                <li>
                    Headers:
                    <ul>
                        <li>X-Requested-With: XMLHttpRequest</li>
                        <li>Content-Type: application/json</li>
                    </ul>                    
                </li>
                <li>
                    Body parameters:
                    <ul>
                        <li>
                            {"name": [string:name], "email": [string:email], "password": [string:password], "password_confirmation": [string:password]}
                        </li>
                    </ul>
                </li>
                <li>
                    Success response:
                    <ul>
                        <li>Code 201 (Created) with response {"message": "Successfully created user!"}</li>
                    </ul>
                </li>
                <li>
                    Error response:
                    <ul>
                        <li>Code 422 (Unprocessable Entity) with response {"message": "The given data was invalid.", "errors": { ... }}</li>
                        <li>Code 500 (Internal Server Error)</li>
                    </ul>
                </li>
                <li>
                    Sample Call:
                    <ul>
                        <li>
                            Command:
                            <p style="word-wrap: break-word; margin: 0px;">curl -X POST -H "X-Requested-With: XMLHttpRequest" -H "Content-Type: application/json" -d '{"name": "sven", "email": "sven.baerten@outlook.com", "password": "password", "password_confirmation": "password"}' "http://laravel-svenbaerten.azurewebsites.net/api/auth/signup"</p>                      
                        </li>
                        <li>
                            Response:
                            <p style="margin: 0px;">{"message":"Successfully created user!"}</p>
                        </li>
                    
                    </ul>
                </li>                
            </ul>
        </li>   

        <br>

        <li>
            Log in to your account to receive an API authentication token.
            <ul>
                <li>URL: /api/auth/login</li>
                <li>Method: POST</li>
                <li>
                    URL parameters: 
                    <ul>
                        <li>None</li>
                    </ul>
                </li>
                <li>
                    Headers:
                    <ul>
                        <li>X-Requested-With: XMLHttpRequest</li>
                        <li>Content-Type: application/json</li>
                    </ul>                    
                </li>
                <li>
                    Body parameters:
                    <ul>
                        <li>
                            {"email": [string:email], "password": [string:password]}
                        </li>
                    </ul>
                </li>
                <li>
                    Success response:
                    <ul>
                        <li>Code 200 (OK) with response {"access_token": [string:token], "token_type": "Bearer", "expires_at": [string:date]}</li>
                    </ul>
                </li>
                <li>
                    Error response:
                    <ul>
                        <li>Code 401 (Unauthorized) with response {"message": "Unauthorized!"}</li>
                        <li>Code 500 (Internal Server Error)</li>
                    </ul>
                </li>
                <li>
                    Sample Call:
                    <ul>
                        <li>
                            Command:
                            <p style="word-wrap: break-word; margin:0px;">curl -X POST -H "X-Requested-With: XMLHttpRequest" -H "Content-Type: application/json" -d '{"email": "sven.baerten@outlook.com", "password": "password"}' "http://laravel-svenbaerten.azurewebsites.net/api/auth/login"</p>                      
                        </li>
                        <li>
                            Response:
                            <pre style="word-wrap: break-word; height: 100px; overflow-y: scroll; white-space: pre-line; margin: 0px;">
                                {
                                "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU5MmJmYTU0MDEyZGU4YzFhNGVhYTk0Yzg2NWU5ODBjOTA2MzY5N2Y3ZWI2Mjg3MDJjYjM3YjM3MmNjNjU4MzA2MWZhZGE2ZTZmYjFjOTMzIn0.eyJhdWQiOiIzIiwianRpIjoiZTkyYmZhNTQwMTJkZThjMWE0ZWFhOTRjODY1ZTk4MGM5MDYzNjk3ZjdlYjYyODcwMmNiMzdiMzcyY2M2NTgzMDYxZmFkYTZlNmZiMWM5MzMiLCJpYXQiOjE1NTk1OTc3NjMsIm5iZiI6MTU1OTU5Nzc2MywiZXhwIjoxNTkxMjIwMTYzLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.Yu0K6uAeLg-7iIA4gJdmCzmlRbx0E5FGIzm4FtE_iPzvKXz6HpI_P-fXXo0YVR2b-IDb16ha7pHaT0Oj9qKDGOvKN8oy6jiOJk04ivkk4AAKAV8w6tlApmBnl_9Xiex6LFN3LvDDoxb4j-5fIVxXxPPwV4boQ1NzZXjolBnmJGjGg6ybwuwDT2F2dnqwye7N2YKCw4xn6heEUasFae-LNsoUmHCQb4MlXBjcMYheoPWjAZu4lqBCAHF_DDnGAIwonZlNBf14LPQcPaUUzYAXyQOl7iH8yvSFBB5nLRsrHvKEqGLGQ5piXkD5dsKZqW-6m-Nbq9UjwLjJrEFX9tZVCFRRuLB5Ji89OYFc4kYCooA-pTb7vuQbIPuXmUjuEsQhs3vkHsaMa4UgJlO85_g5mFhycYisK1wzkELwzei0BxjmwEjmd5RPPrOfLiizK6f2gLLBFu5H_CPC5pL8PBwU8l50yl6BIj-5rwWFmWLBCxF-3pMCTt5VWa3XfIt92-58AATDeW7USK_ELjjj3B6R9EPfl2FueIdF-ENKj1-pjlvA5YVXi298bUdoYToj3vWMUHxu9jxewHWPL4jxE8IS59hOQq1wM9rFjM1iw5JhS5AgmogPocAS5yy-5Q20lyc18hN5ZTZTP9UqOZ2T2EuN3qyqejKFtZLFBNaMgsr6LNI",
                                "token_type": "Bearer",
                                "expires_at": "2019-07-03 23:36:03"
                                }
                            </pre>
                        </li>
                    
                    </ul>
                </li>                
            </ul>
        </li> 

        <br>

        <li>
            Log out your account to revoke the API authentication token.
            <ul>
                <li>URL: /api/auth/logout</li>
                <li>Method: GET</li>
                <li>
                    URL parameters:
                    <ul>
                        <li>None</li>
                    </ul>
                </li>
                <li>
                    Headers:
                    <ul>
                        <li>X-Requested-With: XMLHttpRequest</li>
                        <li>Content-Type: application/json</li>
                        <li>Authorization: Bearer [token]</li>
                    </ul>                    
                </li>
                <li>
                    Body parameters:
                    <ul>
                        <li>None</li>
                    </ul>
                </li>
                <li>
                    Success response:
                    <ul>
                        <li>Code 200 (OK) with response {"message": "Successfully logged out!"}</li>
                    </ul>
                </li>
                <li>
                    Error response:
                    <ul>
                        <li>Code 401 (Unauthorized) with response {"message": "Unauthorized!"}</li>
                        <li>Code 500 (Internal Server Error)</li>
                    </ul>
                </li>
                <li>
                    Sample call:
                    <ul>
                        <li>
                            Command:
                            <p style="word-wrap:break-word; height:100px; overflow-y:scroll; margin:0px;">curl -X GET -H "X-Requested-With: XMLHttpRequest" -H "Content-Type: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMyZmMxODMyZWJmNDhmMzM5MDdiOWRhM2ExMDBjOWNlZDE4ZTY1OWNlNmZmOTA2Njg1Njc4ZGE1YzlmN2Y4ZDNiZTE5NWJjZmIwZDhiODgwIn0.eyJhdWQiOiIzIiwianRpIjoiMzJmYzE4MzJlYmY0OGYzMzkwN2I5ZGEzYTEwMGM5Y2VkMThlNjU5Y2U2ZmY5MDY2ODU2NzhkYTVjOWY3ZjhkM2JlMTk1YmNmYjBkOGI4ODAiLCJpYXQiOjE1NTk1OTg4MDgsIm5iZiI6MTU1OTU5ODgwOCwiZXhwIjoxNTkxMjIxMjA4LCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.wpez51MYP3A9UQ2FYT6Euw6PhSn7ZKrDBe3EiSsYXPz6pKzdBkXk2p_ZQgk-QEVnft7mFuLmTKnaCXnkKD_5HIvUZPNK0YGD1Dc-j7owa26HPq2Ujrj6Gi2UNIK3HpO7aZAGe2twmInyxsW9YGD_YpxddhIylvybh2ypKAMyrHgtdqXnpb-XZBXlhUwa4KzH3gcyxX6ZgWaQS8nsupM_jj_dzi-_WGVfNSlXmGYa1qBR9ButTWyxNg3Vh_uwWRtxsGdQkgEaxXIq-YfCiZKzsi_Z6TZZO6YuY8F0PduuYzBi0J67IWPGgHg3tpBcSkpXeeRgoto4IcaGYIujm9rQp185wL8VHOVx0-d01NshWSMmn5KBx9JYHsyti6XR4JDtXD9lmG87YlmdJHZeoxXfs7vKMCyxfePN3RkF9NRlEjHBBieHlgL3SuBw7Gny4-kic0WmKa69DzpuakLVGDYn8UpZqZAWPExzsIsedPnYHrRpFkb0lZPd81pTJ4nerhfPD0-Ykq8Rcw5QItJ4k1S3gFPH_6_uARAS2RJ2F39cE_k43BW_iU-CRWaA7Eq4vIpGBoy1MrNPGRU_KMzHkxu6-XDFbd5rH7PAXZRmrQ29kh2gNLJ4JRJz7VeGcbCql3o8qE83kCIGc52kJcyMhw2pxxBoAyWSsU8TyGDFma0NJF8" "http://laravel-svenbaerten.azurewebsites.net/api/auth/logout"</p>                      
                        </li>  
                        <li>
                            Return:
                            <p style="margin: 0px;">{"message":"Successfully logged out!"}</p>
                        </li>                
                    </ul>
                </li>                
            </ul>
        </li>

    </ul>

    <br>

    <h4><li>Other web services made for this application</li></h4>
    <ul>
        <li>Python Flask REST web service: see <a href="http://flask-web-service-svenbaerten.westeurope.azurecontainer.io/" target="_blank">http://flask-web-service-svenbaerten.westeurope.azurecontainer.io/<a> for in-depth information.</li>
        <li>Node.js REST web service: see <a href="http://nodejs-web-service-svenbaerten.westeurope.azurecontainer.io/" target="_blank">http://nodejs-web-service-svenbaerten.westeurope.azurecontainer.io/<a> for in-depth information.</li>
        <li>C# SOAP web services: see <a href="https://soap-web-service-svenbaerten.azurewebsites.net/DateSplitterService.asmx" target="_blank">https://soap-web-service-svenbaerten.azurewebsites.net/DateSplitterService.asmx</a> & <a href="https://soap-web-service-svenbaerten.azurewebsites.net/YouTubeSplitterService.asmx" target="_blank">https://soap-web-service-svenbaerten.azurewebsites.net/YouTubeSplitterService.asmx</a> for in-depth information.</li>
    </ul>

</ol>

