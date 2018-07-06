<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

/**
 * Class Player.
 */
class Player extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'team_id',
        'first_name',
        'last_name',
        'image_url'
        
    ];

     /**
     * The attributes that are hidden from query data.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * define the relation with Team table One-to-One
     * 
     * @param null
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
