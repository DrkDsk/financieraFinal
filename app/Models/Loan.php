<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['client_id','amount','payments_number','fee','ministry_date','due_date','finished'];
}