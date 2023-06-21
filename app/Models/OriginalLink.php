<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginalLink extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    public function linkShorted()
    {
        return $this->hasOne(LinkShorted::class);
    }
}
