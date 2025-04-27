<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use HasUuids, SoftDeletes;
    protected $fillable  = ["name", "guard_name"];
    protected $table     = "role";
    public $incrementing = false;
    protected $keyType   = 'string';
    public $timestamps   = false;

}
