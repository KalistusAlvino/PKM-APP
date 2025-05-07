<?php

namespace App\Charts;

use App\Models\Judul;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class IdeDanJudulChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $ide = Judul::all()->count();
        $proposal = Judul::where('is_proposal',true)->count();
        return $this->chart->pieChart()
            ->setTitle('Total Ide dan Judul Tetap.')
            ->setSubtitle('PKM UKDW.')
            ->addData([$ide,$proposal])
            ->setLabels(['Ide', 'Judul Tetap']);
    }
}
