<section class="mb-5">
    <header class="mb-4">
        <h2 class="h5 text-dark fw-bold">
            {{ __('อัปเดตรหัสผ่าน') }}
        </h2>
        <p class="text-muted">
            {{ __('เพื่อความปลอดภัย โปรดตั้งรหัสผ่านใหม่ที่ยาวและไม่ซ้ำกับรหัสผ่านเดิม') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-4">
            <label for="current_password" class="form-label fw-semibold">
                <i class="bi bi-shield-lock-fill me-1 text-primary"></i> {{ __('รหัสผ่านปัจจุบัน') }}
            </label>
            <input id="current_password" name="current_password" type="password" 
                   class="form-control px-3 py-2" 
                   placeholder="{{ __('กรุณากรอกรหัสผ่านปัจจุบัน') }}" 
                   required>
            @error('current_password') 
                <div class="invalid-feedback d-block mt-1">
                    <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">
                <i class="bi bi-key-fill me-1 text-success"></i> {{ __('รหัสผ่านใหม่') }}
            </label>
            <input id="password" name="password" type="password" 
                   class="form-control px-3 py-2" 
                   placeholder="{{ __('กรุณากรอกรหัสผ่านใหม่') }}" 
                   required>
            <div class="form-text mt-1">
                {{ __('ควรมีความยาวอย่างน้อย 8 ตัวอักษรและมีทั้งตัวอักษรและตัวเลข') }}
            </div>
            @error('password') 
                <div class="invalid-feedback d-block mt-1">
                    <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">
                <i class="bi bi-key-fill me-1 text-warning"></i> {{ __('ยืนยันรหัสผ่านใหม่') }}
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="form-control px-3 py-2" 
                   placeholder="{{ __('กรุณายืนยันรหัสผ่านใหม่') }}" 
                   required>
            @error('password_confirmation') 
                <div class="invalid-feedback d-block mt-1">
                    <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
            <i class="bi bi-save-fill me-1"></i> {{ __('บันทึกการเปลี่ยนแปลง') }}
        </button>

        <!-- Success Message -->
        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-4 text-center" role="alert">
                <i class="bi bi-check-circle-fill me-1"></i> {{ __('เปลี่ยนรหัสผ่านสำเร็จเรียบร้อย') }}
            </div>
        @endif
    </form>
</section>
