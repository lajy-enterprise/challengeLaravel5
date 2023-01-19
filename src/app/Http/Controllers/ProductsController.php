<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Products;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Yajra\Datatables\Datatables;

class ProductsController extends Controller
{
    
    public function __construct()
    {
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function getRecords(Request $request)
    {
        $search  = $request->input('search.value');
        
        $order   = isset($_GET[ 'order' ]) ? $_GET[ 'order' ] : [];

        $count_total = \DB::table('products')->count();

        $count_filter = \DB::table('products')
                            ->Where('product_key', 'LIKE', '%' . $search . '%')
                            ->orWhere('notes', 'LIKE', '%' . $search . '%')
                            ->count();

        $products = \DB::table('products');

        $products = $products->take(10);

        return Datatables::of($products)
                         ->with([
                             "recordsTotal"    => $count_total,
                             "recordsFiltered" => $count_filter,
                         ])
                         ->make(TRUE);
    }

    public function mostrarDificil()
    {
        return view('dificil');
    }

    public function getRecordsDificil(Request $request)
    {
        $searchUno  = $request->input('searchUno');

        $searchDos  = $request->input('searchDos');

        $per_page  = $request->input('per_page') ? $request->input('per_page') : 10;

        
        $products = Products::
                            when($searchUno, function($query, $searchUno) {
                                    $query->Where('product_key', 'LIKE', '%' . $searchUno . '%');
                                })
                            ->when($searchDos, function($query, $searchDos) {
                                    $query->Where('notes', 'LIKE', '%' . $searchDos . '%');
                                })
                            ->paginate($per_page);

        return $products;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
