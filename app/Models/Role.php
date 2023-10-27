<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;



    protected $fillable=['name','slug'];
    
    public function user()
    {
    
        return $this->belongsToMany(User::class);
    
    
    }

    public function permission()
{

    return $this->belongsToMany(Permission::class);


}



}
