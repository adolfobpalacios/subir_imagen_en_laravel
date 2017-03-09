#!/usr/bin/env python
# -*- coding: utf-8 -*-
 
""" 
    SimpleBrowser - Navegador muy muy simple de internet, sólo de ejemplo,
                    que utiliza la biblioteca Webkit GTK desde Python (PyWebkitGTK).
 
    Marcelo Fidel Fernández - http://www.marcelofernandez.info 
    Licencia: BSD. Disponible en: http://www.freebsd.org/copyright/license.html
"""
 
import sys
import gtk
import webkit
import serial
import thread
import json, requests
from  requests.exceptions import *
import os

os.system("sudo rfcomm connect hci0 20:15:04:27:80:19&")


DEFAULT_URL = 'http://192.168.1.12/juego2/juego2/public/admin'
uid=''
serverAddress = "http://192.168.1.12"
serverPort = "80"
searchByUIDApiUrl = "/juego2/juego2/public/prueba?UID="
urlimagen="http://192.168.1.12/juego2/juego2/public/uploads/"


class SimpleBrowser:
 
    def __init__(self):
        self.window = gtk.Window(gtk.WINDOW_TOPLEVEL)
        self.window.set_position(gtk.WIN_POS_CENTER_ALWAYS)
        self.window.connect('delete_event', self.close_application)
        self.window.set_default_size(800, 600)
 
        vbox = gtk.VBox(spacing=5)
        vbox.set_border_width(5)
 
        self.txt_url = gtk.Entry()
        self.txt_url.connect('activate', self._txt_url_activate)
 
        self.scrolled_window = gtk.ScrolledWindow()
        self.webview = webkit.WebView()
        self.scrolled_window.add(self.webview)
 
        vbox.pack_start(self.txt_url, fill=False, expand=False)
        vbox.pack_start(self.scrolled_window, fill=True, expand=True)
        self.window.add(vbox)
 
    def _txt_url_activate(self, entry):
        self._load(entry.get_text())
 
    def _load(self, url):
        self.webview.open(url)
 
    def open(self, url):
        self.txt_url.set_text(url)
        self.window.set_title('SimpleBrowser - %s' % uid)
        self._load(url)
 
    def show(self):
        self.window.show_all()
 
    def close_application(self, widget, event, data=None):
        gtk.main_quit()

def serialRead(browser):
  global uid
  while True:
    if bluetoothSerial.inWaiting() != 0:
      if uid != bluetoothSerial.readline().strip('\n'): #04439062a14880
          uid = bluetoothSerial.readline().strip('\n')
          browser.window.set_title('SimpleBrowser - %s' % uid[:-1])
          print uid
          UIDReq = requests.get(serverAddress + ":" + serverPort + searchByUIDApiUrl+uid[:-1], timeout=5)
          if UIDReq.status_code != 404:
            name = UIDReq.json()[0]['artista']
            imagen = UIDReq.json()[0]['link_imagen']
            browser._load(urlimagen+imagen)
            print name, imagen
if __name__ == '__main__':
    url = DEFAULT_URL
    # PyWebkitGTK necesita habilitar el soporte de los hilos en PyGTK
    gtk.gdk.threads_init()
    browser = SimpleBrowser()
    browser.open(url)
    browser.show()
    #try:
    bluetoothSerial = serial.Serial( "/dev/rfcomm0", baudrate=9600 )
    bluetoothSerial.flush()
    #except:
     # print "error"
    try:
      thread.start_new_thread(serialRead,(browser,))
    except:
      print "error 2"
    gtk.main()
