{{-- @extends('layouts.app')

@section('title', $assessment->name)

@section('content')
<div class="container mb-5">
    <div class="assessment-header text-center my-5">
        <h1 class="fw-bold">{{ $assessment->name }}</h1>
        <p class="text-muted fs-5">{{ $assessment->description }}</p>
    </div>
    @if (session('error'))
        <div class="toast-container position-fixed start-50 translate-middle-x p-3" style="z-index: 2000; top: 10%;">
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('survey.submit', $assessment->id) }}" class="assessment-form shadow-sm p-4 rounded bg-white">
        @csrf
        <!-- วนลูปคำถาม -->
        @foreach($assessment->questions as $index => $question)
        <div class="question-block mb-5">
            <h5 class="fw-bold mb-3">
                คำถามที่ {{ $index + 1 }}: {{ $question->question_text }}
            </h5>
            @if($question->question_type === 'select')
                <select id="question{{ $question->id }}" name="answers[{{ $question->id }}]" class="form-select form-select-lg">
                    <option value="" disabled selected>เลือกคำตอบ</option>
                    @foreach(json_decode($question->options, true) as $option)
                    <option value="{{ $loop->index }}">{{ $option }}</option>
                    @endforeach
                </select>
            @elseif($question->question_type === 'radio')
                <div class="options-group">
                    @foreach(json_decode($question->options, true) as $option)
                    <div class="form-check form-check-inline">
                        <input type="radio" id="question{{ $question->id }}_{{ $loop->index }}" name="answers[{{ $question->id }}]" value="{{ $loop->index }}" class="form-check-input">
                        <label class="form-check-label fs-5" for="question{{ $question->id }}_{{ $loop->index }}">
                            {{ $option }}
                        </label>
                    </div>
                    @endforeach
                </div>
            @elseif($question->question_type === 'text')
            <input type="text" id="question{{ $question->id }}" name="answers[{{ $question->id }}]" class="form-control form-control-lg" placeholder="พิมพ์คำตอบของคุณที่นี่">
            @endif
        </div>
        @endforeach

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                ส่งแบบประเมิน
            </button>
        </div>
    </form>
</div>

@include('layouts.footer')

<!-- Custom Styles -->
<style>
    .assessment-header h1 {
        color: #0d6efd;
    }

    .assessment-form {
        max-width: 800px;
        margin: 0 auto;
    }

    .question-block h5 {
        color: #343a40;
    }

    .options-group .form-check-label {
        cursor: pointer;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
</style>
@endsection --}}
