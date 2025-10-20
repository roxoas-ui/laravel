<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\License;
use App\Jobs\SendExpiryAlert;

class ScheduleExpiryAlerts implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $thresholds = [90, 60, 30, 15, 7, 3];
        foreach (License::whereNotNull('expires_at')->get() as $license) {
            $days = now()->diffInDays($license->expires_at, false);
            foreach ($thresholds as $t) {
                if ($days === $t) {
                    // Dispatch email job
                    SendExpiryAlert::dispatch($license->id);
                }
            }
        }
    }
}
