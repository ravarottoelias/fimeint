<!-- start Single Widget -->
<div class="mu-sidebar-widget">
	<h2 class="mu-sidebar-widget-title">Tags</h2>
	<div class="mu-tags">
		@foreach(\App\Helpers\Helper::getTags() as $tag)
		<a href="{{route('all_posts')}}?tag={{$tag->slug}}">{{$tag->nombre}}</a>
		@endforeach
	</div>
</div>
<!-- End single widget -->