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
    @foreach ($pages as $index => $page)
    @php $page = $page->translate($lang); @endphp
    <tr>
        <td>{{ $pages->firstItem() + $index }}</td>
        <td>
        {{ $page->title }}
        <div>
        @foreach ($page->tags as $tag)
            @php $query = [ 'lang' => $lang, 'tag' => $tag->id ]; @endphp
            <button type="button" class="btn btn-info btn-xs" onclick="window.open('{{ url('page?' . http_build_query($query)) }}', '_self')">{{ $tag->name }}</button>
        @endforeach
        </div>
        </td>
        @if ($page->image)
        <td><img src="{{ $page->full_image }}" width="100px"></td>
        @else
        <td>&nbsp;</td>
        @endif
        <td>{{ $page->status }}</td>
    </tr>
    @endforeach
</table>
{{ $pages->links() }}
@endsection
