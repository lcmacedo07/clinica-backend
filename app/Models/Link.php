<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{

    use SoftDeletes, HasFactory, Notifiable;

    protected $table = 'links';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'linkoriginal',
        'linkshort',
        'identfy',
        'slug',
    ];
}