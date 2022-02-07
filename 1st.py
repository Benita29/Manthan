from numpy.core.fromnumeric import mean
import requests
from PIL import Image
import imagehash
import pandas as pd
import ipyplot
import numpy
import distance
import mysql.connector
from requests.api import head




#function to fill hashed data in DB
def fill(y, headings, mycursor, mydb):

    lis=[]

    for i in headings:

        a=str(y[i].values[0])
        lis.append(a)


    sql = "INSERT INTO hashes (image, ahash, phash, dhash, whash, colorhash) VALUES (%s, %s, %s, %s, %s, %s)"

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
  user="ubuntu",
  password="",
  database="temp"
)
mycursor = mydb.cursor()




headings = ['image','ahash','phash','dhash','whash','colorhash']

y = gohash('https://i.ibb.co/DLhqhpv/IMG-0011.jpg') #any URL
fill(y, headings, mycursor, mydb)