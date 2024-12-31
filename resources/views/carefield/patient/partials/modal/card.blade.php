{{-- Modal Card: ผู้สูงอายุ --}}
<div class="col-md-4">
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
            <h5 class="card-title"><strong>ผู้รับการตรวจ:</strong> {{ $user->id }}</h5>
            <p class="card-text fs-5"><strong>ชื่อ:</strong> {{ $user->name }}</p>
            <p class="card-text"><strong>วันเกิด:</strong> {{ $user->personalInfo->date_of_birth ?? 'N/A' }}</p>
            <p class="card-text"><strong>วันที่ตรวจล่าสุด:</strong> 
                {{ optional($user->healthChecks->sortByDesc('check_date')->first())->check_date ?? 'N/A' }}
            </p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal{{ $user->id }}">
                ดูข้อมูล
            </button>
        </div>
    </div>
</div>