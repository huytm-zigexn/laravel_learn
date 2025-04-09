<?php

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'group_id', 'thumbnail'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
