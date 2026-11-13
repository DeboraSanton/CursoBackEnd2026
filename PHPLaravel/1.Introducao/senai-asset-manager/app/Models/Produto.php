<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// classe responsavel por conversar com o banco de dados => insert, select, update, delete

class Produto extends Model
{
    protected $fillable = ["nome", "fabricante", "quantidade", "valor"];
}
