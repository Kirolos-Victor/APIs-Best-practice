<?php

namespace App\Traits;

use Carbon\Carbon;

trait Timezone
{

    public function setCreatedAtAttribute()
    {
        $this->attributes['created_at'] = Carbon::now()->timezone(Auth()->user()->timezone)->toDateTimeString();
    }

    public function setUpdatedAtAttribute()
    {
        $this->attributes['updated_at'] = Carbon::now()->timezone(Auth()->user()->timezone)->toDateTimeString();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(Auth()->user()->timezone)->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(Auth()->user()->timezone)->toDateTimeString();
    }


}
