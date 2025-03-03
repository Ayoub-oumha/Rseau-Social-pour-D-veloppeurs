<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'headline' ,
        'work',
        'location',
        'bio',
        'github_url',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function languages()
    {
        return $this->hasMany(Language::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    // sent requests
    public function sentRequests()
    {
        return $this->hasMany(Connection::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(Connection::class, 'receiver_id');
    }

    public function connections()
    {
        return $this->hasMany(Connection::class, 'sender_id')
                    ->where('status', 'accepted')
                    ->orWhere('receiver_id', $this->id)
                    ->where('status', 'accepted');
                    
    }
    public function pendingRequests()
    {
        return $this->hasMany(Connection::class, 'receiver_id')
                    ->where('status', 'pending');
    }
    public function friendships()
    {
        return $this->hasMany(Connection::class, 'sender_id')
            ->where('status', 'accepte')
            ->orWhere('receiver_id', $this->id);
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'connections', 'receiver_id', 'sender_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'connections', 'sender_id', 'receiver_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }
//    public function friends()
//     {
//         return $this->belongsToMany(User::class, 'connections', 'sender_id', 'receiver_id')
//             ->wherePivot('status', 'accepted')
//             ->withTimestamps()
//             ->union(
//                 $this->belongsToMany(User::class, 'connections', 'receiver_id', 'sender_id')
//                     ->wherePivot('status', 'accepted')
//                     ->withTimestamps()
//             );
//     }

    
 
}
