<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YarnStash extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'yarn_stash_id';

  protected $fillable = [
    'yarn_id',
    'user_id',
    'brought_at',
    'no_of_balls',
    'total_price',
    'total_meterage',
    'kept_in',
    'label',
    'stash_pic_id',
    'nearest_col_id',
    'colourway',
    'purchase_date',
    'dye_lot',
    'for_sale'
  ];

  /* one yarn to many stash entries. */

  /* one user to many stash entries. */

  /* one to one for stash picture */
  public function stash_picture() {
    return $this->hasOne(UploadedImg::class);
  }

  /* one to many nearest cols. Many red yarns, one entry in other table */

}
