{{--
    Halaman Dokumen / Pengajuan Izin Mahasiswa
    Form untuk mengunggah surat keterangan izin/sakit (foto/PDF).
--}}
@extends('layouts.app')

@section('title', __('app.mahasiswa.dokumen_title'))
@section('page-title', __('app.mahasiswa.dokumen_title'))

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Form Pengajuan --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-5">
                <i class="fas fa-file-medical text-uin-green mr-2"></i>{{ __('app.mahasiswa.form_pengajuan') }}
            </h3>

            <form method="POST" action="{{ route('mahasiswa.dokumen.submit') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- Pilih Mata Kuliah --}}
                <div>
                    <label for="id_jadwal" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-book-open text-uin-green mr-1"></i> Mata Kuliah / Kelas
                    </label>
                    <select id="id_jadwal" name="id_jadwal"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                   focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                   outline-none transition-all text-sm"
                            required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($jadwalList as $jadwal)
                            <option value="{{ $jadwal->id_jadwal }}" {{ old('id_jadwal') == $jadwal->id_jadwal ? 'selected' : '' }}>
                                {{ $jadwal->mataKuliah->nama_mk }} ({{ $jadwal->kelas }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Pengajuan --}}
                <div>
                    <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-triangle-exclamation text-uin-green mr-1"></i> Jenis Halangan
                    </label>
                    <select id="jenis" name="jenis"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                   focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                   outline-none transition-all text-sm"
                            required>
                        <option value="Sakit" {{ old('jenis') == 'Sakit' ? 'selected' : '' }}>Sakit / Medis</option>
                        <option value="Izin" {{ old('jenis') == 'Izin' ? 'selected' : '' }}>Izin Keperluan</option>
                    </select>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal_izin" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-calendar-day text-uin-green mr-1"></i> Tanggal Berhalangan
                    </label>
                    <input type="date" id="tanggal_izin" name="tanggal_izin" value="{{ old('tanggal_izin', date('Y-m-d')) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                  focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                  outline-none transition-all text-sm"
                           required>
                </div>

                {{-- Alasan --}}
                <div>
                    <label for="alasan" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-pencil text-uin-green mr-1"></i> Catatan / Alasan Singkat
                    </label>
                    <textarea id="alasan" name="alasan" rows="3"
                              placeholder="Contoh: Mengalami demam tinggi dan harus rawat jalan."
                              class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                                     focus:border-uin-green focus:ring-2 focus:ring-uin-green/20 focus:bg-white
                                     outline-none transition-all text-sm resize-none"
                              required>{{ old('alasan') }}</textarea>
                </div>

                {{-- Upload Bukti --}}
                <div>
                    <label for="bukti_surat" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-paperclip text-uin-green mr-1"></i> Unggah Bukti Surat
                    </label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-uin-green transition-colors">
                        <i class="fas fa-cloud-arrow-up text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Pilih file foto/PDF atau drag and drop</p>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG, PDF &middot; Maks 2MB</p>
                        <input type="file" id="bukti_surat" name="bukti_surat"
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                      file:bg-uin-green file:text-white hover:file:bg-uin-green-dark">
                    </div>
                    @error('bukti_surat')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Kirim --}}
                <button type="submit"
                        class="w-full bg-uin-green hover:bg-uin-green-dark text-white font-bold py-3 px-4
                               rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    <span>Kirim Pengajuan</span>
                </button>
            </form>
        </div>

        {{-- Riwayat Pengajuan --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-5">
                <i class="fas fa-list text-uin-green mr-2"></i>Daftar Pengajuan
            </h3>

            @if($riwayatIzin->isEmpty())
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-file-pen text-4xl mb-3"></i>
                    <p>Belum ada pengajuan</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($riwayatIzin as $izin)
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ $izin->jadwal->mataKuliah->nama_mk ?? '-' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                            {{ $izin->jenis == 'Sakit' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $izin->jenis }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <i class="far fa-calendar mr-1"></i>{{ $izin->tanggal_izin->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $izin->alasan }}</p>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $izin->status == 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($izin->status == 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($izin->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $riwayatIzin->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
