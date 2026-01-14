
@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Create New Blog Post</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Title -->
                            <div class="form-group mb-3">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <!-- <div class="form-group mb-3">
                                <label>Category</label>
                                <select name="blog_category_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> -->

                            <!-- Tags (multi-select) -->
                            <div class="form-group mb-3">
                                <label>Tags (hold Ctrl/Cmd to select multiple)</label>
                                <select name="tags[]" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Content - CKEditor -->
                            <div class="form-group mb-3">
                                <label>Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror" rows="10">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="form-group mb-3">
                                <label>Excerpt (short summary)</label>
                                <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Primary Image -->
                            <div class="form-group mb-3">
                                <label>Primary Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <!-- Author -->
                            <div class="form-group mb-3">
                                <label>Author Name</label>
                                <input type="text" name="author_name" class="form-control" value="{{ old('author_name', auth()->user()->name ?? 'Admin') }}">
                            </div>

                            <!-- Published Date -->
                            <div class="form-group mb-3">
                                <label>Publish Date</label>
                                <input type="datetime-local" name="published_at" class="form-control" 
                                       value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" {{ old('is_active', 1) ? 'selected' : '' }}>Active / Published</option>
                                    <option value="0">Draft / Inactive</option>
                                </select>
                            </div>

                            <!-- SEO Fields (optional) -->
                            <div class="form-group mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Save Blog</button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
@push('scripts')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor5.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        // Custom upload adapter
        class CKUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);

                        fetch('{{ route("admin.ckeditor.upload") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.uploaded) {
                                resolve({ default: result.url });
                            } else {
                                reject(result.error || 'Upload failed');
                            }
                        })
                        .catch(error => {
                            reject(error);
                        });
                    }));
            }

            abort() {
                // Optional: handle abort
            }
        }

        // Register the adapter
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'imageUpload', 'mediaEmbed', '|',
                    'undo', 'redo'
                ],
                image: {
                    toolbar: [
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side',
                        '|',
                        'toggleImageCaption',
                        'imageTextAlternative'
                    ]
                },
                mediaEmbed: {
                    previewsInData: true
                },
                // Register custom adapter
                simpleUpload: false, // disable built-in (not supported)
                // Use our custom adapter instead
                uploadAdapter: CKUploadAdapter
            })
            .then(editor => {
                console.log('CKEditor ready with custom upload adapter!');
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });
    </script>
@endpush

@endsection