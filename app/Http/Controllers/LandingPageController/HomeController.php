<?php

namespace App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\FAQ;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomePage()
    {
        $berita = Berita::orderBy('created_at','asc')->limit(2)->get();
        $pengumuman = Pengumuman::orderBy('created_at','asc')->limit(2)->get();
        $faq = FAQ::orderBy('created_at','asc')->limit(12)->get();
        return view('landing.home',compact('berita','pengumuman','faq'));
    }

    public function detailBerita($id) {
        $berita = Berita::findOrFail($id);
        return view('landing.berita.detail-berita',compact('berita'));
    }

    public function detailPengumuman($id) {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('landing.pengumuman.detail-pengumuman',compact('pengumuman'));
    }
}
