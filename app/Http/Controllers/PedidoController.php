<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cuenta;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::orderBy('_id','DESC')->get();
        $cuentas = Cuenta::orderBy('_id','DESC')->get();
        return view('pedidos.index', compact('pedidos', 'cuentas'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->cuenta_id = $request->cuenta_id;
        $pedido->producto = $request->producto;
        $pedido->cantidad = $request->cantidad;
        $pedido->valor = $request->valor;
        $pedido->total = $request->total_pedido;

        if($pedido->save()) {
            $response = [
                'success' => true
            ];
        } else {
            $response = [
                'success' => false
            ];
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        return response()->json($pedido);
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
        $pedido = Pedido::find($id);
        $pedido->cuenta_id = $request->cuenta_id;
        $pedido->producto = $request->producto;
        $pedido->cantidad = $request->cantidad;
        $pedido->valor = $request->valor;
        $pedido->total = $request->total_pedido;

        if($pedido->save()) {
            $response = [
                'success' => true
            ];
        } else {
            $response = [
                'success' => false
            ];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return response()->json(['success' => true]);
    }
}
