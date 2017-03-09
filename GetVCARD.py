import json, requests
from  requests.exceptions import *
import serial
import time

import unicodedata

def remove_accents(input_str):
    nfkd_form = unicodedata.normalize('NFKD', input_str)
    return u"".join([c for c in nfkd_form if not unicodedata.combining(c)])


serverAddress = "http://192.168.20.3"
serverPort = "80"
searchByUIDApiUrl = "/api/getUserByUID/"
ser = serial.Serial('/dev/ttyACM0',9600,timeout=1)
UIDForSearch = ""

while True:
    #ser.write(b'RT\n')
    UIDForSearch = ""
    while UIDForSearch == "":
        UIDForSearch =  ser.readline().rstrip()
        print "waiting"

    print UIDForSearch

    try:
        UIDReq = requests.get(serverAddress + ":" + serverPort + searchByUIDApiUrl + UIDForSearch, timeout=0.1)
        #UIDReq = requests.get("http://reven.paradoxalabs.com" + searchByUIDApiUrl + UIDForSearch, timeout=1)
        if UIDReq.status_code == 201:
            print(UIDReq.json())
            fName = UIDReq.json()['usuario'][0]['nombre']
            eMail = UIDReq.json()['usuario'][0]['correo']
            pHone = UIDReq.json()['usuario'][0]['telefono']

            fName = remove_accents(fName)
            print fName
        #print eMail
        #print pHone
            
            #fName = fName.replace(u'\xa0', u' ')
            ser.write(b'VT\n')
            ser.write(fName.encode() + b'\0')
            ser.write(b'\0')
            ser.write(b'\0')
            ser.write(pHone.encode() + b'\0')
            ser.write(eMail.encode() + b'\0')
            print ser.readline()
            time.sleep(3)
        else:
            print("No existe TAG")
    
    except Timeout as e:
        print e
    except ConnectionError as e:
        print e
    except HTTPError as e:
        print e
