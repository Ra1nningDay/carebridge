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
                            {{-- ชื่อแพทย์และวันที่นัดหมาย --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0 text-truncate">
                                    แพทย์: {{ $appointment->doctor->name ?? 'ไม่พบข้อมูลแพทย์' }}
                                </h5>
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('d M Y') ?? 'N/A' }}
                                </span>
                            </div>

                            {{-- เวลาและผู้สูงอายุ --}}
                            <p class="mb-1"><strong>เวลา:</strong> 
                                {{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('H:i') ?? 'N/A' }}
                            </p>
                            <p class="mb-1"><strong>ผู้สูงอายุ:</strong> 
                                {{ $appointment->elderly->name ?? 'ไม่พบข้อมูลผู้สูงอายุ' }}
                            </p>

                            {{-- ข้อมูลผู้ดูแล --}}
                            <p class="mb-3"><strong>ผู้ดูแล:</strong> 
                                {{ $appointment->caregiver->name ?? 'ไม่พบข้อมูลผู้ดูแล' }}
                            </p>

                            {{-- สถานะ --}}
                            <div class="mb-3">
                                <span class="badge rounded-pill 
                                    bg-{{
                                        $appointment->status == 'confirmed' ? 'success' : 
                                        ($appointment->status == 'pending' ? 'warning' : 
                                        ($appointment->status == 'canceled' ? 'danger' : 'secondary'))
                                    }} text-white">
                                    {{
                                        $appointment->status == 'confirmed' ? 'ยืนยันแล้ว' : 
                                        ($appointment->status == 'pending' ? 'กำลังรอการยืนยัน' : 
                                        ($appointment->status == 'canceled' ? 'ยกเลิกการนัดหมาย' : 'ไม่ทราบสถานะ'))
                                    }}
                                </span>
                            </div>

                            {{-- ฟังก์ชันแชท --}}
                            <div class="mb-3">
                                @php
                                    // ค้นหาการสนทนาระหว่างผู้ใช้และผู้ที่เกี่ยวข้อง
                                    $conversation = \App\Models\Conversation::whereHas('users', function ($query) {
                                        $query->where('users.id', auth()->id());
                                    })->whereHas('users', function ($query) use ($appointment) {
                                        // ถ้ามีการเชื่อมโยงกับผู้สูงอายุหรือผู้ดูแลหรือแพทย์
                                        $query->where('users.id', $appointment->elderly_id)
                                              ->orWhere('users.id', $appointment->caregiver_id)
                                              ->orWhere('users.id', $appointment->doctor_id);
                                    })->first();
                                @endphp

                                {{-- เช็คสถานะและเวลานัดหมาย --}}
                                @if($appointment->status == 'confirmed' && $appointment->scheduled_at && \Carbon\Carbon::parse($appointment->scheduled_at)->isPast())
                                    @if(
                                        // ตรวจสอบว่าเป็นผู้สูงอายุ, ผู้ดูแล, หรือแพทย์ที่เกี่ยวข้อง
                                        ($appointment->elderly_id == auth()->id() || $appointment->caregiver_id == auth()->id() || $appointment->doctor_id == auth()->id())
                                    )
                                        {{-- เช็คว่าเป็นการสนทนากลุ่มที่มีอยู่แล้วหรือไม่ ถ้าไม่มีให้สร้างใหม่ --}}
                                        @if($conversation)
                                            <a href="{{ route('chat.show', $conversation->id) }}" class="btn btn-primary">เข้าสู่การแชท</a>
                                        @else
                                            {{-- สร้างการสนทนาใหม่โดยรวมผู้ที่เกี่ยวข้องทั้งหมด --}}
                                            <a href="{{ route('chat.start', ['appointmentId' => $appointment->id]) }}" class="btn btn-primary">เริ่มการสนทนากลุ่ม</a>
                                        @endif
                                    @else
                                        <p>คุณไม่มีสิทธิ์เริ่มการสนทนากับผู้ที่เกี่ยวข้องในตอนนี้</p>
                                    @endif
                                @elseif($appointment->status == 'confirmed' && $appointment->scheduled_at && \Carbon\Carbon::parse($appointment->scheduled_at)->isFuture())
                                    <p>กรุณารอถึงเวลานัดหมายก่อนถึงจะสามารถเริ่มแชทได้</p>
                                @elseif($appointment->status != 'confirmed')
                                    <p>การนัดหมายยังไม่ยืนยัน</p>
                                @endif


                            </div>

                            {{-- ฟังก์ชันตามบทบาท --}}
                            <div class="d-flex justify-content-between">
                                {{-- สำหรับแพทย์ --}}
                                @if(auth()->user()->roles->contains('name', 'admin') && $appointment->doctor_id == auth()->id())
                                    <a href="{{ route('appointments.show', $appointment->id) }}" 
                                    class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                    <a href="{{ route('appointments.create', ['elderly_id' => $appointment->elderly_id]) }}" 
                                    class="btn btn-outline-success btn-sm">สร้างนัดหมายใหม่</a>
                                @endif

                                {{-- สำหรับผู้ดูแล --}}
                                @if(auth()->user()->roles->contains('name', 'caregiver') && $appointment->caregiver_id == auth()->id())
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                    @if($appointment->status == 'pending') 
                                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-outline-success btn-sm">ยืนยัน</button>
                                        </form>
                                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="d-inline-block ms-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="canceled">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">ปฏิเสธ</button>
                                        </form>
                                    @endif
                                @endif

                                {{-- สำหรับผู้สูงอายุ --}}
                                @if(auth()->user()->roles->contains('name', 'patient') && $appointment->elderly_id == auth()->id())
                                    <a href="{{ route('appointments.show', $appointment->id) }}" 
                                    class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
