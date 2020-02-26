<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReviewComment
 *
 * @property int $id
 * @property int $review_id
 * @property int $user_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReviewComment whereUserId($value)
 * @mixin \Eloquent
 */
class ReviewComment extends Model
{
    //
}
