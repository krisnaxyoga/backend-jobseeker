<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_vacancy extends Model
{
    use HasFactory;
    protected $primaryKey = 'vacancy_id';
    protected $table = 'table_vacancy';
    protected $guarded = [];
}
