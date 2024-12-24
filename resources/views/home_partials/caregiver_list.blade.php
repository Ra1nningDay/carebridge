{{-- <section style="background-color: #f4f4f4; padding: 100px 0; margin-bottom: 72px; position: relative; overflow: hidden;">
    <div class="container">
        <!-- Background Shape -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(70, 112, 97, 0.15), rgba(0, 0, 0, 0.02)); z-index: 1; pointer-events: none;"></div>
        
        <!-- Content -->
        <div class="position-relative" style="z-index: 2;">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2rem; color: #003e29;">ผู้ดูแลของเรา</h2>
                <div style="height: 4px; width: 60px; background-color: #467061; margin: 8px auto 24px;"></div>
                <h2 class="text-muted fs-5">พบกับทีมผู้ดูแลที่ทุ่มเทและมากความสามารถ พร้อมมอบการสนับสนุนที่ยอดเยี่ยมแก่คุณ</h2>
            </div>

            <div class="row justify-content-center g-4">
                @foreach ($caregivers as $caregiver)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="card caregiver-card align-items-center shadow border-0 rounded-3 h-100 position-relative" style="overflow: hidden; background-color: #ffffff;">
                        <!-- Caregiver Avatar -->
                        <div class="mt-4 bg-light rounded-circle" 
                             style="width: 90px; height: 90px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                            <img class="img-fluid rounded-circle" 
                                 src="{{ $caregiver->user->avatar ? asset('uploads/avatars/' . $caregiver->user->avatar) : asset('images/avatars/default-avatar.png') }}"  
                                 alt="{{ $caregiver->user->name ?? 'Caregiver' }}" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body text-center pt-3 mt-3">
                            <h5 class="card-title fw-bold mb-1" style="color: #003e29;">{{ $caregiver->user->name ?? 'Name Unavailable' }}</h5>
                            <p class="text-muted mb-3">
                                <i class="bi bi-geo-alt-fill me-1" style="color: #467061;"></i>
                                {{ $caregiver->personalInfo->address ?? 'Location not specified' }}
                            </p>
                            <h6 class="fw-bold mt-3" style="color: #467061;">เหตุผลที่คุณควรเลือกฉัน</h6>
                            <p class="text-muted">{{ $caregiver->specialization ?? 'Specialization not specified' }}</p>
                            <hr>
                            <p class="fw-bold text-dark">เริ่มต้น</p>
                            <p class="fs-4 fw-bold" style="color: #467061;">{{ $caregiver->rate_per_hour ?? 'N/A' }} บาท/ชั่วโมง</p>
                            <a href="{{ route('profile.profile', ['id' => $caregiver->id]) }}" class="btn btn-view-profile w-100 mt-3" 
                               style="background: linear-gradient(135deg, #467061, #003e29); border: none; color: #ffffff;">ดูโปรไฟล์</a>
                            @if ($caregiver->user->id != auth()->id())
                                <a href="{{ route('chat.start', $caregiver->user->id) }}" class="btn btn-success w-100 mt-2">
                                    <i class="bi bi-chat-dots me-1"></i> ส่งข้อความ
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CSS -->
<style>
    /* Profile Button Style */
    .btn-view-profile {
        color: #ffffff;
        transition: all 0.3s ease;
    }
    .btn-view-profile:hover {
        background: linear-gradient(135deg, #003e29, #467061);
        transform: scale(1.05);
    }

    .caregiver-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 1024px) {
        section {
            padding: 50px 0;
        }

        .text-center h2.fw-bold {
            font-size: 1.8rem;
        }

        .text-muted.fs-5 {
            font-size: 1rem;
        }

        .caregiver-card .rounded-circle {
            width: 80px;
            height: 80px;
        }

        .btn-view-profile {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .text-center h2.fw-bold {
            font-size: 1.6rem;
        }

        .text-muted.fs-5 {
            font-size: 0.9rem;
        }

        .caregiver-card .rounded-circle {
            width: 70px;
            height: 70px;
        }

        .btn-view-profile {
            font-size: 0.85rem;
            padding: 6px 12px;
        }
    }

    @media (max-width: 576px) {
        .text-center h2.fw-bold {
            font-size: 1.4rem;
        }

        .text-muted.fs-5 {
            font-size: 0.8rem;
        }

        .caregiver-card .rounded-circle {
            width: 60px;
            height: 60px;
        }

        .btn-view-profile {
            font-size: 0.8rem;
        }
    }
</style> --}}
