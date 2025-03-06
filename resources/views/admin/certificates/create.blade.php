@extends('admin.layout')

@section('content')

<h1 class="mt-4">Certificados</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('certificates') }}">Certificados</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
</ol>
@include('admin.includes.flashmessage')

<div class="card">
	<div class="card-body">
        
        <form action="{{ route('certificates_store') }}" method="POST" novalidate="novalidate">
            {{ csrf_field() }}
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Alumno</label>
                <div class="col-sm-10 col-md-8">
                  <select class="student-select2 form-control" name="alumnoId"></select>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cursos</label>
                <div class="col-sm-10 col-md-8">
                    <select class="iscription-select2 form-control" name="inscripcionId"></select>     
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Generar</button>
        </form>
       
	</div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function() {

        const getStudentInscriptions = async (studentId) => {
            try {
                return axios.get('/dashboard/api/inscriptions/' + studentId + '/student');
            } catch (error) {
                alert('Error inesperado. ' + error)
            }
        };
        
        let inscriptions = [];

        let ajaxStudent = {
                url: '/dashboard/api/students',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };  
                },
                cache: true
        };
        $('.student-select2').select2({width: 'resolve', theme: 'bootstrap', ajax: ajaxStudent})
            .on('select2:select', async function (e) {
                const studentId = e.params.data.id;
                let inscriptionsResponse = await getStudentInscriptions(studentId);
                console.log(inscriptions)
                inscriptions = inscriptionsResponse.data.map(function (item){
                    return {
                        text: item.curso.titulo + ' - ' + item.created_at,
                        id: item.id
                    }
                })
                $('.iscription-select2').select2({width: 'resolve', theme: 'bootstrap', data: inscriptions});
            });
});
</script>
@stop
