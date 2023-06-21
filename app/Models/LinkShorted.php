<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkShorted extends Model
{
    use HasFactory;

    protected $fillable = ['link_shorteds', 'original_link_id'];

    public function originalLink()
    {
        return $this->belongsTo(OriginalLink::class);
    }

    public function generateRandonLink(String $link)
    {
        return substr(str_shuffle(md5($link)),5, 10);
    }
}
