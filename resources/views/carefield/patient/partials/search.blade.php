<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title"><i class="fas fa-search text-primary"></i> เครื่องมือค้นหา</h5>
        <form action="#" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search_name" class="form-label">ชื่อผู้รับการตรวจ</label>
                    <input type="text" id="search_name" class="form-control" name="search_name" placeholder="กรอกชื่อ">
                </div>
                <div class="col-md-4">
                    <label for="search_date" class="form-label">วันที่ตรวจ</label>
                    <input type="date" id="search_date" class="form-control" name="search_date">
                </div>
                <div class="col-md-4">
                    <label for="search_risk" class="form-label">ความเสี่ยง</label>
                    <select id="search_risk" class="form-select" name="search_risk">
                        <option value="">ทั้งหมด</option>
                        <option value="hypertension">ความดันโลหิตสูง</option>
                        <option value="diabetes">โรคเบาหวาน</option>
                        <option value="osteoporosis">กระดูกพรุน</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <label for="hearing_status" class="form-label">การได้ยิน</label>
                    <select id="hearing_status" class="form-select" name="hearing_status">
                        <option value="">ทั้งหมด</option>
                        <option value="normal">ปกติ</option>
                        <option value="impaired">มีปัญหา</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="age_range" class="form-label">ช่วงอายุ</label>
                    <div class="input-group">
                        <input type="number" id="age_min" class="form-control" name="age_min" placeholder="อายุต่ำสุด">
                        <span class="input-group-text">-</span>
                        <input type="number" id="age_max" class="form-control" name="age_max" placeholder="อายุมากสุด">
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> ค้นหา
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>