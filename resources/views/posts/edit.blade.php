@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-header bg-primary text-white text-center" style="border-radius: 12px 12px 0 0;">
                    <h2>Edit Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title input -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control rounded" value="{{ $post->title }}" placeholder="Enter post title" required>
                        </div>

                        <!-- Body input with Quill -->
                        <div class="form-group mb-4">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <div id="editor-container" style="min-height: 200px; border: 1px solid #ddd; border-radius: 5px;">{!! old('content', $post->content) !!}</div>
                            <textarea id="content" name="content" class="d-none">{!! old('content', $post->content) !!}</textarea>
                        </div>

                        <!-- Image upload -->
                        <div class="form-group mb-4">
                            <label for="image" class="form-label fw-bold">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                            <!-- Display current image if exists -->
                            <div class="mt-3" id="imagePreview">
                                @if($post->image)
                                    <p class="mb-2">Current Image:</p>
                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow-sm" style="max-width: 200px;">
                                @endif
                            </div>

                            @if($post->image)
                                <div class="form-check mt-3">
                                    <input type="checkbox" name="remove_image" class="form-check-input" id="removeImage">
                                    <label for="removeImage" class="form-check-label">Remove current image</label>
                                </div>
                            @endif
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success btn-lg px-4">Update Post</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-lg px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Write your content here...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], // ตัวหนา ตัวเอียง ขีดเส้นใต้ ขีดฆ่า
                [{ 'header': [1, 2, 3, false] }], // หัวข้อ
                [{ 'list': 'ordered' }, { 'list': 'bullet' }], // ลิสต์
                ['link', 'image'], // ลิงก์และรูปภาพ
                ['clean'] // ล้างรูปแบบ
            ]
        },
    });

    // Sync Quill content with the hidden textarea
    const contentTextarea = document.getElementById('content');
    quill.on('text-change', function () {
        contentTextarea.value = quill.root.innerHTML; // ดึงเนื้อหา HTML จาก Quill
    });
});
</script>

<style>
    #editor-container {
        min-height: 200px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    #editor-container:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
</style>
@endsection
