<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['group_name'];

    public function members(){
        return $this->hasMany(group_members::class, 'group_id');
    }

    public function chats(){
        return $this->hasMany(group_message::class, 'group_id', 'id');
    }
}
