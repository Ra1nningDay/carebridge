@extends('layouts.dashboard')

@section('content')
<div class="container-fluid mt-5">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-list-check me-2"></i>Evaluation Management
        </h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEvaluationTopicModal">
            <i class="bi bi-plus-circle me-1"></i> Add Topic
        </button>
    </div>

    <!-- Evaluation Topics Table -->
    <div class="table-responsive rounded shadow-sm">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($evaluationTopics as $topic)
                    <tr>
                        <td class="text-center">{{ $topic->id }}</td>
                        <td class="fw-semibold">{{ $topic->title }}</td>
                        <td>{{ $topic->description }}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editEvaluationTopicModal" 
                                    data-id="{{ $topic->id }}"
                                    data-title="{{ $topic->title }}"
                                    data-description="{{ $topic->description }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal" 
                                    data-id="{{ $topic->id }}" 
                                    data-title="{{ $topic->title }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            <i class="bi bi-info-circle me-2"></i>No topics available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Topic Modal -->
<div class="modal fade" id="addEvaluationTopicModal" tabindex="-1" aria-labelledby="addEvaluationTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('evaluations.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addEvaluationTopicModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>Add Evaluation Topic
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Topic Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter topic title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Topic</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Topic Modal -->
<div class="modal fade" id="editEvaluationTopicModal" tabindex="-1" aria-labelledby="editEvaluationTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editEvaluationTopicModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Evaluation Topic
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Topic Title</label>
                        <input type="text" name="title" id="editTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editEvaluationTopicModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');

            const form = editModal.querySelector('#editForm');
            form.action = `/evaluations/${id}`;
            editModal.querySelector('#editTitle').value = title;
            editModal.querySelector('#editDescription').value = description;
        });
    });
</script>
@endsection
