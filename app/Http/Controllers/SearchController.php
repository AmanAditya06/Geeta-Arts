<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->q;

        $products = DB::table('products')
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->where(function($q) use ($query){
                $q->where('name', 'LIKE', "%$query%")
                  ->orWhere('sku', 'LIKE', "%$query%")
                  ->orWhere('type', 'LIKE', "%$query%")
                  ->orWhere('description', 'LIKE', "%$query%");
            })
            ->get();

        return view('search-results', compact('products','query'));
    }
}

?>