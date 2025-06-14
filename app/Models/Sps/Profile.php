<?php

namespace App\Models\Sps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'profiles';

    public static function boot()
    {

        parent::boot();

        static::creating(function ($profile) {
            do {
                $profile->ref_number = request()->venue . '-SPS-' . random_int(100000, 999999);
                // $profile->ref_number = request()->venue.'-SPS-' . Str::upper(Str::random(10)); // e.g. "AB12CD34XY"
            } while (self::where('ref_number', $profile->ref_number)->exists());
        });
    }

    public function items()
    {
        return $this->hasMany(StoredItem::class, 'profile_id');
    }
    
}
