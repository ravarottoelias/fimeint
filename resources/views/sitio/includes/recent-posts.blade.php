@php $cursos = \App\Helpers\Helper::recentPosts() @endphp
@if(sizeof($cursos)>0)
<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="mu-from-blog-area">
			<!-- Title -->
			<div class="row">
				<div class="col-md-12">
					<div class="mu-title">
						<h2>Recientes</h2>
						<p>Actividades que podrían interesarte</p>
					</div>
				</div>
				<div class="col-md-12">
					<div class="mu-from-blog-content">
						<div class="row">
							@forelse( $cursos as $curso )
							<div class="col-md-4 mb-4">
								<article class="card mu-blog-item">
									<a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}"><img src="{{Storage::disk('uploads')->url($curso->foto)}}" alt="blgo image"></a>
									<div class="card-body">
										<div class="mu-blog-item-content">
											<ul class="mu-blog-meta">
												<li class="text-muted"><i class="far fa-calendar-alt"></i> Publicado: {{$curso->created_at}}</li>
											</ul>
											<h2 class="mu-blog-item-title"><a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}">{{$curso->titulo}}</a></h2>
											<p>{{substr($curso->descripcion, 0, 150)}} ...</p>
										</div>
									</div>
									<div class="card-body">
									    <a href="{{ route('curso_inscription', $curso->slug) }}" class="card-link btn btn-primary">Quiero inscribirme</a>
									    <a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" class="card-link">Leer más</a>
  									</div>
								</article>
							</div>
							@empty

							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="w-100 text-center mt-5">
	<a href="{{route('all_posts')}}?categoria=oferta-academica" class="mu-primary-btn">Ver todos</a>
</div>
</div>
@endif