<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kodeine\Metable\Metable;
use Embed\Embed;
use Illuminate\Support\HtmlString;

/**
 * App\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $api_token
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property string|null $last_active_at
 * @property string|null $last_active_ip
 * @property string $first_name
 * @property string $last_name
 * @property string|null $city
 * @property string|null $region
 * @property string|null $phone
 * @property string|null $dob
 * @property int $registration_complete
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read mixed $average_rating
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviewsReceived
 * @property-read int|null $reviews_received_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviewsSent
 * @property-read int|null $reviews_sent_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User meta($alias = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastActiveAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastActiveIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRegistrationComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, Metable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'api_token',
        'last_login_at',
        'last_login_ip',
        'last_active_at',
        'last_active_ip',
        'city',
        'region',
        'phone',
        'avatar',
        'dob',
        'registration_complete',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'dob', 'phone'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function oauths() {
        return $this->hasMany(SocialAccount::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function reviewsSent() {
        return $this->hasMany(Review::class, 'review_by_id');
    }

    public function reviewsReceived() {
        return $this->hasMany(Review::class, 'review_for_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    /**
     * @param array|string $roles
     * @return bool
     */
    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     * @return bool
     */
    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function getAverageRatingAttribute() {
        $reviews = $this->reviewsReceived;
        $ratings = array();

        if ($reviews !== null) {
            foreach ($reviews as $review) {
                $rating = $review->rating;
                if (is_numeric($rating)) {
                    array_push($ratings, $rating);
                }
            }
        }

        $average = (count($ratings) > 0) ? (int)round(array_sum($ratings) / count($ratings)) : null;

        return $average;
    }

    public function getVideoResumeEmbed() {
        return Embed::create($this->video_resume);
    }

    public function hasSpecialExperience() {
        $fields = array(
            'experience_add_adhd',
            'experience_asd',
            'experience_visually_impaired',
            'experience_hearing_impaired',
            'experience_developmental',
            'experience_behavioral',
            'experience_down_syndrome',
            'experience_seizures'
        );
        $rVal = false;
        foreach ($fields as $field) {
            $rVal = ($this->getAttribute($field)) ? true : $rVal;
        }

        return $rVal;
    }

    public function buildSpecialExperience() {
        $fields = array(
            'experience_add_adhd',
            'experience_asd',
            'experience_visually_impaired',
            'experience_hearing_impaired',
            'experience_developmental',
            'experience_behavioral',
            'experience_down_syndrome',
            'experience_seizures'
        );
        $rVal = '';
        $format = '<div class="checkcontain"><img src="images/check.png" alt="checkmark"/><p>%s</p></div>';
        foreach ($fields as $field) {
            $rVal .= ($this->getAttribute($field)) ?
                sprintf($format, getExperienceNiceName($field)) : '';
        }

        return new HtmlString($rVal);
    }

    public function hasChildren() {
        $rVal = false;
        if (isset($this->children) && is_string($this->children)) {
            $children = json_decode($this->children);
            $rVal = (is_array($children) && count($children) > 0) ? true : false;
        }
        return $rVal;
    }
    public function buildChildIcons() {
        $rVal = '';
        $infants = 0;
        $toddlers = 0;
        $school_age = 0;
        if (isset($this->children) && is_string($this->children)) {
            $children = json_decode($this->children);
            if (is_array($children) && count($children) > 0) {
                $rVal = '<div class="childicons scrollhide">';
                foreach ($children as $child) {
                    if (is_object($child)) {
                        if ($child->age === "infant") $infants++;
                        elseif ($child->age === "toddler") $toddlers++;
                        elseif ($child->age === "school_age") $school_age++;
                    }
                }
                if ($infants > 0) {
                    $rVal .= ' <img class="childicon" src="images/infant-icon-nocircle.svg" alt="infant icon"/>' . $infants;
                }
                if ($toddlers > 0) {
                    $rVal .= ' <img class="childicon" src="images/toddler-icon-nocircle.svg" alt="toddler icon"/>' . $toddlers;
                }
                if ($school_age > 0) {
                    $rVal .= ' <img class="childicon" src="images/school-age-icon-nocircle.svg" alt="school age icon"/>' . $school_age;
                }
                $rVal .= '</div>';
            }
        }

        return new HtmlString($rVal);
    }

}
