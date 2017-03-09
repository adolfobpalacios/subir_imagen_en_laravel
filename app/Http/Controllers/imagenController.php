<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;  //mandamos a traer la funcion de facades para poder usar el input
use Image; //mandamos a traer la funcion image de interventional image

class imagenController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // este es el controlador chido para subir la imagen :)
    
    public function index() {
        return view('image.index');
    }

    public function store(Request $request) {

        $file = \Illuminate\Support\Facades\Input::file('image');  //obtenemos la la imagen del formulario
        $random = str_random(10);                                 //Generamos un numero aleatorio
        $nombre = $random . '-' . $file->getClientOriginalName();//el numero aleatorio lo concatenamos con el nombre
        $path = public_path('uploads/' . $nombre);              //se asigna el path a la carpeta destino concatenado con el nombre
        $url = '/uploads/' . $nombre;                          //asignamos la ruta de la imagen a la variable url
        $image = Image::make($file->getRealPath());           //usamos la funcion de intervention para abrir la imagen
        $image->save($path);                                 //guardamos la imagen

        $obras = new \App\obras();   
        $obras->artista = $request->input('artista');
        $obras->UID = $request->input('UID');//se crea una instancia del model eloquent obras
        $obras->nombre_obra = $request->input('nombre');  //insertamos en el campo nombre_obra
        $obras->link_imagen = $nombre;//insertamos en el campo link_imagen el getOriginalName() es para el nombre original doc
        $obras->descripcion = $request->input('descripcion');//insertamos en el campo descripcion 
        $obras->save(); //guardamos 
        session()->flash('flash_message', 'Todo a salido bonito');
       return '<img style="width: 500px; margin: 0 auto;"  src="'.asset($url).'">';
    }

    /**
      function uploadImage() {
      $file = \Illuminate\Support\Facades\Input::file('image');
      $random = str_random(10);
      $nombre = $random . '-' . $file->getClientOriginalName();
      $path = public_path('uploads/' . $nombre);
      $url = '/uploads/' . $nombre;
      $image = Image::make($file->getRealPath());
      $image->save($path);

      return '<img src="' . $url . '" />';
      }
     * 
     */
}
