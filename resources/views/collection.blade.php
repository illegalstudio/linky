<ul>
@foreach($collection->contents as $content )
    <li><a href="/{{ $content->slug }}">{{ $content->name }}</a></li>
@endforeach
</ul>
