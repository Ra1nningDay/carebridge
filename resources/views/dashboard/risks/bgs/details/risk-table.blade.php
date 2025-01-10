<div class="card shadow-lg p-4 mb-4">
    <h5 class="fw-bold text-primary">รายชื่อผู้สูงอายุที่มีความเสี่ยง</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ชื่อผู้สูงอายุ</th>
                <th>สถานะความเสี่ยง</th>
                <th>ข้อมูลเพิ่มเติม</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riskDetails as $assessment)
                <tr>
                    <td>{{ $assessment->user->name }}</td>
                    <td>
                        @if($type == 'hypertension')
                            {{ $assessment->hypertensionHealth->hypertension_status }}
                        @elseif($type == 'diabetes')
                            {{ $assessment->diabetesHealth->diabetes_status }}
                        @elseif($type == 'oralHealth')
                            {{ $assessment->oralHealth->brushing_frequency }}
                        @elseif($type == 'eyeHealth')
                            {{ $assessment->eyeHealth->has_eye_issue ? 'มีปัญหาสุขภาพตา' : 'ไม่มีปัญหา' }}
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#userModal-{{ $assessment->user->id }}">
                            ดูข้อมูล
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">ไม่มีข้อมูลผู้สูงอายุที่มีความเสี่ยงในประเภทนี้</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal: ข้อมูลผู้สูงอายุ -->
@foreach ($riskDetails as $assessment)
<div class="modal fade" id="userModal-{{ $assessment->user->id }}" tabindex="-1" aria-labelledby="userModalLabel-{{ $assessment->user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-md"></i> ข้อมูลผู้รับการตรวจ: {{ $assessment->user->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tab headers -->
                <ul class="nav nav-tabs" id="userInfoTabs{{ $assessment->user->id }}" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="personalInfoTab{{ $assessment->user->id }}" data-bs-toggle="tab" href="#personalInfo{{ $assessment->user->id }}" role="tab" aria-controls="personalInfo" aria-selected="true">ข้อมูลพื้นฐาน</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="healthInfoTab{{ $assessment->user->id }}" data-bs-toggle="tab" href="#healthInfo{{ $assessment->user->id }}" role="tab" aria-controls="healthInfo" aria-selected="false">ข้อมูลการตรวจ</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="caregiverTab{{ $assessment->user->id }}" data-bs-toggle="tab" href="#caregiver{{ $assessment->user->id }}" role="tab" aria-controls="caregiver" aria-selected="false">ผู้ดูแล</a>
                    </li>
                </ul>
                
                <!-- Tab content -->
                <div class="tab-content" id="userInfoTabsContent{{ $assessment->user->id }}">
                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade show active" id="personalInfo{{ $assessment->user->id }}" role="tabpanel" aria-labelledby="personalInfoTab{{ $assessment->user->id }}">
                        <div class="row py-4">
                            <div class="col-md-4 text-center">
                                <img src="{{ $assessment->user->avatar ? asset($assessment->user->avatar) : asset('images/avatars/default-avatar.png') }}" class="rounded-circle img-fluid" alt="Patient Avatar" style="width: 120px; height: 120px;">
                                <p class="mt-2"><strong>รหัสผู้สูงอายุ:</strong> {{ $assessment->user->id }}</p>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light">ชื่อ:</th>
                                            <td>{{ $assessment->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">วันเกิด:</th>
                                            <td>{{ $assessment->user->personalInfo->date_of_birth ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">อายุ:</th>
                                            <td>
                                                @if ($assessment->user->personalInfo && $assessment->user->personalInfo->date_of_birth)
                                                    {{ \Carbon\Carbon::parse($assessment->user->personalInfo->date_of_birth)->age }} ปี
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">เพศ:</th>
                                            <td>
                                                @if ($assessment->user->personalInfo && $assessment->user->personalInfo->gender)
                                                    {{ $assessment->user->personalInfo->gender === 'male' ? 'ชาย' : 'หญิง' }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">เบอร์โทร:</th>
                                            <td>{{ $assessment->user->personalInfo->phone ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">ที่อยู่:</th>
                                            <td>{{ $assessment->user->personalInfo->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">น้ำหนัก:</th>
                                            <td>{{ $assessment->user->physicalInfo->first()->weight ?? 'N/A' }} กก.</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">ส่วนสูง:</th>
                                            <td>{{ $assessment->user->physicalInfo->first()->height ?? 'N/A' }} ซม.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!-- เพิ่มลิงก์สำหรับการนัดแพทย์ พร้อมแนบ ID ของผู้สูงอายุ -->
                                <a href="{{ route('appointments.create', ['elderly_id' => $assessment->user->id]) }}" class="btn btn-warning">นัดหมายการตรวจ</a>
                                {{-- <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-success">รายละเอียดนัดหมาย</a> --}}
                            </div>
                        </div>
                    </div>
                    <!-- Health Information Tab -->
                    <div class="tab-pane fade" id="healthInfo{{ $assessment->user->id }}" role="tabpanel" aria-labelledby="healthInfoTab{{ $assessment->user->id }}">
                        <!-- ข้อมูลการตรวจ -->
                        <!-- คุณสามารถใส่ข้อมูลการตรวจได้ที่นี่ -->
                    </div>
                    <!-- Caregiver Information Tab -->
                    <div class="tab-pane fade" id="caregiver{{ $assessment->user->id }}" role="tabpanel" aria-labelledby="caregiverTab{{ $assessment->user->id }}">
                        <!-- ข้อมูลผู้ดูแล -->
                        <!-- คุณสามารถใส่ข้อมูลของผู้ดูแลได้ที่นี่ -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
