<?php

namespace App\Http\Controllers;

use App\Tag;
use App\File;
use App\Curso;
use App\Categoria;
use App\ScriptDePago;
use App\Constants\Messages;
use Illuminate\Http\Request;
use App\Constants\FlashMessagesTypes;
use App\Repositories\CursoRepository;


class CursoController extends Controller
{

    private $cursoRepository;

	public function __construct( 
        CursoRepository $cursoRepository){

        $this->cursoRepository = $cursoRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoria_id = 1;

        $cursos = $this->cursoRepository->getCursosCategoryOfertaAcademica();

        return view('admin.cursos.index', compact('cursos', 'categoria_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $curso = new Curso;
        $tags = Tag::all();
        $categorias = Categoria::all();
        return view('admin.cursos.create', compact('curso', 'tags', 'categorias', 'request'));
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
        $curso = Curso::create($request->all());
        $curso->token = str_random(40);
        
        if ($curso->categoria_id == 2) {
            $curso->lugar = '';
            $curso->link_mp = '';
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('/', ['disk' => 'uploads']);
            $curso->foto = $foto;
        }
        
        $curso->update();

        if ($request->tags) {
            $tags = $this->findOrCreateTags($request->tags);

            $curso->tags()->attach($tags);
        }

        if ($curso->categoria_id == 1 || $curso->categoria_id == 2)
            return redirect('/cursos')->with( FlashMessagesTypes::SUCCESS, 'Actualizado correctamente.');
        if ($curso->categoria_id == 3)
            return redirect('/novedades')->with( FlashMessagesTypes::SUCCESS, 'Actualizado correctamente.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $curso)
    {
        $curso = $this->cursoRepository->getCursoByIdWithTags($curso);

        $tags = collect(Tag::all());
        $categorias = Categoria::all();

        return view('admin.cursos.edit', compact('curso', 'tags', 'categorias', 'request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $curso)
    {
        $this->validarRequest( $request );

        $curso = $this->cursoRepository->findOrFailById($curso);

        $request->merge(array('permitir_inscripcion' => $request->has('permitir_inscripcion') ? 1 : 0));

        $curso->update($request->all());

        if ($curso->categoria_id == 2) {
            $curso->lugar = '';
            $curso->link_mp = '';
            $curso->update();
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('/', ['disk' => 'uploads']);
            $curso->foto = $foto;
            $curso->update();
        }

        if ($request->tags) {
            
            $tags = $this->findOrCreateTags($request->tags);

            $curso->tags()->sync($tags);
        }

        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $f) {
                $filename = $f->store('/', ['disk' => 'uploads']);
                $file = new File;
                $file->path = $filename;
                $file->public_path = 'uploads/'.$filename;
                $file->extension = $f->extension();
                $file->name = $f->getClientOriginalName();
                $file->save();

                $curso->files()->save($file);
            }

        }

        if ($curso->categoria_id == 1 || $curso->categoria_id == 2)
            return redirect('/cursos')->with( FlashMessagesTypes::SUCCESS, Messages::UPDATED_SUCCESSFULL );
        if ($curso->categoria_id == 3)
            return redirect('/novedades')->with( FlashMessagesTypes::SUCCESS, Messages::UPDATED_SUCCESSFULL );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $curso->tags()->detach();
        $curso->delete();
        return redirect('/dashboard')->with( FlashMessagesTypes::SUCCESS, Messages::UPDATED_SUCCESSFULL );


    }

    private function validarRequest( $request )
    {
       return $this->validate($request, [
            'titulo' => 'required|string',
            'descripcion' => 'required|string'
        ]);
    }

    public function uploadFile( $file )
    {
        $foto = $file;
        $originalName = $foto->getClientOriginalName();
        $extension = $foto->extension();
        $name = md5(date('Y-m-d H:i:s:u').$originalName);
        $extension = $extension;
        $path = $foto->storeAs('public/fotos', $this->name.'.'.$this->extension);
        $public_path = Storage::url($this->path);
    }

    public function deleteFile(Request $request, File $id)
    {
        $id->delete();
        return $id;
        return back()->with( FlashMessagesTypes::SUCCESS, Messages::FILE_DELETED_SUCCESSFULL );
    }

    public function show(Request $request, $id)
    {
        return $id;
    }

    public function addScriptsDePagos(Request $request)
    {

        $sp = new ScriptDePago;
        $sp->titulo = $request->sp_titulo;
        $sp->descripcion = $request->sp_descripcion;
        $sp->script = $request->sp_script;
        $sp->curso_id = $request->curso_id;
        $sp->save();
        return $sp;
    }

    public function getScriptsDePagos(Request $request,Curso $id)
    {

        return $id->scriptsDePagos()->get();
    }

    public function deleteScriptsDePagos(Request $request, $id)
    {
        $sp = ScriptDePago::findOrFail($id);
        $sp->delete();
        return;
    }

    private function findOrCreateTags($tags)
    {
        $arrayOfTags = [];
        foreach ($tags as $tag) {
            $t = Tag::where('nombre', $tag)->first();
            if (!$t) {
                $t = new Tag;
                $t->nombre = $tag;
                $t->save();
            }
            array_push($arrayOfTags, $t->id);
        }

        return $arrayOfTags;;
    }
    
    
}
