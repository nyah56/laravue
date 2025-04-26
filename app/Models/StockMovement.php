<?php
namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

class StockMovement extends Model implements AuditableContract
{
    //
    use HasUuids, HasFactory, SoftDeletes, Auditable;
    protected $fillable = [
        'product_id',
        'date',
        'type',
        'quantity',
        'reason',
        'manifest_hardcopy',
        'meta',
    ];
    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    public $incrementing  = false;
    protected $casts      = [
        'contacts' => 'array',
    ];

    protected $table   = 'stock_movements';
    public $timestamps = true;
    protected $dates   = ['deleted_at'];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
