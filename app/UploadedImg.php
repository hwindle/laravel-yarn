<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploaded_img extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'uploaded_img_id';

  protected $fillable = [
    'user_id',
    'img_url'
  ];
}
