<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BoloCliente extends Pivot
{
    use HasFactory;

    public $timestamps = false;
}
