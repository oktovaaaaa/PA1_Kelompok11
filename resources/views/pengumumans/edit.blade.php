@extends('layouts.main')

<br>
<div class="d-flex justify-content-center align-items-center vh-10">
    <h2 class="fw-semibold fs-4 text-center">Tambah pengumuman</h2>
</div>
<br>
</div>
<div class="text-end">
    @include('pengumumans.delete')
</div><br><br>


<div class="mt-4" x-data="{imageUrl: '/storage/noimage.png'}">

<div class="container">
    <div class="row align-items-center">

        <div class="col-lg-12 d-flex flex-column gap-3">
            <form enctype="multipart/form-data" method="POST" action="{{ route('pengumumans.update',$pengumuman) }}" class="p-4 border rounded shadow w-100">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input id="judul" class="form-control" type="text" name="judul" value="{{ $pengumuman->judul }}" required/>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" class="form-control" name="teks" rows="3">{{$pengumuman->teks }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="Tautan" class="form-label">Tautan</label>
                    <input id="Tautan" class="form-control" type="text" name="tautan" value="{{ $pengumuman->tautan }}"/>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal (Tanggal-Bulan-Tahun)</label>
                    <input id="tanggal" class="form-control" type="date" name="tanggal" value="{{$pengumuman->tanggal }}" required/>
                </div>



                <button type="submit" class="btn btn-dark w-100">Simpan</button>
            </form>
        </div>


