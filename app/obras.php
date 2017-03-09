<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class obras extends Model {

    protected $table = "obras";
    protected $fillable = ['artista', 'UID','nombre_obra', 'link_imagen', 'descripcion'];

    public function setPathAttribute($path) 
    {
        $this->attributes['path'] = Carbon::now()->second.$path->getClientOriginalName();
        $name = Carbon::now()->second.$path->getClientOriginalName();
        \Storage::disk('local')->put($name, \File::get($path));
    }

}
