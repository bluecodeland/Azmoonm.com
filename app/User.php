<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'mobile', 'email',  'picture', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    /**
    * Check if the user has the role.
    *
    * @var array
    */
    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name',$role);
        }

        return false;

    }

    /**
    * Check if the user has the role.
    *
    * @var array
    */
    public function hasSeat($user_id)
    {
        $user = User::find($user_id);
        if($user->seat){
            return sprintf("%04d", $user->seat->seat_number);
        }
        return false;
    }

    /**
    * Assign user to the role.
    *
    * @var array
    */
    public function assign($role)
    {
        if(is_string($role))
        {
            return $this->roles()->save(
                Role::whereName($role)->firstOrFail()
            );
        }

        return $this->roles()->save($role);

    }

    /**
     * Get all of the seats for the user.
     */
    public function seat()
    {
        return $this->hasOne(Seat::class);
    }


    /**
     * Get all of the schools for the user.
     */
    public function schools()
    {
        return $this->belongsToMany(School::class)->withPivot('sort_order')->orderBy('sort_order');
    }
    /**
     * Get all of the schools for the user.
     */
    public function schoolAdmin()
    {
        return $this->hasOne(School::class, 'id', 'admin_id');
    }

    /**
     * Get number of schools for the user.
     */
    public function schoolCount()
    {
        return $this->schools()->count();
    }

    /**
     * Get number of schools for the user.
     */
    public function getSchoolsCount($user_id)
    {
        $user = User::find($user_id);
        return $user->schools()->count();
    }

    /**
     * Reorder the schools for a user
     */
    public function reorderSchools($user_id)
    {
        $user = User::findOrFail($user_id);
        $schools = $user->schools()->orderBy('sort_order')->get();
        $sort_order = 1;
        foreach($schools as $item) {
            $item->pivot->sort_order = $sort_order;
            $item->pivot->save();
            $sort_order++;
        }
    }

    /**
     * Get the next available school order
     */
    public function getNextSchoolOrder($user_id)
    {
        $user = User::findOrFail($user_id);

        if (!$user->schools->isEmpty()) {
            return $user->schools()->orderBy('sort_order')->get()->last()->pivot->sort_order + 1;
        }else{
            return 1;
        }
    }

    /**
     * Get all of the tasks for the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get all of the applications for the user.
     */
    public function application()
    {
        return $this->hasOne(Application::class);
    }

    /**
     * Get the number of users in the system
     */
    public static function getCount()
    {
        return User::count();
    }

    /**
     * Get the user's mobile and format it.
     *
     * @param  string  $value
     * @return string
     */
    public function getMobileAttribute($value)
    {
        return getHindiNumerals($value);
    }


    /**
     * set the user's mobile after formatting it.
     *
     * @param  string  $value
     * @return void
     */
    public function setMobileAttribute($value)
    {
        $this->attributes['mobile'] = getHindiNumerals($value);
    }

    /**
     * check if user has a picture
     *
     * @param  string  $value
     * @return void
     */
    public function hasPicture()
    {
        if($this->picture=='00000000.png')
        {
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get all of the results for the user.
     */
    public function results()
    {
        return $this->hasOne(Result::class);
    }

    /**
     * check if user has viewed the results
     *
     * @param  string  $value
     * @return void
     */
    public function viewedResults($user_id){
        $results = Result::where('user_id', $user_id)->first();

        if($results->viewed_at=='0000-00-00 00:00:00')
        {
            return false;
        }else{
            return true;
        }
    }

}
