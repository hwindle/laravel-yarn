<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yarn extends Model
{

  public $timestamps = false;
  protected $primaryKey = 'yarn_id';

  protected $fillable = [
    'yarn_id',
    'brand_id',
    'yarn_name_id',
    'put_up_id',
    'yarn_weight_id',
    'notes',
    'handspun',
    'fibres_id',
    'metres_per_ball',
    'price_gbp',
    'ball_weight'
  ];

  /******
  * Creating a one to one relationship to yarn.
  *******/
   public function yarn_name() {
     return $this->hasOne(YarnName::class);
   }

   // many to one - there are 30 Rowan yarns for instance.
   public function brand_name() {
     return $this->hasMany(Brand::class);
   }

   // also many to one, many skeins/balls/hanks of yarn.
   public function put_up() {
     return $this->hasMany(PutUp::class);
   }

   // many to one
   public function yarn_weight() {
     return $this->hasMany(YarnWeight::class);
   }

   // many to one
   public function fibres() {
     return $this->hasMany(Fibre::class);
   }

   // many to one stash entries.
   public function stash_entries() {
     return $this->hasMany(YarnStash::class);
   }

}
