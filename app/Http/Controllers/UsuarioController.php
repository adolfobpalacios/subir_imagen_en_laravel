<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Image;

class UsuarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('usuario.create'); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
    public function store(Request $request) {
        \App\obras::create(
                [
                    'nombre_obra' => $request['nombre'],
                    'link_imagen' => $request['image'],
                    'descripcion' => $request['descripcion']
        ]);
        return "obra registrada";
    }*/

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
        $obras->nombre_obra = $request->input('nombre');
        //insertamos en el campo nombre_obra
        $obras->link_imagen = $file->getClientOriginalName();//insertamos en el campo link_imagen el getOriginalName() es para el nombre original doc
        $obras->descripcion = $request->input('descripcion');//insertamos en el campo descripcion 
        $obras->save(); //guardamos 
        session()->flash('flash_message', 'Todo a salido bonito');
        //return '<img src="' . $url . '" />';
        return '<img  src="'.$path.'">';
    }
    
    
    /** funciones que por separado funcionan bien
    public function store(Request $request) {  esta funcion inserta los datos en la vd
        $request->file('image')->move('uploads/');
        $filename = $request->file('image')->getClientOriginalName();

        $obras = new \App\obras();
        $obras->nombre_obra = $request->input('nombre');
        $obras->link_imagen = $filename;
        $obras->descripcion = $request->input('descripcion');
        $obras->save();
        session()->flash('flash_message', 'Todo a salido bonito');
        return back();
    }
    
      public function uploadImage()  esta funcion inserta la imagen en la carpeta del proyecto
    {
        $file = \Illuminate\Support\Facades\Input::file('image');
        $random = str_random(10);
        $nombre = $random.'-'.$file->getClientOriginalName();
        $path = public_path('uploads/'.$nombre);
        $url = '/uploads/'.$nombre;
        $image = Image::make($file->getRealPath() );
        $image ->save($path);
        
        return '<img src="'.$url.'" />';
        
        
    }
     /** 
     */

    /** 'password' => bcript($request['password'])  */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
