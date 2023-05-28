<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kana',
        'tel',
        'email',
        'postcode',
        'address',
        'birthday',
        'gender',
        'memo'
    ];

    /*
    *   顧客検索
    */
    public function scopeSearchCustomers($query, $input = null)
    {
        // 入力された場合
        if (!empty($input))
        {
            // カナと電話番号が一致した場合、一致したデータを返す
            if (Customer::where('kana','like',$input. '%')
            ->orWhere('tel','like',$input.'%') ->exists())
            {
                return $query->where('kana','like',$input.'%')
                ->orWhere('tel','like',$input.'%');
            }
        }
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
