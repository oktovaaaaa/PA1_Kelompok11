@extends('layouts.main')
@section('title', 'DelCafe - Jadwal')

@include('layouts.navbar')
<div class="container section-title pt-5 mt-5" data-aos="fade-up">
    <h2>Jadwal</h2>
</div>

    <div class="container">

    @if(isset($jadwals) && count($jadwals) > 0)
            <br>
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <th scope="col" class="text-center">Hari</th>
                    <th scope="col" class="text-center">Waktu Mulai</th>
                    <th scope="col" class="text-center">Waktu Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td class="text-center">{{ $jadwal->hari }}</td>
                        <td class="text-center">{{ $jadwal->waktu_mulai }}</td>
                        <td class="text-center">{{ $jadwal->waktu_selesai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center fs-4 pt-5">Jadwal tidak tersedia</p>
    @endif
    </div>


@include('layouts.footer')
</div>
