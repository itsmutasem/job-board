<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'job_vacancies';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'location',
        'type',
        'salary',
        'companyId',
        'jobCategoryId',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'jobCategoryId', 'id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'jobVacancyId', 'id');
    }
}
