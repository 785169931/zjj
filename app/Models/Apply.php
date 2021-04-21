<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'apply';

    protected $dateFormat = 'U';

    const UPDATED_AT = false;

    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'type',
        'author',
        'benefits',
        'image_url',
        'url_dy',
        'url_ks',
        'script_url',
        'created_at'
    ];

    const HZP = 1;
    const LS  = 2;
    const RQ  = 3;

    const TYPE = [
        self::HZP => '化妆品',
        self::LS  => '零食',
        self::RQ  => '日常',
    ];

    public function getCreatedAtAttribute($value)
    {
        return date("Y-m-d H:i:s",$value);
    }
}
