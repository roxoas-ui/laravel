<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendExpiryAlert implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $licenseId;

    public function __construct($licenseId)
    {
        $this->licenseId = $licenseId;
    }

    public function handle()
    {
        // Buscar license e enviar e-mail de alerta — implementar conforme regra de negócio
        // Exemplo simplificado: Mail::to($user)->send(new \App\Mail\LicenseExpiryMail($license));
    }
}
