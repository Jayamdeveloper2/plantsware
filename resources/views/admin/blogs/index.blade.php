@extends('admin.layout')   {{-- Change to your actual admin layout --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Blogs</h3>

                        <div class="card-tools">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create New Blog
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Search Form --}}
                        <form method="GET" action="{{ route('admin.blogs.index') }}" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search by title..." 
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <!-- <th>Category</th> -->
                                    <th>Author</th>
                                    <th>Published</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <!-- <td>{{ $blog->blogCategory?->name ?? '—' }}</td> -->
                                        <td>{{ $blog->author_name ?? 'Admin' }}</td>
                                        <td>{{ $blog->published_at?->format('d M Y') ?? 'Draft' }}</td>
                                        <td>
                                            @if($blog->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No blogs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $blogs->links() }}  {{-- Pagination --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection