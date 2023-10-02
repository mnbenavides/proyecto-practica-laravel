<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Cliente;


class PedidoController extends Controller
{
    /**
     * Lista de pedidos 
     * @param  Illuminate\Http\Request (codio del pedido, documento del cliente y el tipo del documento del cliente); 
     * @return Illuminate\Http\Responde;
     */
    public function search(Request $request){
        $tipo = request()->input('tipo');
        $documento = request()->input('documento');
        $codigo = request()->input('codigo');
        // Validar que los datos no estén nulos
        if ($tipo === null || $documento === null || $codigo === null) {
            return response()->json(['error' => 'Uno o más de los datos ingresados son nulos.'], 422);
        }
        //Realizar la consulta a la base de datos
       $detallePedido = Pedido::
       select ('clientes.nombre as cliente' , 'pedidos.codigoPedido', 'clientes.direccion','productos.nombre', 'productos.referencia','pedidos.cantidad','pedidos.estadoPedido', 'pedidos.fechaEstimadaEntrega')
        ->join('clientes', 'clientes.id', '=', 'pedidos.clienteID')
        ->join('productos','pedidos.productoID' ,'=','productos.id')
        ->where(['clientes.documentoCliente'=> $documento,'clientes.tipoDocumento'=> $tipo, 'pedidos.codigoPedido' => $codigo ])
        ->get(); 
         return response()->json(['detalle'=>$detallePedido],200);

    }
}
