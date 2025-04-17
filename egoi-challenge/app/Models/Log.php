<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'logs';

    
    protected $primaryKey = 'id';

   
    protected $fillable = [
        'user_email', 
        'description', 
        'at_time', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
