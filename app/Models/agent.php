<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    use HasFactory;

      protected $fillable = ['agentname', 'Licence', 'picture', 'Desigination'];  

       public static function getagentdata($id) {
          $agentdata = agent::find($id);
          return $agentdata;
    }

}
