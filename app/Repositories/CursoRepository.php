<?php

namespace App\Repositories;

use App\Curso;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CursoRepositoryInterface;

class CursoRepository implements CursoRepositoryInterface 
{

    public function getCursoBySlug($slug) 
    {
        return Curso::where('slug', $slug)->firstOrFail();
    }
    
    public function findOrFailById($cursoId) 
    {
        return Curso::findOrFail($cursoId);
    }
    
    public function findCursosEnCurso($limit = 5) 
    {
        $en_curso = Curso::ESTADO_EN_CURSO;
        
        return Curso::where('estado', $en_curso)->orderBy('created_at', 'desc')->get();
    }
    
    public function findCursosWhereTags($tag = null) 
    {
        $cursos = Curso::where('publicado', Curso::PUBLICADO)
        ->whereHas('tags', function($query) use ($tag) {
            $query->where('slug', $tag);
        })
        ->orderBy('created_at', 'DESC')
        ->get();

        return $cursos;
    }

    public function findCursoByStatus($status)
    {
        return Curso::where('estado', $status)
                         ->orderBy('created_at', 'DESC')
                         ->get();
    }

    public function getCursosCategoryOfertaAcademica()
    {
        return $cursos = Curso::whereIn('categoria_id', [1])
        ->orderBy('created_at', 'DESC')
        ->get();
    }
    
    public function getCursoByIdWithTags($cursoId)
    {
        return Curso::where('id', $cursoId)->with(['tags'])->first();
    }
}