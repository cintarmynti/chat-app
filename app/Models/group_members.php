<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_members extends Model
{
    use HasFactory;
    protected $table = 'group_members';
    protected $fillable = ['user_id', 'group_id', 'role'];

    public function group(){
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }


}
