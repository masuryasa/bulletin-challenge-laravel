<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function scopeTitle($query)
    {
        if (request('title')) {
            return $query->where('title', 'like', '%' . request('title') . '%');
        }
    }

    public function scopeBody($query)
    {
        if (request('body')) {
            return $query->where('body', 'like', '%' . request('body') . '%');
        }
    }

    public function scopeImage($query)
    {
        if (request('imageOption') === "with") {
            return $query->whereNotNull('image_name');
        } elseif (request('imageOption') === "without") {
            return $query->whereNull('image_name');
        }
    }

    public function scopeStatus($query)
    {
        if (request('statusOption') === "on") {
            return $query->whereNull('deleted_at');
        } elseif (request('statusOption') === "deleted") {
            return $query->whereNotNull('deleted_at');
        }
    }

    public function getImagePathAttribute()
    {
        return "storage/images/{$this->image_name}";
    }

    public function getDateAttribute()
    {
        return "{$this->created_at->format('d-m-Y')}";
    }

    public function getTimeAttribute()
    {
        return "{$this->created_at->format('H:i:s')}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
