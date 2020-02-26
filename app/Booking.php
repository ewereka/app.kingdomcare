<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Booking
 *
 * @property int $id
 * @property int $parent_id
 * @property int $sitter_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereSitterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Booking extends Model
{
    //
}
