<?php

namespace App\Mail;

use App\Models\Shop\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductCreate extends Mailable
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
            ->subject("新增商品{$this->product->name}")
            ->view('mail.product.create');
            // ->attach(public_path('uploads/'.$this->mainImage->path),
            //     [
            //         'mime' => $this->mainImage->data_type,
            //         'as' => 'product.jpg'
            //     ]
            // )
            // ->attachData(
            //     file_get_contents(public_path('uploads/'.$this->mainImage->path)),
            //     'product2.jpg',
            //     [
            //         'mime' => $this->mainImage->data_type,
            //     ]
            // )
            
    }
}
