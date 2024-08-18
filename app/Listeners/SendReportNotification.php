<?php

namespace App\Listeners;

use App\Events\ReportCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class SendReportNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ReportCreated  $event
     * @return void
     */
    public function handle(ReportCreated $event)
    {
        Log::info('Sending event to Pusher', ['data' => $event->data]);

        // Aquí puedes hacer cualquier otra cosa que necesites con los datos del evento,
        // como enviar notificaciones adicionales, guardar registros, etc.
    }
}
