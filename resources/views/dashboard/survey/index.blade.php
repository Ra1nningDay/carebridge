@extends('layouts.dashboard')

@section('title', 'Survey Dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4">จัดการแบบประเมิน</h1>

    <!-- ปุ่มเพิ่มหัวข้อ -->
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addAssessmentModal">
        เพิ่มหัวข้อแบบประเมิน
    </button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อหัวข้อ</th>
                <th>คำอธิบาย</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assessments as $assessment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $assessment->name }}</td>
                <td>{{ $assessment->description }}</td>
                <td>
                    <!-- ปุ่มเปิด Modal เพิ่มคำถาม -->
                    <button 
                        class="btn btn-sm btn-secondary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#addQuestionModal-{{ $assessment->id }}">
                        เพิ่มคำถาม
                    </button>
                    <!-- ปุ่มเปิด Modal ดูคำถาม -->
                    <button 
                        class="btn btn-sm btn-info" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewQuestionsModal-{{ $assessment->id }}">
                        ดูคำถาม
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal สำหรับเพิ่มหัวข้อ -->
<div class="modal fade" id="addAssessmentModal" tabindex="-1" aria-labelledby="addAssessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('survey.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssessmentModalLabel">เพิ่มหัวข้อแบบประเมิน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อหัวข้อ</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">คำอธิบาย</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loop Modal สำหรับแต่ละหัวข้อ -->
@foreach($assessments as $assessment)
<!-- Modal สำหรับเพิ่มคำถาม -->
<div class="modal fade" id="addQuestionModal-{{ $assessment->id }}" tabindex="-1" aria-labelledby="addQuestionModalLabel-{{ $assessment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('survey.questions.store', $assessment->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel-{{ $assessment->id }}">เพิ่มคำถามใน: {{ $assessment->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question_text" class="form-label">คำถาม</label>
                        <input type="text" id="question_text" name="question_text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="question_type" class="form-label">ประเภทคำถาม</label>
                        <select id="question_type" name="question_type" class="form-select" required>
                            <option value="text">Text</option>
                            <option value="select">Select</option>
                            <option value="radio">Radio</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="options" class="form-label">ตัวเลือก (ใส่คอมม่าคั่น)</label>
                        <input type="text" id="options" name="options" class="form-control">
                        <small class="form-text text-muted">ใช้สำหรับประเภท Select หรือ Radio</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal สำหรับดูคำถาม -->
<div class="modal fade" id="viewQuestionsModal-{{ $assessment->id }}" tabindex="-1" aria-labelledby="viewQuestionsModalLabel-{{ $assessment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewQuestionsModalLabel-{{ $assessment->id }}">คำถามในหัวข้อ: {{ $assessment->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($assessment->questions->count() > 0)
                <ul class="list-group">
                    @foreach($assessment->questions as $question)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $question->question_text }}</strong><br>
                            <small>ประเภท: {{ ucfirst($question->question_type) }}</small><br>
                            @if($question->options)
                            <small>ตัวเลือก: {{ implode(', ', json_decode($question->options, true)) }}</small>
                            @endif
                        </div>
                        <div class="d-flex gap-2">
                            <!-- ปุ่มแก้ไข -->
                            <button 
                                type="button" 
                                class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editQuestionModal-{{ $question->id }}">
                                แก้ไข
                            </button>

                            <!-- ปุ่มลบ -->
                            <form method="POST" action="{{ route('survey.questions.destroy', $question->id) }}" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบคำถามนี้?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>ไม่มีคำถามในหัวข้อนี้</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

@foreach($assessment->questions as $question)
<!-- Modal สำหรับแก้ไขคำถาม -->
<div class="modal fade" id="editQuestionModal-{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel-{{ $question->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('survey.questions.update', $question->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel-{{ $question->id }}">แก้ไขคำถาม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question_text_{{ $question->id }}" class="form-label">คำถาม</label>
                        <input 
                            type="text" 
                            id="question_text_{{ $question->id }}" 
                            name="question_text" 
                            class="form-control" 
                            value="{{ $question->question_text }}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="question_type_{{ $question->id }}" class="form-label">ประเภทคำถาม</label>
                        <select id="question_type_{{ $question->id }}" name="question_type" class="form-select" required>
                            <option value="text" {{ $question->question_type === 'text' ? 'selected' : '' }}>Text</option>
                            <option value="select" {{ $question->question_type === 'select' ? 'selected' : '' }}>Select</option>
                            <option value="radio" {{ $question->question_type === 'radio' ? 'selected' : '' }}>Radio</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="options_{{ $question->id }}" class="form-label">ตัวเลือก (ใส่คอมม่าคั่น)</label>
                        <input 
                            type="text" 
                            id="options_{{ $question->id }}" 
                            name="options" 
                            class="form-control" 
                            value="{{ $question->options ? implode(', ', json_decode($question->options, true)) : '' }}">
                        <small class="form-text text-muted">ใช้สำหรับประเภท Select หรือ Radio</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@endforeach

@endsection
