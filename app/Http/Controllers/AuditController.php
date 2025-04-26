<?php
namespace App\Http\Controllers;

use App\Http\Resources\AuditResource;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    //
    public function index(Request $request)
    {
        // You can paginate or filter as needed
        $audits = Audit::latest()->get();

        return AuditResource::collection($audits);
    }
}
