<div class="question-block mb-4">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold text-primary">สุขภาพช่องปาก</h5>
        <p class="text-muted mb-0">กรุณากรอกข้อมูลการดูแลสุขภาพช่องปาก</p>
    </div>
    
    <div class="card border p-3 rounded-lg shadow-sm">
       <!-- ความถี่ในการแปรงฟัน -->
        <div class="form-group mb-3">
            <label for="brushing_frequency" class="form-label">ความถี่ในการแปรงฟัน:</label>
            <input 
                type="text" 
                name="brushing_frequency" 
                id="brushing_frequency" 
                class="form-control" 
                placeholder="กรอกจำนวนครั้งที่แปรงฟันต่อวัน">
        </div>

        <!-- คำอื่น ๆ -->
        <div class="form-group mb-3">
            <label for="brushing_other" class="form-label">คำอื่น ๆ (ถ้ามี):</label>
            <input 
                type="text" 
                name="brushing_other" 
                id="brushing_other" 
                class="form-control" 
                placeholder="กรอกข้อมูลเพิ่มเติม (ถ้ามี)">
        </div>

        <!-- ใช้ยาสีฟัน -->
        <div class="form-check">
            <input 
                type="checkbox" 
                name="uses_toothpaste" 
                id="uses_toothpaste" 
                class="form-check-input" 
                value="1">
            <label for="uses_toothpaste" class="form-check-label">ใช้ยาสีฟัน</label>
        </div>

        <!-- ทำความสะอาดระหว่างซี่ฟัน -->
        <div class="form-check">
            <input 
                type="checkbox" 
                name="cleans_between_teeth" 
                id="cleans_between_teeth" 
                class="form-check-input" 
                value="1">
            <label for="cleans_between_teeth" class="form-check-label">ทำความสะอาดระหว่างซี่ฟัน</label>
        </div>

        <!-- อุปกรณ์ทำความสะอาด -->
        <div class="form-group mb-3">
            <label for="cleaning_tool" class="form-label">อุปกรณ์ทำความสะอาด:</label>
            <input 
                type="text" 
                name="cleaning_tool" 
                id="cleaning_tool" 
                class="form-control" 
                placeholder="กรอกข้อมูลอุปกรณ์ที่ใช้ทำความสะอาด">
        </div>

        <!-- สูบบุหรี่เกินวันละ 10 มวน -->
        <div class="form-check">
            <input 
                type="checkbox" 
                name="smokes_more_than_10" 
                id="smokes_more_than_10" 
                class="form-check-input" 
                value="1">
            <label for="smokes_more_than_10" class="form-check-label">สูบบุหรี่เกินวันละ 10 มวน</label>
        </div>

        <!-- เคี้ยวหมาก -->
        <div class="form-check">
            <input 
                type="checkbox" 
                name="chews_areca" 
                id="chews_areca" 
                class="form-check-input" 
                value="1">
            <label for="chews_areca" class="form-check-label">เคี้ยวหมาก</label>
        </div>
    </div>
</div>
