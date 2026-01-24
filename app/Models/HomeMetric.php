<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeMetric extends Model
{
    protected $fillable = [
        'home_section_id',
        'name',
        'value'
    ];

    public function section()
    {
        return $this->belongsTo(HomeSection::class, 'home_section_id');
    }

}
