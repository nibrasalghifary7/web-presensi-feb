{{--
    Halaman Import Mahasiswa (Admin)
    Upload CSV untuk import data mahasiswa secara bulk.
--}}
@extends('layouts.app')

@section('title', 'Import Mahasiswa')
@section('page-title', 'Import Mahasiswa')

@section('content')
<div class="space-y-6 max-w-2xl">

    {{-- Header --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800">Import Data Mahasiswa</h3>
        <p class="text-sm text-gray-500">Upload file CSV untuk import data mahasiswa secara bulk</p>
    </div>

    {{-- Info Format --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
            <div>
                <p class="text-sm font-semibold text-blue-800">Format File CSV</p>
                <p class="text-xs text-blue-600 mt-1">File harus dalam format CSV dengan kolom berikut:</p>
                <div class="mt-2 bg-white rounded-lg p-3 text-xs font-mono">
                    <p class="text-gray-500">nim, nama, email, phone, kelas, angkatan, prodi, password</p>
                    <p class="text-gray-400 mt-1">Contoh: 12408011010099, Budi Santoso, budi@email.com, 081234567890, Manajemen A, 2024, Manajemen, password123</p>
                </div>
                <ul class="text-xs text-blue-600 mt-2 space-y-1 list-disc list-inside">
                    <li>Kolom <strong>wajib</strong>: nim, nama, kelas, angkatan</li>
                    <li>Kolom <strong>opsional</strong>: email, phone, prodi, password</li>
                    <li>Jika password kosong, default: <code>password123</code></li>
                    <li>NIM harus unik (belum terdaftar di sistem)</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Template Download --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-800">Template CSV</p>
                <p class="text-xs text-gray-500">Download template untuk memudahkan pengisian data</p>
            </div>
            <a href="{{ route('admin.mahasiswa.template') }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-download mr-1"></i> Download Template
            </a>
        </div>
    </div>

    {{-- Form Upload --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <form method="POST" action="{{ route('admin.mahasiswa.import') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fas fa-file-csv text-uin-green mr-1"></i> Pilih File CSV
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-uin-green transition-colors">
                    <i class="fas fa-cloud-arrow-up text-4xl text-gray-300 mb-3"></i>
                    <p class="text-sm text-gray-500">Pilih file CSV atau drag and drop</p>
                    <p class="text-xs text-gray-400 mt-1">Maks 5MB</p>
                    <input type="file" id="file" name="file" accept=".csv,.txt"
                           class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                  file:bg-uin-green file:text-white hover:file:bg-uin-green-dark"
                           required>
                </div>
                @error('file')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-uin-green text-white rounded-xl font-medium hover:bg-uin-green-dark transition-colors">
                    <i class="fas fa-upload mr-1"></i> Import Data
                </button>
                <a href="{{ route('admin.mahasiswa.index') }}"
                   class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
