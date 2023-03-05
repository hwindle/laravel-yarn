<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $primaryKey = 'brand_id';
  protected $fillable = [
    'brand_name',
    'website' // nullable
  ];

 /******
 * Creating a one to many relationship to yarn.
 *******/
  public function yarn() {
    return $this->belongsTo(Yarn::class);
  }

  public function scopeSearch($query, $keywords) {
    return $query->where('brand_name', 'LIKE', '%'.$keywords.'%');
  }

}
