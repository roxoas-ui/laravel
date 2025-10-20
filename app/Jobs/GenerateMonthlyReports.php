<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ReportController;

class GenerateMonthlyReports implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $controller = new ReportController();
        // Gera PDF geral e salva em storage
        $pdf = $controller->generalStatusPdf(new \Illuminate\Http\Request());
        // Poderíamos salvar o conteúdo: Storage::put('reports/monthly.pdf', $pdf->output());
    }
}
