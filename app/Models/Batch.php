<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'department_id', 'name', 'year', 'status'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function sesiones() {
        return $this->belongsTo(Session::class);
    }
}
