<section class="mb-5">
    <header class="mb-3">
        <h2 class="h5 text-danger fw-bold">
            {{ __('ลบบัญชีผู้ใช้') }}
        </h2>
        <p class="text-muted">
            {{ __('เมื่อคุณลบบัญชีผู้ใช้ ข้อมูลและทรัพยากรทั้งหมดของคุณจะถูกลบอย่างถาวร โปรดดาวน์โหลดข้อมูลที่คุณต้องการเก็บรักษาก่อนดำเนินการลบบัญชี') }}
        </p>
    </header>

    <!-- Delete Account Button -->
    <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal">
        <i class="bi bi-trash-fill me-2"></i>{{ __('ลบบัญชีผู้ใช้') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeletionModal" tabindex="-1" aria-labelledby="confirmDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeletionModalLabel">{{ __('ยืนยันการลบ') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('ปิด') }}"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark mb-3">{{ __('เมื่อคุณลบบัญชีผู้ใช้ ข้อมูลและทรัพยากรทั้งหมดของคุณจะถูกลบอย่างถาวร การดำเนินการนี้ไม่สามารถย้อนกลับได้ โปรดป้อนรหัสผ่านของคุณเพื่อยืนยัน') }}</p>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">{{ __('รหัสผ่าน') }}</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('กรุณากรอกรหัสผ่านของคุณ') }}">
                            @error('password') 
                                <span class="text-danger small">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('ยกเลิก') }}</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill me-2"></i>{{ __('ลบบัญชีผู้ใช้') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
