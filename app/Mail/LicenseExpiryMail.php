<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\License;

class LicenseExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $license;

    public function __construct(License $license)
    {
        $this->license = $license;
    }

    public function build()
    {
        return $this->subject('Alerta: Licença próxima do vencimento')
                    ->markdown('emails.license_expiry')
                    ->with(['license' => $this->license]);
    }
}
