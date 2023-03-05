<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YarnWeight extends Model
{
    protected $primaryKey = 'yarn_weight_id';
    public $timestamps = false;
    /***********************
    * a yarn weight of yarn_weight_id = 11,
    * means the yarn is roving or batts.
    * These yarns may be spun up in future and become handspun yarn.
    *****************************/
}
