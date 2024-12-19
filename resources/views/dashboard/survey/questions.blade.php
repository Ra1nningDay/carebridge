@extends('layouts.dashboard')

@section('title', 'คำถามในหัวข้อ ' . $assessment->name)

@section('content')
<div class="container">
    <h1 class="mt-4">คำถามในหัวข้อ: {{ $assessment->name }}</h1>
    <a href="{{ route('dashboard.survey.index') }}" class="btn btn-secondary mb-4">กลับไปยังแดชบอร์ด</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>คำถาม</th>
                <th>ประเภท</th>
                <th>ตัวเลือก</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assessment->questions as $question)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $question->question_text }}</td>
                <td>{{ ucfirst($question->question_type) }}</td>
                <td>{{ $question->options ? implode(', ', json_decode($question->options, true)) : '-' }}</td>
                <td>
                    <a href="{{ route('dashboard.survey.questions.edit', $question->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
