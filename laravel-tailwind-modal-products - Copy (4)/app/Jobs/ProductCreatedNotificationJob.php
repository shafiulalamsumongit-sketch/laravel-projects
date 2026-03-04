<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProductCreatedNotificationJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public Product $product) {}

    public function handle()
    {
        Log::info("New product created: " . $this->product->name);
        // Here: mail / database notification / push
    }
}
