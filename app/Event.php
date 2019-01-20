<?php
/**
 * model for events
 *
 * @author Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event',
        'description',
        'event_date',
        'status',
    ];
}
