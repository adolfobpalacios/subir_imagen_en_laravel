#! /usr/bin/python

#sudo rfcomm connect hci0 20:15:04:27:80:19

import serial
import thread

def serialRead():
  while True:
    if bluetoothSerial.inWaiting() != 0:
      uid = bluetoothSerial.readline()
      print uid
try:
  bluetoothSerial = serial.Serial( "/dev/rfcomm0", 9600 )
  bluetoothSerial.flush()
except:
  print "error"
try:
  thread.start_new_thread(serialRead,())
except:
  print "error 2"
while True:
  pass
