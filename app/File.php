<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
	protected $table = 'files';

    public function store( $fileRequest )
    {
    	$foto = $fileRequest;
    	$originalName = $foto->getClientOriginalName();
        $extension = $foto->extension();
        $this->name = md5(date('Y-m-d H:i:s:u').$originalName);
        $this->extension = $extension;
        $this->path = $foto->storeAs('public/fotos', $this->name.'.'.$this->extension);
        $this->public_path = Storage::url($this->path);
    }

    public function notable()
    {
        return $this->morphTo();
    }

}
