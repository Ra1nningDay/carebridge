<div class="card shadow-lg p-4 mb-4">
    <h5 class="fw-bold text-primary">กราฟการเพิ่มขึ้นของความเสี่ยง</h5>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs shadow-sm border-0" id="riskTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link shadow-sm" id="daily-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false">
                <i class="fas fa-calendar-day me-2"></i> รายวัน
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active shadow-sm" id="monthly-tab" data-bs-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">
                <i class="fas fa-calendar-month me-2"></i> รายเดือน
            </a>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content mt-4" id="riskTabsContent">
        <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
            <canvas id="riskChartMonth" height="100"></canvas>
        </div>
        <div class="tab-pane fade" id="daily" role="tabpanel" aria-labelledby="daily-tab">
            <canvas id="riskChartDay" height="100"></canvas>
        </div>
    </div>
</div>