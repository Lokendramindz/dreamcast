<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'role_name',
        // Add other fields here if needed
    ];

    // Define any relationships, for example, if a role has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

