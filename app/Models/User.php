<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'is_active',
    'phone',
    'campus',
    'study_program',
    'semester',
    'address',
    'profile_photo',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'is_active' => 'boolean',
        ];
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function financePlans()
    {
        return $this->hasMany(ScholarshipFinancePlan::class);
    }

    public function aiSemesterPlanners()
    {
        return $this->hasMany(AiSemesterPlanner::class);
    }

    public function dailyTransactions()
    {
        return $this->hasMany(DailyTransaction::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function hasBookmarked(string $type, int $id): bool
    {
        return $this->bookmarks()
            ->where('bookmarkable_type', $type)
            ->where('bookmarkable_id', $id)
            ->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }
}
