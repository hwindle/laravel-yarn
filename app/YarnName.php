<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YarnName extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'yarn_name_id';

  protected $fillable = [
    'yarn_name',
    'brand_id'
  ];

 /******
 * Creating a one to one relationship to yarn.
 *******/
  public function yarn() {
    return $this->belongsTo(Yarn::class);
  }

}
