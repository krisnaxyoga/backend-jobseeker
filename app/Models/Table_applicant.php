<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_applicant extends Model
{
    use HasFactory;
    protected $primaryKey = 'applicant_id';
    protected $table = 'table_applicant';
    protected $guarded = [];
    public $timestamps = true;


    // Jika Anda ingin menggunakan tipe data datetime pada kolom 'apply_date'
    protected $casts = [
        'apply_date' => 'datetime',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Table_vacancy::class, 'vacancy_id');
    }

    // Relasi ke tabel Candidate (jika ada)
    public function candidate()
    {
        return $this->belongsTo(Table_candidate::class, 'candidate_id');
    }
}
