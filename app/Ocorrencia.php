<?php
/**
 * Created by PhpStorm.
 * User: allan
 * Date: 01/02/2020
 * Time: 20:34
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
   public $timestamps = false;

   protected $fillable = [
        'nome',
        'descricao',
        'local',
        'tipo'
   ];

   
}