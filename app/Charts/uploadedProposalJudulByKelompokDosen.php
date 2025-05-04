<?php

namespace App\Charts;

use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\SkemaPkm;
use App\Repositories\Judul\JudulRepository;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Auth;
use Illuminate\Support\HtmlString;

class uploadedProposalJudulByKelompokDosen
{
    protected $chart;
    protected $judulRepository;

    public function __construct(LarapexChart $chart, JudulRepository $judulRepository)
    {
        $this->chart = $chart;
        $this->judulRepository = $judulRepository;
    }

    public function build(): BarChart
    {
        $id_dosen = Auth::user()->dosen->id;
        $labels = [];

        $skemas = $this->judulRepository->getSkema();

        foreach ($skemas as $skema) {
            $labels[] = $skema->nama_skema;
            $countProposal = Judul::whereHas('kelompok', function ($query) use ($id_dosen) {
                $query->where('dospemId', $id_dosen);
            })
                ->where('id_skema', $skema->id)
                ->where('is_proposal', true)
                ->count();

            $dataProposal[] = $countProposal;
        }

        // Step 5: Return chart
        return $this->chart->barChart()
            ->setTitle('Jumlah Judul Fix per Skema')
            ->setSubtitle('Berdasarkan pembimbing: ' . Auth::user()->getNamaUserAttribute())
            ->addData('Jumlah Proposal', $dataProposal)
            ->setXAxis($labels);
    }
}
