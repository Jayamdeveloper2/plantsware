@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>{{ $blog->title }}</h3>
                <small>Published: {{ $blog->published_at?->format('d M Y') ?? 'Draft' }}</small>
            </div>

            <div class="card-body">
                <!-- @if($blog->image)
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid mb-4" style="max-height:400px;">
                @endif -->

                @if($blog->image)
                    <img src="{{ $blog->image_url }}" 
                        alt="{{ $blog->title }}" 
                        class="img-fluid mb-4" 
                        style="max-height:200px; object-fit: cover;">
                @else
                    <div class="alert alert-info">No primary image uploaded for this blog.</div>
                @endif

                <div class="blog-content">
                    {!! $blog->content !!}   {{-- Very important: {!! !!} renders HTML --}}
                </div>

                <hr>
<!-- 
                <div>
                    <strong>Category:</strong> {{ $blog->blogCategory?->name ?? 'None' }}<br>
                    <strong>Tags:</strong> 
                    @foreach($blog->tags as $tag)
                        <span class="badge bg-info me-1">{{ $tag->name }}</span>
                    @endforeach
                </div> -->

                <hr>

                <h4>Related Blogs</h4>
                @if($related->count() > 0)
                    <ul>
                        @foreach($related as $rel)
                            <li><a href="{{ route('admin.blogs.show', $rel) }}">{{ $rel->title }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>No related blogs yet.</p>
                @endif

                <div class="mt-4">
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection