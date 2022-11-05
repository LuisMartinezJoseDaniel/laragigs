<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // 1. $fillable
    // 2.
    // protected $guarded =[]; //! we need validation for do this
    // 3.Provider/AppServiceProvider
    //*Filter by tag Check Controller index method
    //@Override
    public function scopeFilter($query, array $filters)
    {
        //* tag=value
        if (($filters['tag']) ?? false) {
            //query where tags like request('nameOfQueryParameter')
            $query->where('tags', 'like', '%' . request('tag') . '%');

        }
        //* ?search=value
        if (($filters['search']) ?? false) {
            //query where search like request('nameOfQueryParameter')
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
            ;

        }
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
