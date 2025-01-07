@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">รายการนัดหมาย</h2>
    
    @if($appointments->isEmpty())
        <div class="alert alert-info text-center">ยังไม่มีการนัดหมาย</div>
    @else
        <div class="row justify-content-center">
            @foreach($appointments as $appointment)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg bg-light">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-3">{{ $appointment->doctor->name }}</h5>
                                <span class="text-muted">{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <p class="card-text mb-0">
                                    <i class="fas fa-clock"></i> 
                                    {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
                                </p>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge rounded-pill 
                                    bg-{{ 
                                        $appointment->status == 'confirmed' ? 'success' :
                                        ($appointment->status == 'pending' ? 'warning' :
                                        ($appointment->status == 'canceled' ? 'danger' :
                                        ($appointment->status == 'reschedule' ? 'primary' : 'secondary'))) }} text-white">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                                <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
