<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at', 'DESC')->get();
        return view('admin.files.index', compact('files'));
    }

    public function uploadFiles(Request $request)
    {
        if($request->hasFile('file')) {
            $f = $request->file('file');
            $file = new File;
            $filename = $f->store('/', ['disk' => 'uploads']);
            $file->path = $filename;
            $file->public_path = 'uploads/'.$filename;
            $file->extension = $f->extension();
            $file->name = $f->getClientOriginalName();

            if ($request->notable_type) {
                $file->notable_type = $request->notable_type;
                $file->notable_id = $request->notable_id;
            }
            
            $file->save();
            
            return $file;
        }
    }

    
}
