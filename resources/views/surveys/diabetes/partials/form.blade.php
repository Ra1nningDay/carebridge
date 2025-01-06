<form method="POST" action="" class="assessment-form shadow-sm p-4 rounded bg-white">
    @csrf

    <!-- การตรวจน้ำตาลในเลือด -->
    <div class="question-block mb-5">
        <h5 class="fw-bold mb-3">การตรวจน้ำตาลในเลือดโดยวิธีเจาะจากปลายนิ้ว</h5>
        <label for="fcbg" class="form-label fs-5">ค่าน้ำตาลในเลือด (มก./ดล.)</label>
        <input type="number" id="fcbg" name="answers[fcbg]" class="form-control form-control-lg mb-3" placeholder="กรอกค่าน้ำตาลในเลือด" required>
        <div class="text-center mb-3">
            <img src="/images/blood-drop.gif" alt="Blood Drop Animation" style="width: 100px; height: auto;">
        </div>
        <p class="text-muted small">
            การตรวจน้ำตาลในเลือดโดยวิธีเจาะจากปลายนิ้ว (fasting capillary blood glucose, FCBG): <br>
            - หากระดับ FPG ≥ 126 มก./ดล. ให้ตรวจยืนยันอีกครั้ง <br>
            - หาก FPG อยู่ระหว่าง 100-125 มก./ดล. ถือเป็น "ภาวะระดับน้ำตาลในเลือดขณะอดอาหารผิดปกติ" <br>
            คำแนะนำ: ปรับพฤติกรรมโดยควบคุมอาหารและออกกำลังกายสม่ำเสมอ
        </p>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            ส่งแบบประเมิน
        </button>
    </div>
</form>