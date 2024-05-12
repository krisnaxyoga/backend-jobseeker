<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_candidate extends Model
{
    use HasFactory;
    protected $primaryKey = 'candidate_id';
    protected $table = 'table_candidate';
    protected $guarded = [];
}
