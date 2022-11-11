<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_id', 'name', 'teacher_id', 'topic_name', 'status'
    ];

    public function session() {
        return $this->belongsTo(Session::class);
    }

    public function teacher() {
        return $this->belongsTo(User::class);
    }
    
    public function defences() {
        return $this->belongsTo(Defence::class);
    }
}
