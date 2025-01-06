<?php

namespace App\Models\Transaction\Asset;

use App\Models\Master\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    function assetRelation() {
        return $this->hasOne(Asset::class,'asset_code', 'asset_code');
    }
    function userRelation() {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
