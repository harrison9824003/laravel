<?php

namespace App\Mail;

use App\Models\Shop\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $mainImage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->mainImage = $this->product->images->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("修改商品{$this->product->name}")
            ->view('mail.product.update');
    }
}
