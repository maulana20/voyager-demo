@extends('demo.layout')

@include('demo.language')
@section('content')
<table class="table">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Status</th>
    </tr>
    @foreach ($posts as $index => $post)
    @php $post = $post->translate($lang); @endphp
    <tr>
        <td>{{ $posts->firstItem() + $index }}</td>
        <td>
        {{ $post->title }}
        <div>
        @foreach ($post->tags as $tag)
            @php $query = [ 'lang' => $lang, 'tag' => $tag->id ]; @endphp
            <button type="button" class="btn btn-info btn-xs" onclick="window.open('{{ url('post?' . http_build_query($query)) }}', '_self')">{{ $tag->name }}</button>
        @endforeach
        </div>
        </td>
        @if ($post->image)
        <td><img src="{{ $post->full_image }}" width="100px"></td>
        @else
        <td>&nbsp;</td>
        @endif
        <td>{{ $post->status }}</td>
    </tr>
    @endforeach
</table>
{{ $posts->links() }}
@endsection
