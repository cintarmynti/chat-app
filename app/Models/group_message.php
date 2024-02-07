<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_message extends Model
{
    use HasFactory;
    protected $table = 'group_messages';
    protected $fillable = ['group_id', 'sender_id', 'content'];

    public function group(){
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
