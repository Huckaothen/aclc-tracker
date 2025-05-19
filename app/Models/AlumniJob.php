<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniJob extends Model
{
    use HasFactory;

    protected $table = 'alumni_jobs';

    protected $fillable = [
        'alumni_id',
        'user_id',
        'category',
        'position',
        'company_name',
        'company_site',
        'location',
        'office_address',
        'company_established',
        'company_size',
        'is_featured',
        'start_date',
        'end_date',
        'job_description',
        'google_map',
        'salary',
        'experience_level',
        'qualification',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'salary' => 'decimal:2',
    ];

    // Relationships
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Query Scopes
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at?->format('F d, Y');
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date?->format('F d, Y');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date?->format('F d, Y') ?? 'Present';
    }
}
