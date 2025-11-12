<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\News;

class KomentarController extends Controller
{
    /**
     * Simpan komentar baru ke dalam database.
     */
    public function store(Request $request, News $news)
    {
        // 🧩 Validasi input dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'isi'  => 'required|string',
        ]);

        // 💬 Simpan komentar baru ke tabel komentar
        $komentar = new Komentar();
        $komentar->nama = $validatedData['nama'];
        $komentar->isi = $validatedData['isi'];
        $komentar->news_id = $news->id;
        $komentar->save();

        // ✅ Redirect kembali ke halaman berita dengan pesan sukses
        return redirect()
            ->route('news.show', $news->id)
            ->with('success', 'Komentar berhasil ditambahkan!');
    }
}