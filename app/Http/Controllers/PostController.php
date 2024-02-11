<?php

namespace App\Http\Controllers;

use App\Tag;
use App\File;
use App\Post;
use App\Categoria;
use Illuminate\Http\Request;
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
            $filename = $request->file('foto')->store('/', ['disk' => 'uploads']);
            $file = new File;
            $file->path = $filename;
            $file->public_path = 'uploads/'.$filename;
            $file->extension = $request->file('foto')->extension();
            $file->name = $request->file('foto')->getClientOriginalName();
            $file->save();

            $post->portada()->save($file);
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
            $filename = $request->file('foto')->store('/', ['disk' => 'uploads']);
            $file = new File;
            $file->path = $filename;
            $file->public_path = 'uploads/'.$filename;
            $file->extension = $request->file('foto')->extension();
            $file->name = $request->file('foto')->getClientOriginalName();
            $file->save();

            $post->portada()->save($file);
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

        if ($post->portada != null)
            Storage::disk('uploads')->delete($post->portada->path);
        
        $post->portada->delete();

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
        ]);
    }

}
