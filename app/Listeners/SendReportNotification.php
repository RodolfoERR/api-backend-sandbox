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
        // Aquí no necesitas usar `broadcastAs` directamente
        // Emitimos el evento y Laravel se encargará de todo
        event(new ReportCreated($event->data));
    }
}
