<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PutUp extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'put_up_id';

 /******
 * Creating a one to many relationship to yarn.
 *******/
  public function yarn() {
    return $this->belongsTo(Yarn::class);
  }

}
