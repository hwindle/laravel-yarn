<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NearestCol extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'nearest_col_id';

 /******
 * Creating a one to many relationship to yarn stash.
 *******/
  public function yarn_stash() {
    return $this->belongsTo(YarnStash::class);
  }
}
