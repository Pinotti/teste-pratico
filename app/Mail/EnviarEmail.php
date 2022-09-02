<?php

namespace App\Mail;

use App\Models\Bolo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $bolo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bolo $bolo)
    {
        $this->bolo = $bolo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Novo Bolo Disponível')
                    ->view('mail.email', ['bolo' => $this->bolo]);
        
    }
}
