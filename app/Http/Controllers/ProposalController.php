<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Repositories\Judul\JudulRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    protected $judulRepository;

    public function __construct(JudulRepository $judulRepository) {
        $this->judulRepository = $judulRepository;
    }

    public function downloadProposal($id_kelompok, $nama_file)
    {
        try {
            $path = 'proposal/' . $nama_file;
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $proposal = Judul::where('id_kelompok', $id_kelompok)->with('proposal')->first();
            $file_name = $proposal->detail_judul . "." . $extension;
            return Storage::disk('public')->download($path, $file_name);
        } catch (FileNotFoundException $e) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
