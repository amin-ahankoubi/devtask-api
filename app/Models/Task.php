<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'status',
        'priority',
    ];

    public function scopeOrderedBy($query, string $sort, string $direction = 'desc')
    {
        return $query
            ->orderBy($sort, $direction)
            ->orderBy('id', 'desc');
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['status'] ?? null, function ($query, $status) {
                $query->status($status);
            })
            ->when($filters['priority'] ?? null, function ($query, $priority) {
                $query->priority($priority);
            })
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->search($search);
            });

    }

    public function scopeSearch($query, string $search)
    {
        return $query->where('title', 'like', "%{$search}%");
    }
}
