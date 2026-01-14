@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Edit Blog Post: {{ $blog->title }}</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Main content column -->
                        <div class="col-md-8">

                            <!-- Title -->
                            <div class="form-group mb-3">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $blog->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tags (multi-select) -->
                            <div class="form-group mb-3">
                                <label>Tags (hold Ctrl/Cmd to select multiple)</label>
                                <select name="tags[]" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ $blog->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Content - CKEditor -->
                            <div class="form-group mb-3">
                                <label>Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror" rows="10">
                                    {{ old('content', $blog->content) }}
                                </textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="form-group mb-3">
                                <label>Excerpt (short summary - optional)</label>
                                <textarea name="excerpt" class="form-control" rows="3">
                                    {{ old('excerpt', $blog->excerpt) }}
                                </textarea>
                            </div>
                        </div>

                        <!-- Sidebar column -->
                        <div class="col-md-4">

                            <!-- Current Primary Image + Replace -->
                            <div class="form-group mb-4">
                                <label>Primary Image</label>
                                @if($blog->image)
                                    <div class="mb-2">
                                        <img src="{{ $blog->image_url }}" alt="Current blog image"
                                             class="img-thumbnail" style="max-width: 100%; max-height: 250px;">
                                        <small class="d-block text-muted mt-1">Current image</small>
                                    </div>
                                @else
                                    <p class="text-muted">No image uploaded yet</p>
                                @endif

                                <input type="file" name="image" class="form-control mt-2" accept="image/*">
                                <small class="form-text text-muted">Upload new image to replace the current one (jpg, png, max 2MB)</small>
                            </div>

                            <!-- Author -->
                            <div class="form-group mb-3">
                                <label>Author Name</label>
                                <input type="text" name="author_name" class="form-control"
                                       value="{{ old('author_name', $blog->author_name ?? 'Admin') }}">
                            </div>

                            <!-- Published Date -->
                            <div class="form-group mb-3">
                                <label>Publish Date</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                       value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" {{ old('is_active', $blog->is_active) ? 'selected' : '' }}>
                                        Active / Published
                                    </option>
                                    <option value="0" {{ !old('is_active', $blog->is_active) ? 'selected' : '' }}>
                                        Draft / Inactive
                                    </option>
                                </select>
                            </div>

                            <!-- SEO Fields -->
                            <div class="form-group mb-3">
                                <label>Meta Title (optional)</label>
                                <input type="text" name="meta_title" class="form-control"
                                       value="{{ old('meta_title', $blog->meta_title) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Meta Description (optional)</label>
                                <textarea name="meta_description" class="form-control" rows="3">
                                    {{ old('meta_description', $blog->meta_description) }}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            Update Blog
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-lg ms-3">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor5.css">
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

        <script>
            // Custom Upload Adapter (proven from your CodeIgniter reference)
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file.then(file => new Promise((resolve, reject) => {
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
                            if (result.url) {
                                resolve({ default: result.url });
                            } else {
                                reject(result.error || 'Upload failed');
                            }
                        })
                        .catch(error => reject(error));
                    }));
                }

                abort() {}
            }

            // Register the custom adapter
            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader);
            }

            ClassicEditor
                .create(document.querySelector('#editor'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'alignment', '|',
                        'blockQuote', 'insertTable', '|',
                        'imageUpload', 'mediaEmbed', '|',
                        'undo', 'redo'
                    ],
                    image: {
                        toolbar: [
                            'imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
                        ]
                    },
                    mediaEmbed: {
                        previewsInData: true
                    },
                    pasteFromOffice: {
                        removeStyles: false
                    }
                })
                .then(editor => {
                    console.log('CKEditor ready with custom image upload!');
                })
                .catch(error => {
                    console.error('CKEditor error:', error);
                });
        </script>
    @endpush
@endsection