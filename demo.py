import time
import mysql.connector

mydb = mysql.connector.connect(
  host="sql712.main-hosting.eu",
  user="u538522988_babycare",
  password="u538522988_babycare",
  database="Nr@Y7XT:6P7"

)

mycursor = mydb.cursor()

freq = [120, 122, 130, 110, 120, 125]
temp = [36.5, 36.6, 36.7, 37, 36.5, 36.4]

for x in range(0, len(freq)):
    sql = "INSERT INTO data (idCapteur, nom, valeur) VALUES (%.2f, %s, %.2f)"
    val = (21, "Température", temp[x])
    mycursor.execute(sql, val)  
    mydb.commit()
    print(mycursor.rowcount, "record inserted.")
    
    sql = "INSERT INTO data (idCapteur, nom, valeur) VALUES (%.2f, %s, %.2f)"
    val = (20, "Fréquence cardiaque", freq[x])
    mycursor.execute(sql, val)  
    mydb.commit()
    print(mycursor.rowcount, "record inserted.")

    time.sleep(10)


