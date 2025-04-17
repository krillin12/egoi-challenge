<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false;
    // Define a tabela associada
    protected $table = 'logs';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'user_email', 
        'description', 
        'at_time', 
   
    ];

    // Definir o relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
