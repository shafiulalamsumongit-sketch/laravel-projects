<?php

namespace App\Jobs;
use Mail;
use App\Mail\ProductCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;




class SendProductCreatedMailJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        Mail::to('shafiulalams@gmail.com')
            ->send(new ProductCreatedMail($this->product));
    }
}
