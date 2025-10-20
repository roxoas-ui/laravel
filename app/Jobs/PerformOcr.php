<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\Attachment;

class PerformOcr implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $attachmentId;

    public function __construct($attachmentId)
    {
        $this->attachmentId = $attachmentId;
    }

    public function handle()
    {
        $att = Attachment::find($this->attachmentId);
        if (!$att) return;

        $path = storage_path('app/'.$att->path);
        $text = (new TesseractOCR($path))->run();
        $att->ocr_text = $text;
        $att->save();
    }
}
