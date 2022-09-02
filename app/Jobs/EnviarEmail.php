<?php

namespace App\Jobs;

use App\Mail\EnviarEmail as MailEnviarEmail;
use App\Models\Bolo;
use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bolo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bolo $bolo)
    {
        $this->bolo = $bolo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clientes = (Cliente::find($this->bolo->clientes->pluck('pivot.cliente_id')->all()));
        foreach ($clientes as $cliente) {
            Mail::to($cliente->email)->send(new MailEnviarEmail($this->bolo));
        }
    }
}
