<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'date', 'realisator',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

	public $timestamps = false;
}
