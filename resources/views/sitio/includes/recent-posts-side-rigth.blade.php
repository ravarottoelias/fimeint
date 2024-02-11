<h2 class="mu-sidebar-widget-title">Te Puede Interesar</h2>
<div class="mu-popular-content-widget mt-1">

	@php $posts=\App\Helpers\Helper::recentPosts() @endphp


	@foreach($posts as $curso)
	<div class="media">
	  <a href="{{ route('show_post', [ 'slug' => $curso->slug]) }}" class="mu-popular-post-img">
	  	<img src="{{Storage::disk('uploads')->url($curso->foto)}}" alt="image">
	  </a>
	  <div class="media-body">
		<h3 class="mb-1"><a href="{{route('show_post', $curso->slug)}}"><b>{{$curso->titulo}}</b></a></h3>
	    <ul class="mu-blog-meta mb-0">
			<li>Publicado: {{$curso->created_at->diffForHumans()}}</li>
		</ul>
		<p>{{substr($curso->descripcion, 0, 50).'...'}}</p>
	  </div>
	</div>
	@endforeach
</div>	