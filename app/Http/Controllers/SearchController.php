<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->query('q');
        $results = DB::select("SELECT id, number, issuer, ts_rank(search_vector, plainto_tsquery(?)) AS rank FROM licenses WHERE search_vector @@ plainto_tsquery(?) ORDER BY rank DESC LIMIT 50", [$q, $q]);
        return response()->json($results);
    }
}
