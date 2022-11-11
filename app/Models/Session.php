<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'batch_id', 'status'
    ];

    public function batch() {
        return $this->belongsTo(Batch::class);
    }
    
    public function groups() {
        return $this->belongsTo(Group::class);
    }
}
