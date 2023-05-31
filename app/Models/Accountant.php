<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accountant extends Model
{

    use SoftDeletes, HasFactory, Notifiable;

    protected $table = 'accountants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'link_id',
        'quantity'
    ];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}