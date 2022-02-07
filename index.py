import requests
from PIL import Image
import imagehash
import pandas as pd
import mysql.connector
import facebook




#function to fill hashed data in DB
def fill(y, headings, mycursor, mydb, timing, acc_id):

    lis=[]

    lis.append(acc_id)

    for i in headings:

        a=str(y[i].values[0])
        lis.append(a)


    lis.append(timing)

    sql = "INSERT INTO hashes (acc_id, image, ahash, phash, dhash, whash, colorhash, timing) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"

    mycursor.execute(sql, lis)

    mydb.commit()

    print(mycursor.rowcount, "was inserted.")



#function to hash an image
def gohash(url):

    df = pd.DataFrame(columns=['image','ahash','phash','dhash','whash','colorhash'])

    file = Image.open(requests.get(url, stream=True).raw)

    data = {
        'image': url,
        'ahash': imagehash.average_hash(file),
        'phash': imagehash.phash(file),
        'dhash': imagehash.dhash(file),
        'whash': imagehash.whash(file),
        'colorhash': imagehash.colorhash(file),   
    }

    df = df.append(data, ignore_index=True)
    
    x=df.head(1)

    return(x)





mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="Music$$24",
  database="rootrack"
)
mycursor = mydb.cursor()



# my_token = 'EAAEcKSxm1QQBALf00rJyKa1snCtWZAY9UJfvgOsZAum7mGo4PexBPzd786YW41NjNZCOXU96QauekZC5W5ZBsnZAJ2i44hEvEz89GIZBLYt1ZC2T9vpmC8GhXZBxyZBvyg48QSDn2BVH9KBd3oZA8IgeLZCSwYe9llmcxZBrV5f6kqmfMRJjv4l6qq3jY0q0WdruTOXoajbVXEY6YpBarQDa5VeHs8etfvlzHjZCxOCZCDwunhLygnVlVT3Cv8O'
my_token = input("Enter account token: ")
graph = facebook.GraphAPI(access_token=my_token)
posts = graph.get_connections(id='me', connection_name='posts', fields = 'full_picture,created_time')

photos = posts['data']

URL = photos[0]['full_picture']
timing = photos[0]['created_time']
acc_i = photos[0]['id'].split('_')
acc_id = acc_i[0]

headings = ['image','ahash','phash','dhash','whash','colorhash']

y = gohash(URL) #any URL
fill(y, headings, mycursor, mydb, timing, acc_id)