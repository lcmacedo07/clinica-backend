<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Useraccesses extends Model
{

    use SoftDeletes, HasFactory, Notifiable;

    protected $table = 'useraccesses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'link_id',
        'ip',
        'useragent',
    ];


    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
