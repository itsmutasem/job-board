<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    Use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'resumes';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'filename',
        'fileUri',
        'contactDetails',
        'summary',
        'skills',
        'experience',
        'education',
        'userId',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected function casts()
    {
        return [
            'deleted_at' => 'datetime'
        ];
    }
}
