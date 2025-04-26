<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    use HasUuids;
    protected $fillable  = ["name", "guard_name"];
    protected $table     = "role";
    public $incrementing = false;
    protected $keyType   = 'string';
    public $timestamps   = false;

}
