# Reference to Flask: http://flask.pocoo.org/
from flask import Flask, current_app
from flask_restful import Api, Resource
import spotify.Spotify as Spotify
from flask_cors import CORS

# Reference to MySQL connector: https://dev.mysql.com/doc/connector-python/en/
import mysql.connector
from mysql.connector import errorcode

class Start(Resource):
    '''
    Handling route "/".
    '''
    def get(self):
        print('/')
        return current_app.send_static_file('index.html') # Shows the main page with documentation

class SpotifyTrack(Resource):
    '''
    Handling route "/api/track/<string:artist>/<string:title>".
    '''
    def __init__(self, spotify, db):
        self.spotify = spotify
        self.db = db

    def get(self, artist, title):   
        # Get track info from Spotify 
        track_info = None    
        try:            
            track_info = self.spotify.get_track_info(artist=artist, title=title)
        except:
            print('Error while retrieving music track information from Spotify.')

        # Add to table "song_searches" in "flaskspotifydb" SQL db
        if self.db['connector'] != None and track_info != None:
            try:
                if (self.db['connector'].is_connected() == False):
                    self.db['connector'].ping(reconnect=True, attempts=5, delay=1)

                sql = "INSERT INTO song_searches (artist, title, genre, album, release_date) VALUES (%s, %s, %s, %s, %s)"
                val = (track_info['artist']['artist_name'], track_info['track']['track_name'], track_info['track']['track_genre'], track_info['album']['album_name'], track_info['album']['album_release_date'])
                db['cursor'].execute(sql, val)
                db['connector'].commit()
            except:
                print('Error while adding music track information to db "flaskspotifydb" in table "song_searches".')

        return track_info
    
    def post(self):
        pass

    def put(self):
        pass
    
    def delete(self):
        pass

if __name__ == '__main__':
    # Make Flask app
    app = Flask(__name__)
    CORS(app)
    api = Api(app)    

    # Make spotify object
    spotify = Spotify.Spotify()

    # Azure SQL database configuration (based on https://dev.mysql.com/doc/connector-python/en/connector-python-example-connecting.html)
    config = {
        'host':'musicplaylist-mysql-db.mysql.database.azure.com',
        'user':'sven@musicplaylist-mysql-db',
        'password':'MySQLAzure2019',
        'database':'flaskspotifydb'
    }

    connector = None
    try:
        connector = mysql.connector.connect(**config)
        print("DB Connection established!")
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with the user name or password!")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist!")
        else:
            print(err)

    cursor = None
    if connector != None:
        cursor = connector.cursor()  

    db = {'connector':connector, 'cursor':cursor}

    # Route setup
    api.add_resource(Start, "/")
    api.add_resource(SpotifyTrack, "/api/track/<string:artist>/<string:title>", resource_class_kwargs={'spotify':spotify, 'db':db})
       
    app.run('0.0.0.0', port=80)