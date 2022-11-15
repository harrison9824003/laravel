<?php

namespace App\Listeners;

use App\Events\DeleteProduct;
use App\Mail\DeleteProduct as MailDeleteProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DeleteProductListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\DeleteProduct  $event
     * @return void
     */
    public function handle(DeleteProduct $event)
    {
        Log::info('delete product: '.$event->product->name);
        Mail::to($event->user)
            ->send(new MailDeleteProduct($event->product));
    }
}
