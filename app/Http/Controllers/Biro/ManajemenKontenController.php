<?php

namespace App\Http\Controllers\Biro;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\FAQ;
use App\Models\Pengumuman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenKontenController extends Controller
{
    public function berita()
    {
        $key = 'manajemen-berita';
        $berita = Berita::orderBy('created_at', 'asc')->paginate(10);
        return view('dashboard.biro.konten.berita.index', compact('key', 'berita'));
    }
    public function tambahBerita()
    {
        $key = 'manajemen-berita';
        return view('dashboard.biro.konten.berita.tambah-edit-berita', compact('key'));
    }
    public function updateBerita($id)
    {
        $key = 'manajemen-berita';
        $berita = Berita::findOrFail($id);
        return view('dashboard.biro.konten.berita.tambah-edit-berita', compact('key', 'berita'));
    }
    public function storeBerita(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
            ]);
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $validatedData['gambar'] = $request->file('gambar')->store('berita', 'public');
            }
            Berita::create($validatedData);
            return redirect()->route('biro.manajemen-berita')->with('success', 'Berita berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deleteBerita($id)
    {
        try {
            Berita::findOrFail($id)->delete();
             return redirect()->route('biro.manajemen-berita')->with('success', 'Berita berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function storeUpdateBerita(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
            ]);
            $berita = Berita::findOrFail($id);
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                if ($berita->gambar) {
                    Storage::disk('public')->delete($berita->gambar);
                }
                $validatedData['gambar'] = $request->file('gambar')->store('berita', 'public');
            }
            $berita->update($validatedData);
            return redirect()->route('biro.manajemen-berita')->with('success', 'Berita berhasil diubah.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function pengumuman()
    {
        $key = 'manajemen-pengumuman';
        $pengumuman = Pengumuman::orderBy('created_at', 'asc')->paginate(10);
        return view('dashboard.biro.konten.pengumuman.index', compact('key', 'pengumuman'));
    }

    public function tambahPengumuman()
    {
        $key = 'manajemen-pengumuman';
        return view('dashboard.biro.konten.pengumuman.tambah-edit-pengumuman', compact('key'));
    }
    public function updatePengumuman($id)
    {
        $key = 'manajemen-pengumuman';
        $pengumuman = Pengumuman::findOrFail($id);
        return view('dashboard.biro.konten.pengumuman.tambah-edit-pengumuman', compact('key', 'pengumuman'));
    }
    public function storeUpdatePengumuman(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
            ]);
            $pengumuman = Pengumuman::findOrFail($id);
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                if ($pengumuman->gambar) {
                    Storage::disk('public')->delete($pengumuman->gambar);
                }
                $validatedData['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
            }
            $pengumuman->update($validatedData);
            return redirect()->route('biro.manajemen-pengumuman')->with('success', 'Pengumuman berhasil diubah.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function storePengumuman(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
            ]);
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $validatedData['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
            }
            Pengumuman::create($validatedData);
            return redirect()->route('biro.manajemen-pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
     public function deletePengumuman($id)
    {
        try {
            Pengumuman::findOrFail($id)->delete();
             return redirect()->route('biro.manajemen-pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function faq()
    {
        $key = 'manajemen-faq';
        $faq = FAQ::orderBy('created_at', 'asc')->paginate(10);
        return view('dashboard.biro.konten.faq.index', compact('key', 'faq'));
    }

    public function tambahFAQ()
    {
        $key = 'manajemen-faq';
        return view('dashboard.biro.konten.faq.tambah-edit-faq', compact('key'));
    }

    public function updateFAQ($id)
    {
        $key = 'manajemen-faq';
        $faq = FAQ::findOrFail($id);
        return view('dashboard.biro.konten.faq.tambah-edit-faq', compact('key', 'faq'));
    }
    public function storeUpdateFAQ(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string|max:255',
            ]);
            FAQ::findOrFail($id)->update($validatedData);
            return redirect()->route('biro.manajemen-faq')->with('success', 'FAQ berhasil diupdate.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function storeFAQ(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string|max:255',
            ]);
            FAQ::create($validatedData);
            return redirect()->route('biro.manajemen-faq')->with('success', 'FAQ berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
     public function deleteFAQ($id)
    {
        try {
            FAQ::findOrFail($id)->delete();
             return redirect()->route('biro.manajemen-faq')->with('success', 'FAQ berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
