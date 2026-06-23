<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Controller untuk mengelola bahasa aplikasi.
 * Mendukung bahasa Indonesia (id) dan Inggris (en).
 */
class LanguageController extends Controller
{
    /**
     * Daftar bahasa yang didukung.
     */
    protected $supportedLocales = ['id', 'en'];

    /**
     * Mengubah bahasa aplikasi.
     * Menyimpan pilihan bahasa ke session.
     */
    public function switch(Request $request, string $locale)
    {
        // Validasi locale
        if (!in_array($locale, $this->supportedLocales)) {
            abort(400, 'Bahasa tidak didukung.');
        }

        // Simpan ke session
        Session::put('locale', $locale);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', $locale === 'id'
            ? 'Bahasa berhasil diubah ke Indonesia.'
            : 'Language changed to English.'
        );
    }
}
