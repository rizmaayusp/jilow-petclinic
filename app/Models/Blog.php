<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $primaryKey = 'id_blog'; // Tambahkan primary key

    protected $fillable = [
        'judul_blog',
        'konten',
        'gambar_blog',
    ];
}
