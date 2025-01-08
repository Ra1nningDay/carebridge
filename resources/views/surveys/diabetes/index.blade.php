@extends('layouts.app')

@section('title', 'แบบประเมินการคัดกรองโรคเบาหวาน')

@section('content')
<div class="container pb-5 mb-5">
    <div class="assessment-header text-center my-5">
        <h1 class="fw-bold text-primary position-relative">
            แบบประเมินการคัดกรองโรคเบาหวาน
            <span class="d-block position-absolute top-100 start-50 translate-middle w-50 border-primary border-bottom"></span>
        </h1>
        <p class="text-muted fs-5">กรุณากรอกข้อมูลและตอบคำถามเพื่อประเมินเบื้องต้น</p>
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

    <!-- Section: การให้คำแนะนำ -->
    @include('surveys.diabetes.partials.advice')

    <!-- Section: ฟอร์มส่งแบบประเมิน -->
    @include('surveys.diabetes.partials.form')
</div>

@include('layouts.footer')

<!-- Custom Styles -->
<style>
    .timeline {
        position: relative;
        margin: 2rem auto;
        padding: 2rem 0;
        max-width: 800px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .timeline-icon {
        background-color: #0d6efd;
        color: white;
        font-size: 1.5rem;
        border-radius: 50%;
        height: 50px;
        width: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 1rem;
    }

    .timeline-content {
        background-color: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card img {
        animation: bounce 1.5s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .assessment-header h1 {
        color: #0d6efd;
    }

    .assessment-header h1 span {
        display: block;
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        height: 4px;
        width: 80%;
        background-color: #0d6efd;
    }

    .advice-section {
        max-width: 900px;
        margin: 0 auto;
    }

    .assessment-form {
        max-width: 900px;
        margin: 0 auto;
    }

    .question-block h5 {
        color: #343a40;
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
@endsection
