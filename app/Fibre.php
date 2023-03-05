<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fibre extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'fibre_id';

  protected $fillable = [
    'fibre'
  ];

 /******
 * Creating a one to many relationship to yarn.
 *******/
  public function yarn() {
    return $this->belongsTo(Yarn::class);
  }
}
