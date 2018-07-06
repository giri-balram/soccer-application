<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Player;

/**
 * Class Team.
 */
class Team extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'logo_url',
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
     * define the relation with Player table One-to-Many
     * 
     * @param null
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * deleting the team and making it's corresponding players orphan 
     * 
     * @param null
     */
    public function delete()
    {
        if ($this->players) {
            $this->players->each(function($player) {
                $player->team_id = null;
                $player->save();
            });
        }

        return parent::delete();
    }
}
