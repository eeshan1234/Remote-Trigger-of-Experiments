import serial
import MySQLdb
import time
ser = serial.Serial('/dev/ttyS0',115200)
db = MySQLdb.connect(host = "localhost", user = "pi", passwd = "rt", db = "mydb")
inputValue2=0
while True:
    
        #time.sleep(0.01)
        inputValue=ser.readline() 
        
        #b=inputValue.decode('latin1')
        print(inputValue)
        cur = db.cursor()
        #b=int.from_bytes(inputValue, byteorder='little',signed=True)
        #print(ser.readline())
    #execute an sql query
        #inputValue2=str(inputValue.split("*")[0
        
        #if(inputValue<>''):
         #   inputValue3=int(inputValue,30)
        t1=(inputValue)
        #if((inputValue3<-10 or inputValue3>10) and inputValue2<>inputValue3 ) :
           #print("n")
        cur.execute("INSERT IGNORE INTO encoder VALUES (%s)" %t1)
        db.commit()
           # inputValue2=inputValue3
     
    

    #sql_insert_query = """ INSERT INTO `encoder`
                        #  ( `name`) VALUES (%s)"""
    #insert_tuple = (inputValue)
   # result  = cur.execute(sql_insert_query, insert_tuple)
    #db.commit()
