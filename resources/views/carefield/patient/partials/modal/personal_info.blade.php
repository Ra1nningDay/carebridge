<!-- Modal: ข้อมูลผู้สูงอายุ -->
<div class="modal fade" id="patientModal{{ $user->id }}" tabindex="-1" aria-labelledby="patientModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-md"></i> ข้อมูลผู้รับการตรวจ: {{ $user->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- ข้อมูลส่วนตัว -->
                <h6 class="text-primary"><i class="fas fa-user"></i> ข้อมูลพื้นฐาน</h6>
                <div class="accordion" id="personalInfoAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPersonalInfo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersonalInfo" aria-expanded="true" aria-controls="collapsePersonalInfo">
                                ผู้รับการตรวจ
                            </button>
                        </h2>
                        <div id="collapsePersonalInfo" class="accordion-collapse collapse show" aria-labelledby="headingPersonalInfo" data-bs-parent="#personalInfoAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/avatars/default-avatar.png') }}" class="rounded-circle img-fluid" alt="Patient Avatar" style="width: 120px; height: 120px;">
                                        <p class="mt-2"><strong>รหัสผู้ป่วย:</strong> {{ $user->id }}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="bg-light">ชื่อ:</th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">วันเกิด:</th>
                                                    <td>{{ $user->personalInfo->date_of_birth ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                <th class="bg-light">อายุ:</th>
                                                    <td>
                                                        @if ($user->personalInfo && $user->personalInfo->date_of_birth)
                                                            {{ \Carbon\Carbon::parse($user->personalInfo->date_of_birth)->age }} ปี
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                <th class="bg-light">เพศ:</th>
                                                    <td>
                                                        @if ($user->personalInfo && $user->personalInfo->gender)
                                                            @if ($user->personalInfo->gender === 'male')
                                                                ชาย
                                                            @elseif ($user->personalInfo->gender === 'female')
                                                                หญิง
                                                            @else
                                                                ไม่ระบุ
                                                            @endif
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">เบอร์โทร:</th>
                                                    <td>{{ $user->personalInfo->phone ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">ที่อยู่:</th>
                                                    <td>{{ $user->personalInfo->address ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">น้ำหนัก:</th>
                                                    <td>{{ $user->physicalInfo->first()->weight ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">ส่วนสูง:</th>
                                                    <td>{{ $user->physicalInfo->first()->height ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ข้อมูลผู้ดูแลที่เชื่อมโยง -->
                <h6 class="text-primary mt-4"><i class="fas fa-user-md"></i> ข้อมูลผู้ดูแล</h6>
                @if ($user->caregiver->isNotEmpty()) 
                    <div class="accordion" id="caregiverAccordion">
                        @foreach ($user->caregiver as $index => $caregiver)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCaregiver{{ $index }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCaregiver{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapseCaregiver{{ $index }}">
                                    ผู้ดูแล
                                </button>
                            </h2>
                            <div id="collapseCaregiver{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingCaregiver{{ $index }}">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <img src="{{ $caregiver->avatar ? asset($caregiver->avatar) : asset('images/avatars/default-avatar.png') }}" class="rounded-circle img-fluid" alt="Patient Avatar" style="width: 120px; height: 120px;">
                                            <p class="mt-2"><strong>รหัสผู้ดูแล:</strong> {{ $caregiver->id }}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table table-sm table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th class="bg-light">ชื่อ:</th>
                                                        <td>{{ $caregiver->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">วันเกิด:</th>
                                                        <td>{{ $caregiver->personalInfo->date_of_birth ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">อายุ:</th>
                                                        <td>
                                                            @if ($caregiver->personalInfo && $caregiver->personalInfo->date_of_birth)
                                                                {{ \Carbon\Carbon::parse($caregiver->personalInfo->date_of_birth)->age }} ปี
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">เพศ:</th>
                                                        <td>{{ $caregiver->personalInfo->gender ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">เบอร์โทร:</th>
                                                        <td>{{ $caregiver->personalInfo->phone ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">ที่อยู่:</th>
                                                        <td>{{ $caregiver->personalInfo->address ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light">น้ำหนัก:</th>
                                                        <td>{{ $caregiver->physicalInfo->first()->weight ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>    
                                                        <th class="bg-light">ส่วนสูง:</th>
                                                        <td>{{ $caregiver->physicalInfo->first()->height ?? 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">ยังไม่มีผู้ดูแลที่เชื่อมโยง</p>
                @endif

                <!-- ข้อมูลการตรวจสุขภาพ -->
                <h6 class="text-primary mt-4"><i class="fas fa-heartbeat"></i> ข้อมูลการตรวจสุขภาพ</h6>
                @if ($user->healthChecks->count() > 0)
                    <div class="accordion" id="healthCheckAccordion">
                        @foreach ($user->healthChecks as $index => $check)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingHealthCheck{{ $index }}">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHealthCheck{{ $index }}" aria-expanded="true" aria-controls="collapseHealthCheck{{ $index }}">
                                    <strong>การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $check->check_date }}</strong>
                                </button>
                            </h2>
                            <div id="collapseHealthCheck{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingHealthCheck{{ $index }}">
                                <div class="accordion-body">
                                    <div class="accordion" id="healthDetailAccordion{{ $index }}">
                                        <!-- ความดันโลหิต -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="bpHeading{{ $index }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bpCollapse{{ $index }}" aria-expanded="false" aria-controls="bpCollapse{{ $index }}">
                                                    ความดันโลหิต
                                                </button>
                                            </h2>
                                            <div id="bpCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="bpHeading{{ $index }}">
                                                <div class="accordion-body">
                                                    <p><strong>SBP:</strong> {{ $check->blood_pressure_sbp ?? 'N/A' }} mmHg</p>
                                                    <p><strong>DBP:</strong> {{ $check->blood_pressure_dbp ?? 'N/A' }} mmHg</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FPG -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="fpgHeading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fpgCollapse{{ $index }}" aria-expanded="false" aria-controls="fpgCollapse{{ $index }}">
                                                    FPG
                                                </button>
                                            </h2>
                                            <div id="fpgCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="fpgHeading{{ $index }}">
                                                <div class="accordion-body">
                                                    <p><strong>FPG:</strong> {{ $check->fpg ?? 'N/A' }} mg/dL</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- การได้ยิน -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="hearingHeading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#hearingCollapse{{ $index }}" aria-expanded="false" aria-controls="hearingCollapse{{ $index }}">
                                                    การได้ยิน
                                                </button>
                                            </h2>
                                            <div id="hearingCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="hearingHeading{{ $index }}">
                                                <div class="accordion-body">
                                                    <p><strong>หูซ้าย:</strong> {{ $check->hearing_left ?? 'N/A' }}</p>
                                                    <p><strong>หูขวา:</strong> {{ $check->hearing_right ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- กระดูกพรุน -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="boneHeading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#boneCollapse{{ $index }}" aria-expanded="false" aria-controls="boneCollapse{{ $index }}">
                                                    กระดูกพรุน
                                                </button>
                                            </h2>
                                            <div id="boneCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="boneHeading{{ $index }}">
                                                <div class="accordion-body">
                                                    <p><strong>อายุ:</strong> {{ $check->age ?? 'N/A' }} ปี</p>
                                                    <p><strong>น้ำหนักตัว:</strong> {{ $check->weight ?? 'N/A' }} กิโลกรัม</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- หมายเหตุ -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="noteHeading{{ $index }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#noteCollapse{{ $index }}" aria-expanded="false" aria-controls="noteCollapse{{ $index }}">
                                                    หมายเหตุ
                                                </button>
                                            </h2>
                                            <div id="noteCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="noteHeading{{ $index }}">
                                                <div class="accordion-body">
                                                    <p>{{ $check->blood_test_results ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted"><i class="fas fa-info-circle"></i> ยังไม่มีข้อมูลการตรวจสุขภาพ</p>
                @endif


                <!-- ปุ่มเพิ่มข้อมูล -->
                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHealthCheckModal{{ $user->id }}">
                        เพิ่มข้อมูลการตรวจสุขภาพ
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
