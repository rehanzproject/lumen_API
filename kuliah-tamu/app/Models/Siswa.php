<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model{
    protected $fillable = ["id" , "name", "age" , "profile"];
    protected $table = 'test_table';
}
