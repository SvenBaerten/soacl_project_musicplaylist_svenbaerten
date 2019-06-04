import mysql.connector
from mysql.connector import errorcode

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
   print("Connection established!")
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

# sql = "INSERT INTO song_searches (artist, title) VALUES (%s, %s)"
# val = ("Coldplay", "Yellow")
# cursor.execute(sql, val)

cursor.execute("TRUNCATE song_searches")

connector.commit()