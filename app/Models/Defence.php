<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defence extends Model {
    use HasFactory;

    protected $fillable = [
        'date', 'group_id', 'student_id', 'marks', 'details', 'seen', 'status', 'varified_by', 'varified_at'
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
