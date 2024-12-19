@extends('layouts.app')

@section('title', 'Create Forum')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="p-4 shadow-sm bg-white rounded-3">
                <h4 class="mb-4 fs-4 text-center fw-bold">Create Forum</h4>
                <form class="form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-floating mb-3">
                        <input class="form-control rounded-4" type="text" id="title" name="title" placeholder="Title" required>
                        <label for="title">Title</label>
                    </div>

                    <!-- Content with Quill Editor -->
                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Content</label>
                        <div id="editor-container" style="min-height: 200px; border: 1px solid #ddd; border-radius: 5px;"></div>
                        <textarea id="content" name="content" class="d-none"></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary rounded-4 px-4" id="submitBtn" type="submit">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quill = new Quill('#editor-container', {
            theme: 'snow', // ใช้ธีม Snow
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

<!-- Custom Styles -->
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
