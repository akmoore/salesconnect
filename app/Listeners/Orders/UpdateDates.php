<?php

namespace App\Listeners\Orders;

use App\Events\OrderWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use Carbon\Carbon;

class UpdateDates
{
    protected $order;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasUpdated  $event
     * @return void
     */
    public function handle(OrderWasUpdated $event)
    {
        $order = $this->order->find($event->oldOrder->id);
        $order->update([
            'vcd_vhs_date' => $event->oldOrder->vcd_vhs != $event->request['vcd_vhs'] ? Carbon::now() : $event->oldOrder->vcd_vhs_date,
            'dvd_date' => $event->oldOrder->dvd != $event->request['dvd'] ? Carbon::now() : $event->oldOrder->dvd_date,
            'beta_dub_date' => $event->oldOrder->beta_dub != $event->request['beta_dub'] ? Carbon::now() : $event->oldOrder->beta_dub_date,
            'crawl_date' => $event->oldOrder->crawl != $event->request['crawl'] ? Carbon::now() : $event->oldOrder->crawl_date,
            'ftp_date' => $event->oldOrder->ftp != $event->request['ftp'] ? Carbon::now() : $event->oldOrder->ftp_date,
            'music_library_date' => $event->oldOrder->music_library != $event->request['music_library'] ? Carbon::now() : $event->oldOrder->music_library_date
        ]);
    }
}
