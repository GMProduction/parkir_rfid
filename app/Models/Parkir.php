<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;
    protected $fillable = [
      'tanggal_masuk',
      'tanggal_keluar',
      'biaya_parkir',
      'user_id',
      'no_pol'
    ];

    protected $with = 'user';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
