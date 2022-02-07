import requests
from PIL import Image
import imagehash
import pandas as pd
import mysql.connector




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




def makelist(y, headings):

    lis=[]

    for i in headings:

        a=str(y[i].values[0])
        lis.append(a)
    
    return(lis)




def hammingDist(str1, str2):
    i = 0
    count = 0
 
    while(i < len(str1)):
        if(str1[i] != str2[i]):
            count += 1
        i += 1
    return count





mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="Music$$24",
  database="rootrack"
)
mycursor = mydb.cursor()




headings = ['image','ahash','phash','dhash','whash','colorhash']





q_img = input("URL of image to be analyzed: ")
q_hashed = gohash(q_img)
q_list = makelist(q_hashed, headings)




mycursor.execute("SELECT * FROM hashes")
myresult = mycursor.fetchall()
#print(myresult)



break_flag = 0


for x in myresult:

    for i in range(2,7):

        hd = hammingDist(q_list[i-1], x[i])

        if (hd <= 3):
            print("\n User Account = ",x[0])
            print("\n URL = ", x[1], "is a match")
            break_flag=1
            break
        
    if(break_flag == 1):
        break

if(break_flag == 0):
    print("There is no match in the Database")