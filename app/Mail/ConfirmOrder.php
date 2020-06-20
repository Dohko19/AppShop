<?php

namespace App\Mail;

use App\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cart $cart, $id)
    {
        $this->id = $id;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm-order')
            ->subject('Uno de tus pedidos fue confirmado');
    }
}
