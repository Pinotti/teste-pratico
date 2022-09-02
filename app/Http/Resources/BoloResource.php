<?php

namespace App\Http\Resources;

use App\Models\Cliente;
use Illuminate\Http\Resources\Json\JsonResource;

class BoloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'peso' => $this->peso,
            'valor' => $this->valor,
            'quantidade' => $this->quantidade,
            'interessados' => [
                new ClienteCollection(Cliente::find($this->clientes->pluck('pivot.cliente_id')->all()))
            ]
        ];
    }
}
