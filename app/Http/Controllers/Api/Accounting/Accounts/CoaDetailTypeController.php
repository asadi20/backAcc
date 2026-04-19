<?php

namespace App\Http\Controllers\Api\Accounting\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounting\CoaDetailType;
use Illuminate\Http\Request;

class CoaDetailTypeController extends Controller
{
    public function index()
    {
        // tip: do not use space after comma in column name of a relation columns in below so laravel assume colmn name have a space!
        $links = CoaDetailType::with(['account:id,code,name','detail_type:id,code,name'])->get();
        return response()->json([
            'success'=>true,
            'message'=> 'all sub',
            'data'=> $links,
            'error'=> null,
            'meta'=>[
                'timestap'=> now(),
                'counts'=> $links->count()
            ]
        ] , 200);
    }

    public function show($id)
    {
        
    }


    public function store(Request $request)
    {
        $links = CoaDetailType::create($request->all());
        return response()->jsonp($links);
    }
    
}
