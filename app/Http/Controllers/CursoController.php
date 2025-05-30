<?php

namespace App\Http\Controllers;

use App\Tag;
use App\File;
use App\User;
use stdClass;
use App\Curso;
use App\Setting;
use App\Categoria;
use App\Inscripcion;
use App\ScriptDePago;
use App\Helpers\Utils;
use App\Constants\Messages;
use App\InscriptionPayment;
use App\Filters\CursoFilter;
use Illuminate\Http\Request;
use App\Helpers\CursoService;
use App\Helpers\CursosHelper;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Constants\FlashMessagesTypes;
use App\Repositories\CursoRepository;
use Illuminate\Support\Facades\Cache;
use App\Imports\ExcelUpdateUserImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CursoStoreRequest;
use App\Constants\MPIntegrationConstants;
use App\Http\Requests\CursoUpdateRequest;
use App\Imports\ExcelCertGeneratorImport;

class CursoController extends Controller
{

    private $cursoRepository;
    private $cursoService;

	public function __construct( 
        CursoRepository $cursoRepository,
        CursoService $cursoService
    ) {
        $this->cursoService = $cursoService;
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

        $cursoFilter = new CursoFilter($request);

        $query = request()->getQueryString();
        
        $cursos = Cache::remember("cursos_page_{$query}", now()->addMinutes(10), function () use ($cursoFilter, $categoria_id) {
            return Curso::filter($cursoFilter)
                ->whereIn('categoria_id', [$categoria_id])    
                ->orderBy('created_at', 'DESC')
                ->paginate(15)
                ->appends($cursoFilter->request->query());
        });

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
    public function store(CursoStoreRequest $request)
    {
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
        $tags = collect(Tag::all());
        $categorias = Categoria::all();
        $curso = $this->cursoRepository->getCursoByIdWithTags($curso);
        $payments = $this->getAllDataPayments($curso);
        $paymentsIndicator = $this->calculateTotalAmount($payments);
        $inscriptionsIndicator = $this->calculateTotalinscriptions($curso);    

        return view('admin.cursos.edit', compact('curso', 'tags', 'categorias', 'request', 'paymentsIndicator', 'payments', 'inscriptionsIndicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(CursoUpdateRequest $request, $curso)
    {
        $curso = $this->cursoRepository->findOrFailById($curso);

        $request->merge(array('permitir_inscripcion' => (bool) $request->permitir_inscripcion));

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

        if (count($curso->files) > 0) {
            foreach ($curso->files as $file) {
                if (!in_array($file->name, $request->input('document', []))) {
                    $file->delete();
                }
            }
        }


        $media = $curso->files->pluck('name')->toArray();
        foreach ($request->input('document', []) as $document) {
            if (count($media) === 0 || !in_array($document, $media)) {
                Storage::move('tmp/uploads/' . $document, '/public/documents/' . $document);
                
                $filename = $document;
                $ext = explode('.', $filename);
                $file = new File();
                $file->path = Storage::url('app/public/documents/'.$filename);
                $file->public_path = Storage::url('/documents/'.$filename);
                $file->extension = end($ext);
                $file->name = $filename;
                $file->save();
                $curso->files()->save($file);
            }
        }
        

        if ($curso->categoria_id == 1 || $curso->categoria_id == 2)
            return redirect('/cursos/'.$curso->id . '/edit')->with( FlashMessagesTypes::SUCCESS, Messages::UPDATED_SUCCESSFULL );
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
        $sp->titulo = $request->sp_descripcion;
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

    private function getAllDataPayments(Curso $curso)
    {   
        $inscriptionPayments = InscriptionPayment::leftJoin('inscripciones', 'inscripciones.id', '=', 'inscription_payments.inscription_id')
            ->where('inscripciones.curso_id', '=', $curso->id)
            ->where('inscripciones.estado_del_pago', '!=', Inscripcion::PENDIENTE)
            ->get();

        return $inscriptionPayments;
    }


    public function storeMedia(Request $request)
    {
        $path = storage_path('app/tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function certificatesMassiveGenerationForm($id) {
        $curso = Curso::findOrFail($id);
        $settings = Utils::getSettings();

        return view('admin.cursos.form-certificates-generation', compact('curso', 'settings'));
    }

    public function certificatesMassiveGeneration(Request $request) {

        $curso = Curso::findOrfail($request->id);
        $import = new ExcelCertGeneratorImport();
        Excel::import($import, $request->file('excel_file'));
        $dniList = $import->getData();

        // Get All Inputs Except '_Token' to loop through and save
        $settings = $request->except('_token');
        // Update All Settings
        foreach ($settings as $key => $value) {
            Setting::where('key', '=', $key)->update(['value' => $value]);
        }

        $result = $this->cursoService->generateMassiveCertificatesV2($dniList, $curso);
        Cache::flush();
        Session::flash('result', $result);
        return back()
            ->with('success', 'Archivo procesado correctamente.');
    }

    private function calculateTotalAmount($payments)  {
        $totalAmount=0;
        $netTotalAmount=0;
        foreach ($payments as $p) {    
            $totalAmount = $totalAmount + $p->amount;
            $netTotalAmount = $netTotalAmount + $p->net_received_amount;    
        }

        return [
            'totalAmount' => $totalAmount,
            'netTotalAmount' => $netTotalAmount
        ];
    }

    private function calculateTotalinscriptions(Curso $curso) : array {
        return [
            'pagado' => $curso->inscripciones()->where('estado_del_pago', Inscripcion::PAGADO)->count(),
            'pendiente' => $curso->inscripciones()->where('estado_del_pago', Inscripcion::PENDIENTE)->count(),
            'parcial' => $curso->inscripciones()->where('estado_del_pago', Inscripcion::PAGADO_PARCIAL)->count(),
        ];
    }


    // public function runExcel(Request $request) {
        
    //     $import = new ExcelUpdateUserImport();
    //     Excel::import($import, $request->file('excel_file'));
    //     $emails = $import->getData();

    //     $c=0;
    //     $failures = [];
    //     foreach ($emails as $el) {
    //         $user = User::where('email', $el->email)->first();
    //         if ($user) {
    //             $user->documento_nro = $el->dni;
    //             $user->documento_tipo = 'DNI';
    //             $user->save();
    //             $c++;
    //         } else {
    //             Log:info($el->email);
    //             array_push($failures, $el);
    //         }
    //     }
        
    //     return $failures;
    // }


    
    
}
