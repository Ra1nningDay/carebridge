{{-- Modal Card: ผู้สูงอายุ --}}
<div class="col-md-4">
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
            <h5 class="card-title"><strong>ผู้รับการตรวจ:</strong> {{ $user->id }}</h5>
            <p class="card-text fs-5"><strong>ชื่อ:</strong> {{ $user->name }}</p>
            <p class="card-text">
                <strong>วันเกิด:</strong>
                {{-- แสดงวัน/เดือน/ปี ค.ศ. --}}
                {{ \Carbon\Carbon::parse($user->personalInfo->date_of_birth ?? '0000-00-00')->locale('th')->isoFormat('D MMMM') }}
                {{-- เปลี่ยนปีให้เป็น พ.ศ. --}}
                พ.ศ.{{ \Carbon\Carbon::parse($user->personalInfo->date_of_birth ?? '0000-00-00')->addYears(543)->isoFormat('YYYY') }}
            </p>
            <p class="card-text"><strong>วันที่ตรวจล่าสุด:</strong> 
                @if ($user->healthChecks->count() > 0)
                    {{-- แสดงวัน/เดือน/ปี ค.ศ. --}}
                    {{ \Carbon\Carbon::parse($user->healthChecks->sortByDesc('check_date')->first()->check_date)->locale('th')->isoFormat('D MMMM') }}
                    {{-- เปลี่ยนปีให้เป็น พ.ศ. --}}
                    พ.ศ.{{ \Carbon\Carbon::parse($user->healthChecks->sortByDesc('check_date')->first()->check_date)->addYears(543)->isoFormat('YYYY') }}
                @else
                    N/A
                @endif
            </p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal{{ $user->id }}">
                ดูข้อมูล
            </button>
        </div>
    </div>
</div>

