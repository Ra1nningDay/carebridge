<section class="mb-5">
    <header class="mb-4">
        <h2 class="h5 text-dark fw-bold">
            {{ __('ข้อมูลโปรไฟล์') }}
        </h2>
        <p class="text-muted">
            {{ __("อัปเดตข้อมูลโปรไฟล์ รูปภาพ และอีเมลของบัญชีคุณ.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('patch')
        
        <!-- Profile Picture -->
        <div class="mb-4 text-center">
            <label for="avatar" class="form-label fw-semibold d-block">{{ __('รูปโปรไฟล์') }}</label>
            <div class="position-relative d-inline-block">
                <img class="rounded-circle border" id="avatarPreview" src="{{ $user->avatar_url }}" width="120" height="120" alt="User Avatar">
                <label for="avatar" class="btn btn-outline-primary btn-sm position-absolute bottom-0 end-0 rounded-pill">
                    <i class="bi bi-camera"></i> {{ __('เปลี่ยนรูป') }}
                </label>
                <input id="avatar" name="avatar" type="file" class="form-control d-none" onchange="previewAvatar(event)">
            </div>
            <div class="form-text mt-2">{{ __('อัปโหลดรูปภาพใหม่เพื่อเปลี่ยนรูปโปรไฟล์.') }}</div>
            @error('avatar') 
                <span class="text-danger small d-block mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> 
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">{{ __('ชื่อ') }}</label>
            <input id="name" name="name" type="text" class="form-control px-3 py-2" value="{{ old('name', $user->name) }}" required placeholder="กรอกชื่อเต็ม">
            @error('name') 
                <span class="text-danger small"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> 
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">{{ __('อีเมล') }}</label>
            <input id="email" name="email" type="email" class="form-control px-3 py-2" value="{{ old('email', $user->email) }}" required placeholder="example@domain.com">
            @error('email') 
                <span class="text-danger small"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> 
            @enderror

            <!-- Email Verification -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="small text-muted mt-2">
                    {{ __('อีเมลของคุณยังไม่ได้รับการยืนยัน.') }}
                    <button form="send-verification" class="btn btn-link p-0 text-primary fw-bold">{{ __('คลิกที่นี่เพื่อส่งลิงก์ยืนยันอีกครั้ง.') }}</button>
                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success small mt-2">{{ __('ลิงก์ยืนยันใหม่ได้ถูกส่งไปยังอีเมลของคุณแล้ว.') }}</div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <button type="reset" class="btn btn-outline-secondary rounded-pill px-4 py-2">{{ __('รีเซ็ต') }}</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">{{ __('บันทึก') }}</button>
        </div>

        <!-- Success Message -->
        @if (session('status') === 'profile-updated')
            <div class="text-success small mt-3 text-center">{{ __('บันทึกสำเร็จ.') }}</div>
        @endif
    </form>
</section>
<script>
    function previewAvatar(event) {
        const input = event.target;
        const preview = document.getElementById('avatarPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
