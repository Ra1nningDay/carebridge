<!-- Modal: ข้อมูลผู้สูงอายุ -->
<div class="modal fade" id="patientModal{{ $user->id }}" tabindex="-1" aria-labelledby="patientModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-md"></i> ข้อมูลผู้ป่วย: {{ $user->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- ข้อมูลส่วนตัว -->
                <h6 class="text-primary"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</h6>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle img-fluid" alt="Patient Avatar" style="width: 120px; height: 120px;">
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
                                    <th class="bg-light">อีเมล:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">วันเกิด:</th>
                                    <td>{{ $user->personalInfo->date_of_birth ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">เพศ:</th>
                                    <td>{{ $user->personalInfo->gender ?? 'N/A' }}</td>
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
                                    <th class="bg-light">ส่วนสูง</th>
                                    <td>{{ $user->physicalInfo->first()->height ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">น้ำหนัก</th>
                                    <td>{{ $user->physicalInfo->first()->weight ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ข้อมูลการตรวจสุขภาพ -->
                <h6 class="text-primary mt-4"><i class="fas fa-heartbeat"></i> ข้อมูลการตรวจสุขภาพ</h6>
                @if ($user->healthChecks->count() > 0)
                <div class="accordion" id="healthCheckAccordion">
                    @foreach ($user->healthChecks as $index => $check)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                <strong>การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $check->check_date }}</strong>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#healthCheckAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <!-- ความดันโลหิต -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-heartbeat text-danger"></i> ความดันตัวบน (SBP):</strong> {{ $check->blood_pressure_sbp ?? 'N/A' }} mmHg</p>
                                        <p><strong><i class="fas fa-heartbeat text-danger"></i> ความดันตัวล่าง (DBP):</strong> {{ $check->blood_pressure_dbp ?? 'N/A' }} mmHg</p>
                                        @php
                                            $pressureRisk = ($check->blood_pressure_sbp > 140 || $check->blood_pressure_dbp > 90) ? 'มีความเสี่ยง' : 'ปกติ';
                                        @endphp
                                        <p class="text-warning"><strong><i class="fas fa-exclamation-circle"></i> ความเสี่ยงความดันโลหิตสูง:</strong> {{ $pressureRisk }}</p>
                                    </div>

                                    <!-- FPG -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-syringe text-info"></i> FPG:</strong> {{ $check->fpg ?? 'N/A' }} mg/dL</p>
                                        @php
                                            $diabetesRisk = ($check->fpg > 126) ? 'มีความเสี่ยง' : 'ปกติ';
                                        @endphp
                                        <p class="text-danger"><strong><i class="fas fa-exclamation-circle"></i> เสี่ยงโรคเบาหวาน:</strong> {{ $diabetesRisk }}</p>
                                    </div>

                                    <!-- การได้ยิน -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-deaf text-info"></i> การได้ยิน หูซ้าย:</strong> {{ $check->hearing_left ?? 'N/A' }}</p>
                                        <p><strong><i class="fas fa-deaf text-info"></i> การได้ยิน หูขวา:</strong> {{ $check->hearing_right ?? 'N/A' }}</p>
                                        @php
                                            $hearingRisk = ($check->hearing_left === 'ไม่ได้ยิน' || $check->hearing_right === 'ไม่ได้ยิน') ? 'มีปัญหาการได้ยิน' : 'ปกติ';
                                        @endphp
                                        <p class="text-warning"><strong><i class="fas fa-exclamation-circle"></i> สถานะการได้ยิน:</strong> {{ $hearingRisk }}</p>
                                    </div>

                                    <!-- กระดูกพรุน -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-bone text-info"></i> อายุ:</strong> {{ $check->age ?? 'N/A' }} ปี</p>
                                        <p><strong><i class="fas fa-bone text-info"></i> น้ำหนักตัว:</strong> {{ $check->weight ?? 'N/A' }} กิโลกรัม</p>
                                        @php
                                            $ostaIndex = ($check->weight && $check->age) ? 0.2 * ($check->weight - $check->age) : 'N/A';
                                            $osteoporosisRisk = 'N/A';
                                            if ($ostaIndex !== 'N/A') {
                                                $osteoporosisRisk = ($ostaIndex < -4) ? 'สูง' : (($ostaIndex >= -4 && $ostaIndex <= -1) ? 'ปานกลาง' : 'ต่ำ');
                                            }
                                        @endphp
                                        <p><strong><i class="fas fa-calculator text-info"></i> คะแนน OSTA Index:</strong> {{ $ostaIndex }}</p>
                                        <p><strong><i class="fas fa-exclamation-circle"></i> ความเสี่ยงกระดูกพรุน:</strong> {{ $osteoporosisRisk }}</p>
                                    </div>

                                    <!-- หมายเหตุ -->
                                    <div class="col-12">
                                        <p><strong><i class="fas fa-file-alt text-primary"></i> หมายเหตุ:</strong> {{ $check->blood_test_results ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
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