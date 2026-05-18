@extends('layouts.main')
@section('title', 'DelCafe - Jadwal')

@section('content')
@include('layouts.navbar')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fafbfc;
    }

    .schedule-section {
        max-width: 1000px;
        margin: 0 auto;
    }

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 30px;
    }

    .schedule-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 24px;
        padding: 30px 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between; /* Ensures status badge stays aligned at the bottom */
        min-height: 320px; /* Gives plenty of room for multiple sessions */
    }

    .schedule-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0d6efd 0%, #0056b3 100%);
        opacity: 0.85;
    }

    .schedule-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(13, 110, 253, 0.08);
        border-color: rgba(13, 110, 253, 0.15);
    }

    /* Active current day accent */
    .schedule-card.today {
        border-color: #20c997;
        box-shadow: 0 15px 35px rgba(32, 201, 151, 0.12);
        background: rgba(32, 201, 151, 0.01);
    }

    .schedule-card.today::before {
        height: 8px;
        background: linear-gradient(90deg, #20c997 0%, #0d6efd 100%);
    }

    /* Card Elements */
    .day-badge {
        font-size: 1.35rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 12px;
    }

    .schedule-card.today .day-badge {
        color: #20c997;
    }

    .cafe-icon-illustration {
        font-size: 2.6rem;
        color: #ced4da;
        margin-bottom: 15px;
        transition: all 0.3s;
    }

    .schedule-card:hover .cafe-icon-illustration {
        color: #0d6efd;
        transform: scale(1.1) rotate(-8deg);
    }

    .schedule-card.today .cafe-icon-illustration {
        color: #20c997;
    }

    .clock-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f8f9fa;
        color: #495057;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid rgba(0, 0, 0, 0.03);
        transition: all 0.3s;
        width: 100%;
        justify-content: center;
    }

    .schedule-card:hover .clock-badge {
        background: rgba(13, 110, 253, 0.06);
        color: #0d6efd;
        border-color: rgba(13, 110, 253, 0.1);
    }

    .schedule-card.today:hover .clock-badge {
        background: rgba(32, 201, 151, 0.06);
        color: #20c997;
        border-color: rgba(32, 201, 151, 0.1);
    }

    /* Status Label */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 6px 14px;
        border-radius: 30px;
        transition: all 0.3s;
        margin-top: 15px;
    }

    .status-open {
        background: rgba(32, 201, 151, 0.08);
        color: #20c997;
    }

    .status-today {
        background: #20c997;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(32, 201, 151, 0.2);
    }

    /* Section Title decoration */
    .section-title h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        display: block;
        width: 60px;
        height: 4px;
        background: #0d6efd;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }
</style>

@php
    $englishDay = date('l');
    $dayMapping = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu',
    ];
    $todayIndonesian = $dayMapping[$englishDay] ?? '';
@endphp

<div class="container pt-5 my-5" data-aos="fade-up">
    <div class="container section-title text-center" data-aos="fade-up">
        <br>
        <h2>Jadwal Operasional</h2>
    </div>

    <div class="schedule-section px-3">
        @if(isset($jadwals) && count($jadwals) > 0)
        @php
            // Group the collection dynamically by 'hari'
            $groupedJadwals = $jadwals->groupBy(function($item) {
                // Ensure proper casing for grouping keys
                return ucfirst(strtolower($item->hari));
            });
        @endphp
        <div class="schedule-grid" data-aos="fade-up" data-aos-delay="200">
            @foreach ($groupedJadwals as $hari => $hariJadwals)
                @php
                    $isToday = strtolower($hari) == strtolower($todayIndonesian);
                    
                    // Custom icon depending on day name
                    $iconClass = 'fa-mug-hot';
                    if (in_array(strtolower($hari), ['sabtu', 'minggu'])) {
                        $iconClass = 'fa-store';
                    }
                @endphp
                <div class="schedule-card {{ $isToday ? 'today' : '' }}">
                    <div class="w-100 d-flex flex-column align-items-center">
                        <!-- Icon illustration -->
                        <i class="fas {{ $iconClass }} cafe-icon-illustration"></i>
                        
                        <!-- Day name -->
                        <h3 class="day-badge">{{ $hari }}</h3>
                        
                        <!-- Time Sessions (stretching across) -->
                        <div class="d-flex flex-column gap-2 mb-2 w-100 align-items-center">
                            @foreach ($hariJadwals as $jadwal)
                                <div class="clock-badge">
                                    <i class="far fa-clock"></i>
                                    {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Operational Status at the bottom -->
                    @if($isToday)
                        <span class="status-badge status-today">
                            <i class="fas fa-dot-circle fa-beat me-1"></i> Hari Ini
                        </span>
                    @else
                        <span class="status-badge status-open">
                            Buka
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5" data-aos="fade-up">
            <div class="py-5" style="background: #ffffff; border: 1px dashed #dee2e6; border-radius: 24px;">
                <i class="fas fa-calendar-times fa-3x text-muted mb-4" style="opacity: 0.6;"></i>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Jadwal Tersedia</h5>
                <p class="text-muted mb-0">Silakan kembali di lain waktu untuk melihat jadwal operasional kami.</p>
            </div>
        </div>
        @endif
    </div>
</div>

@include('layouts.footer')
@endsection
