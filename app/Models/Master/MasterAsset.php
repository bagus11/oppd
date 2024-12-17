<?php

namespace App\Models\Master;

use App\Models\Setting\MasterCountry;
use App\Models\Setting\MasterSatgas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAsset extends Model
{
    use HasFactory;
    protected $guarded = [];
    function countryRelation() {
        return $this->hasOne(MasterCountry::class,'id','country');
    }
    function satgasRelation(){
        return $this->hasMany(MasterSatgas::class,'name','satgas');
    }
}
