<?php

namespace App\Charts;

use App\Repositories\Judul\JudulRepository;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UploadedProposalBySkemaChart
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
        $skemas = $this->judulRepository->getSkema();
        $labels = [];
        $dataProposal = [];
        $dataJudul = [];

        foreach ($skemas as $skema) {
            $labels[] = $skema->nama_skema;

            // Hitung total proposal_final untuk setiap skema
            $count = $skema->judul->filter(function ($judul) {
                return $judul->proposal !== null;
            })->count();

            $countJudul = $skema->judul->filter(function ($judul){
                return $judul;
            })->count();

            $dataProposal[] = $count;
            $dataJudul[] = $countJudul;
        }

        return $this->chart->barChart()
            ->setTitle('Total Proposal & Usulan Judul terupload')
            ->setSubtitle('Proposal & usulan judul berdasarkan skema PKM')
            ->addData('Usulan Judul', $dataJudul)
            ->addData('Proposal Final', $dataProposal)
            ->setXAxis($labels);
    }

}
