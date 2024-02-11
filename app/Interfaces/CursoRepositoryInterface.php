<?php

namespace App\Interfaces;

interface CursoRepositoryInterface 
{
    public function getCursoBySlug($slug);
    public function findOrFailById($cursoId);
    public function findCursosEnCurso($limit = 5);
    public function findCursosWhereTags($tags = null);
    public function findCursoByStatus($status);
    public function getCursosCategoryOfertaAcademica();
    public function getCursoByIdWithTags($cursoId);
}