<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_message extends Model
{
    use HasFactory;
    protected $table = 'group_messages';
    protected $fillable = ['group_id', 'sender_id', 'content'];
}
