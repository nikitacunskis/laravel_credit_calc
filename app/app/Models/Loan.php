<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'name',
        'phone',
        'agreed_with_rules',
        'amount',
        'time',
        'step',
        'status',
    ];
}
