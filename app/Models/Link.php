<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'base_link',
        'short_link',
    ];
    
    public static function getFullLink(string $short_link) : string {
        return env('APP_URL') . '/' . $short_link;
    }
}
