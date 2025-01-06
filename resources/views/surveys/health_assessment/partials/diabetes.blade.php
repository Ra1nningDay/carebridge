<div class="question-block mb-4">
    <h5 class="fw-semibold text-primary">โรคเบาหวาน</h5>
    <p class="text-muted mb-4">กรุณากรอกข้อมูลเกี่ยวกับสถานะโรคเบาหวานของท่าน เพื่อใช้ในการประเมินสุขภาพ</p>

    <div class="card border p-3 rounded-lg shadow-sm">
       <!-- สถานะโรคเบาหวาน -->
        <div class="form-group mb-3">
            <label for="diabetes_status" class="form-label">สถานะโรคเบาหวาน:</label>
            <select name="diabetes_status" id="diabetes_status" class="form-control" required>
                <option value="" disabled selected>กรุณาเลือกสถานะ</option>
                <option value="diabetic">Diabetic</option>
                <option value="non_diabetic">Non-Diabetic</option>
            </select>
        </div>

        <!-- ค่า FPG -->
        <div class="form-group mb-3">
            <label for="fpg" class="form-label">ค่า FPG (Fasting Plasma Glucose):</label>
            <input type="number" name="fpg" id="fpg" class="form-control" placeholder="กรุณากรอกค่า FPG" min="0" step="any">
        </div>

        <!-- ค่า Random Glucose -->
        <div class="form-group mb-3">
            <label for="random_glucose" class="form-label">ค่า Random Glucose:</label>
            <input type="number" name="random_glucose" id="random_glucose" class="form-control" placeholder="กรุณากรอกค่า Random Glucose" min="0" step="any">
        </div>
    </div>
</div>
