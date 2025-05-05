<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

class Supplier extends Model implements AuditableContract
{
    //
    use HasUuids, HasFactory, SoftDeletes, Auditable;
    protected $fillable = [
        'name',
        // 'company_logo',
        'address',
        'contacts',
    ];

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    public $incrementing  = false;
    protected $casts      = [
        'contacts' => 'array',
    ];

    protected $table   = 'suppliers';
    public $timestamps = true;
    protected $dates   = ['deleted_at'];
    public function product()
    {
        return $this->hasMany(Products::class, 'supplier_id');
    }
}
