<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'code', 'shift', 'total_credit', 'status'
    ];

    public function batches() {
        return $this->belongsTo(Batch::class);
    }
}
