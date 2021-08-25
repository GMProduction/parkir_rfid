<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable = [
      'tanggal',
      'status',
      'nominal',
      'user_id'
    ];

    protected $with = 'user';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
