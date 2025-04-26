<?php
namespace App\Models;

use App\Models\StockMovement;
use App\Models\Stocks;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

class Products extends Model implements AuditableContract
{
    //
    use HasUuids, HasFactory, SoftDeletes, Auditable;
    protected $fillable = [
        'name',
        'supplier_id',
        'product_image',
        'price',
        'properties',
    ];

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    public $incrementing  = false;
    protected $casts      = [
        'properties' => 'array',
    ];
    protected $dates   = ['deleted_at'];
    protected $table   = 'products';
    public $timestamps = true;

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function stock()
    {
        return $this->hasOne(Stocks::class, 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
