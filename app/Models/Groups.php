<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['group_name', 'desc', 'image_group', 'created_at', 'updated_at'];

    public function members(){
        return $this->hasMany(group_members::class, 'group_id', 'id');
    }

    public function chats(){
        return $this->hasMany(group_message::class, 'group_id', 'id');
    }


}
