<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'description', 'url'
    ];

    // public function series()
    // {
        /**
         * Not all videos belongs to series
         * Some videos can be alone, or grupped in other way
         * Videos can belong anything that is not related to series
         * This is where polymorfic relations come into play
         * It allows a model, like video to belong to something else without being specific what this else is
         */
    //     return $this->belongsTo(Series::class);
    // }

    /**
     * Method name is same as type in db (watchable_type, watchable_id)
     * If for example we call it parent than in morphTo name must be type from db (watchable)
     * public function parent()
     * {
     *    return $this->morphTo('watchable');
     * }
     * 
     * If we want to override type in db (watchable_type is class name, App\Series)
     * We can add in AppServiceProvider's function boot -> morphMap
     * Relation::morphMap([
     *      'series' => 'App\Series',
     *       'collection' => 'App\Collection'
     *   ]);
     * And in DB we change App\Series to series and App\Collection to collection
     * 
     */
    public function watchable()
    {
        return $this->morphTo();
    }
}
