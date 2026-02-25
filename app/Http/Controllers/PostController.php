<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\File;
use App\Post;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Categoria::where('slug', $request->category)->firstOrFail();

        $posts = Post::where('categoria_id', $category->id)->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $categorias = Categoria::all();
        return view('admin.posts.create', compact('post', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validarRequest( $request );
        
        $post = Post::create($request->all());

        if ($request->hasFile('foto')) {
            foreach($request->file('foto') as $element){
                $file = $this->guardarPortada($element);
    
                $post->portadas()->save($file);
            }
        }

         return redirect('post_admin?category=' . $post->categoria->slug)->with('success', 'Creado correctamente.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrfail($id);

        $categorias = Categoria::all();

        return view('admin.posts.edit', compact('post', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validarRequest( $request );
        
        $post = Post::findOrfail($id);
        
        $post->update($request->all());

        if ($request->hasFile('foto')) {
            $post->portadas()->each(function ($portada) {
                Storage::disk('uploads')->delete($portada->path);
                $portada->delete();
            });
            foreach($request->file('foto') as $element){

                $file = $this->guardarPortada($element);
    
                $post->portadas()->save($file);

            }

        }

        return back()->with('success', 'Guardado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);


        $post->portadas()->each(function ($portada) use ($post) {
            try{
                Storage::disk('uploads')->delete($portada->path);
            } catch (Exception $e) {
                Log::warning('Archivo no encontrado al intentar eliminar portada.', [
                'post_id' => $post->id,
                'file_path' => $portada->path
            ]);
            }
            $portada->delete();
        });

        $post->delete();

        return back()->with('success', 'Eliminado correctamente.');
    }

    private function validarRequest( $request )
    {
       return $this->validate($request, [
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'categoria_id' => 'required',
            'status' => 'required',
            'foto'          => 'nullable|array|max:2',
            'foto.*'        => 'image|mimes:jpg,jpeg,png,webp',
        ]);
    }

    private function guardarPortada($element) : File {
        $filename = $element->store('/', ['disk' => 'uploads']);
        $file = new File;
        $file->path = $filename;
        $file->public_path = 'uploads/'.$filename;
        $file->extension = $element->extension();
        $file->name = $element->getClientOriginalName();
        $file->save();

        return $file;

    }

}
