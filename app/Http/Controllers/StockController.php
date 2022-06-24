<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class StocksController extends Controller
{
    public function index()
    {


        $stocks = Stock::all();

        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        // $stock = Stock::find($id);

        return view('admin.stocks.create');
    }

    public function store(Request $request)
    {
        $stock = Stock::create($request->all());

        return redirect()->route('admin.stocks.index', compact('stock'));
    }

    public function edit(Stock $stock, $id)
    {
        $stock = Stock::find($id);

        return view('admin.stocks.edit', compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        $stock->update($request->all());

        return redirect()->route('admin.stocks.index');
    }


    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();

        return back();
    }
}
