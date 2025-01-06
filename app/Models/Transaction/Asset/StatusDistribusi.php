<?php

namespace App\Models\Transaction\Asset;

use App\Models\Master\Asset;
use App\Models\Master\MasterAsset;
use App\Models\Setting\MasterSatgas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDistribusi extends Model
{
    use HasFactory;
    protected $table = 'status_distribusi';
    protected $guarded = [];

    function destinationRelation() {
        return $this->hasOne(MasterSatgas::class,'id','des_location');
    }
    function locationRelation() {
        return $this->hasOne(MasterSatgas::class,'id','current_location');
    }
    function detailRelation() {
        return $this->hasMany(StatusDistribusiDetail::class,'distribution_code','distribution_code');
    }
    function assetRelation() {
        return $this->hasOne(Asset::class,'asset_code', 'asset_code');
    }
    function reporterRelation() {
        return $this->hasOne(User::class,'id','reporter');
    }
}
