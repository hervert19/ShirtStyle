<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Productos;
use App\Models\Inventario;
use App\Models\Tallas;
use App\Models\Galery;
use App\Models\Usuarios;
use App\Models\Carrito;
use App\Models\Empresa;
use App\Models\TiposEnvio;
use App\Models\Pedidos;

class GalleryController extends Controller
{

    public function index()
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $empresa = $this->getFooter();
        $select["color"] = Productos::select('color')->distinct()->get();
        $select["marca"] = Productos::select('marca')->distinct()->get();
        $productos = Productos::with('fotos')->with("inventarioproducto")->paginate(9);
        return view('index')
            ->with("articulos", $articulos)
            ->with("empresa", $empresa)
            ->with("select", $select)
            ->with("productos", $productos);
    }

    public function InitSesion()
    {
        $value = session()->get('key');
        if ($value == null || $value == "") {
            $sesion = $this->ValidateCode();
            $result = $this->CreateSesion($sesion);
            if ($result["bandera"] == true) {
                session()->put('key', $sesion);
                session()->put('idusuario', $result["idusuario"]);
                $idusuario = $result["idusuario"];
            } else {
                $idusuario = 0;
            }
        } else {
            $idusuario = session()->get('idusuario');
        }
        return $idusuario;
    }

    public function CreateSesion($sesion)
    {
        $NewUser = Usuarios::create(['sesion' => $sesion]);
        $response["bandera"] = true;
        if (!$NewUser) {
            $response["bandera"] = false;
            $response["idusuario"] = null;
        } else {
            $temporal = Usuarios::where("sesion", $sesion)->first();
            $response["idusuario"] = $temporal->idusuario;
        }
        return $response;
    }

    public function detalles($id)
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $idproducto = base64_decode($id);
        $producto = Productos::find($idproducto);
        $imagenes = Galery::where("idproducto", $idproducto)->first();
        $inventario = Inventario::where("idproducto", $idproducto)->get();
        $tallas = Tallas::all();
        $empresa = $this->getFooter();
        return view('mostrar')
            ->with("empresa", $empresa)
            ->with("producto", $producto)
            ->with("imagenes", $imagenes)
            ->with("inventario", $inventario)
            ->with("tallas", $tallas)
            ->with("articulos", $articulos);
    }

    public function MisArticulos()
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $empresa = $this->getFooter();
        $carrito = Carrito::where("idusuario", $idusuario)->with('producto')->get();
        return view('carrito')
            ->with("empresa", $empresa)
            ->with("carrito", $carrito)
            ->with("articulos", $articulos);
    }

    public function Registro()
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $usuario = Usuarios::find($idusuario);
        $empresa = $this->getFooter();
        if ($articulos != 0) {
            return view('registro')
                ->with("empresa", $empresa)
                ->with("usuario", $usuario)
                ->with("articulos", $articulos);
        } else {
            return redirect()->route('MisArticulos');
        }
    }

    public function FinalizarCompra()
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $usuario = Usuarios::find($idusuario);
        $empresa = $this->getFooter();
        if ($usuario->registro == 1) {
            $tiposenvio["Economico"] = TiposEnvio::find(1);
            $tiposenvio["Express"] = TiposEnvio::find(2);
            $carrito = Carrito::where("idusuario", $idusuario)->with('producto')->get();
            return view('finalizar')
                ->with("empresa", $empresa)
                ->with("usuario", $usuario)
                ->with("carrito", $carrito)
                ->with("tiposenvio", $tiposenvio)
                ->with("articulos", $articulos);
        } else {
            return redirect()->route('MisArticulos');
        }
    }

    public function InsertarProducto(Request $request)
    {
        $idusuario = $this->InitSesion();
        $idproducto = $request->input('idproducto');
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad');
        $Stok = $this->ValidateInsertProduct($idusuario, $idproducto, $talla);
        if ($cantidad > $Stok["max"]) {
            if ($Stok["existe"] == false) {
                $response["status"] = "warning";
                $response["msg"] = "La cantidad maxima de este artículo es " . $Stok["max"];
            } else {
                $response["status"] = "warning";
                $response["msg"] = "Ya tienes agregado el producto al maximo disponible.";
            }
            $response["cantidadcarrito"] = 0;
        } else {
            if ($Stok["existe"] == false) {
                $NewArticulo = Carrito::create([
                    'idproducto' => $idproducto,
                    'idusuario' => $idusuario,
                    'cantidad' => $cantidad,
                    'idtalla' => $talla,
                ]);
                if ($NewArticulo) {
                    $response["status"] = "success";
                    $response["msg"] = "Se añadio a tus artículo";
                } else {
                    $response["status"] = "error";
                    $response["msg"] = "Ocurrio un error, no agregado";
                }
                $response["cantidadcarrito"] = 1;
            } else {
                $sumacantidad = $Stok["agregados"] + $cantidad;
                $UpdateArticulo = Carrito::where('idcarrito', $Stok["idcarrito"])->update(['cantidad' => $sumacantidad]);
                if ($UpdateArticulo) {
                    $response["status"] = "success";
                    $response["msg"] = "Se actualizo el producto en carrito";
                } else {
                    $response["status"] = "error";
                    $response["msg"] = "Ocurrio un error, no agregado";
                }
                $response["cantidadcarrito"] = 0;
            }
        }
        return response()->json($response);
    }

    public function ValidateInsertProduct($idusuario, $idproducto, $idtalla)
    {
        $inventario = Inventario::where("idproducto", $idproducto)->where("idtalla", $idtalla)->get();
        $max = 0;
        foreach ($inventario as $item) {
            $max = $item->disponible;
        }
        $productos = Carrito::where("idusuario", $idusuario)->where("idproducto", $idproducto)->where("idtalla", $idtalla)->first();
        if (count($productos) != 0) {
            $response["existe"] = true;
            $response["agregados"] = $productos->cantidad;
            $response["max"] = $max - $productos->cantidad;
            $response["idcarrito"] = $productos->idcarrito;
        } else {
            $response["existe"] = false;
            $response["max"] = $max;
        }
        return $response;
    }

    public function EliminarProducto(Request $request)
    {
        $idcarrito = $request->input('idcarrito');
        $delete = Carrito::where('idcarrito', $idcarrito)->delete();
        if ($delete) {
            $response["status"] = "success";
            $response["msg"] = "Se elimino el artículo";
            $response["cantidadcarrito"] = 1;
        } else {
            $response["status"] = "error";
            $response["msg"] = "Ocurrio un error, no se elimino";
            $response["cantidadcarrito"] = 0;
        }
        return response()->json($response);
    }

    public function UpdateProducto(Request $request)
    {
        $idcarrito = $request->input('idcarrito');
        $operacion = $request->input('operacion');
        $cantidad = $request->input('cantidad');
        if ($operacion == "add") {
            $max = $this->MaxProduct($idcarrito);
            if ($cantidad >= $max) {
                return response()->json(["status" => "warning", "msg" => "La cantidad maxima de este artículo es $max"]);
            } else {
                $cantidad++;
            }
        } else {
            $cantidad--;
        }
        $update = Carrito::where('idcarrito', $idcarrito)->update(['cantidad' => $cantidad]);
        if ($update) {
            $response["status"] = "success";
            $response["msg"] = "Se actualizo el artículo";
        } else {
            $response["status"] = "error";
            $response["msg"] = "Ocurrio un error, no se actualizo";
        }
        return response()->json($response);
    }

    public function MaxProduct($idcarrito)
    {
        $Item = Carrito::find($idcarrito);
        $inventario = Inventario::where("idproducto", $Item->idproducto)->where("idtalla", $Item->idtalla)->get();
        $cantidad = 0;
        foreach ($inventario as $item) {
            $cantidad = $item->disponible;
        }
        return $cantidad;
    }

    public function UpdateRegistro(Request $request)
    {
        $idusuario = $request->input('idusuario');
        $user = Usuarios::find($idusuario);
        $bandera = false;
        if ($user->registro == 1) {
            $bandera = true;
        }
        $item["nombre"] = $request->input('nombre');
        $item["apellido"] = $request->input('apellido');
        $item["telefono"] = $request->input('telefono');
        $item["email"] = $request->input('email');
        $item["direccion"] = $request->input('direccion');
        $item["cp"] = $request->input('cp');
        $item["ciudad"] = $request->input('ciudad');
        $item["pais"] = $request->input('pais');
        $item["recibe"] = $request->input('recibe');
        $item["recibetelefono"] = $request->input('telefonorecibe');
        $item["recibedireccion"] = $request->input('direccionrecibe');
        $item["recibecp"] = $request->input('cprecibe');
        $item["recibeciudad"] = $request->input('ciudadrecibe');
        $item["recibepais"] = $request->input('paisrecibe');
        $item["registro"] = 1;
        $update = Usuarios::where('idusuario', $idusuario)->update($item);
        if ($update) {
            $response["status"] = "success";
            $response["msg"] = "Se actualizo el registro";
        } else {
            if ($bandera == true) {
                $response["status"] = "success";
                $response["msg"] = "No hubo cambios";
            } else {
                $response["status"] = "error";
                $response["msg"] = "Ocurrio un error, no se registro";
            }
        }
        return response()->json($response);
    }

    public function TerminarRegistro(Request $request)
    {
        $idusuario = $request->input('idusuario');
        $ValidateCard["tipotarjeta"] = $request->input('tipotarjeta');
        $ValidateCard["numerotarjeta"] = $request->input('numerotarjeta');
        $ValidateCard["expiracion"] = $request->input('expiracion');
        $ValidateCard["seguridad"] = $request->input('seguridad');
        $ValidateCard["titular"] = $request->input('titular');
        $responseCard =  $this->ValidateCard($ValidateCard);
        if ($responseCard == true) {
            $Pedido["numpedido"] = session()->get('key');
            $Pedido["idusuario"] = $idusuario;
            $Pedido["idenvio"] = $request->input('eleccionenvio');
            $Pedido["subtotal"] = $request->input('subtotal');
            $TipoEnvio = TiposEnvio::find($Pedido["idenvio"]);
            $Pedido["costoenvio"] = $TipoEnvio->precio;
            $Pedido["total"] = $request->input('total');
            $NewPedido = Pedidos::create($Pedido);
            if ($NewPedido) {
                $this->UpdateStock($idusuario);
                Usuarios::where("idusuario", $idusuario)->update(["finalizo" => 1]);
                session()->forget(['key', 'idusuario']);
                session()->flush();
                $response["status"] = "success";
                $response["numpedido"] = $Pedido["numpedido"];
                $response["total"] = $Pedido["total"];
                $response["idenvio"] = $Pedido["idenvio"];
            } else {
                $response["status"] = "error";
                $response["msg"] = "No se pudo finalizar el pedido, vuelve a intentar";
            }
        }
        return response()->json($response);
    }

    public function UpdateStock($idusuario)
    {
        $carrito = Carrito::where("idusuario", $idusuario)->get();
        foreach ($carrito as $item) {
            $inventario = Inventario::where("idproducto", $item->idproducto)->where("idtalla", $item->idtalla)->first();
            $stock = $inventario->disponible;
            $newstock["disponible"] = $stock - $item->cantidad;
            $newstock["vendido"] = $item->cantidad;
            Inventario::where("idproducto", $item->idproducto)->where("idtalla", $item->idtalla)->update($newstock);
        }
    }

    public function ValidateCard($data)
    {
        /*Conexion hacia la pasarla de pagos API REST*/
        return true;
    }

    public function ValidateCode()
    {
        $code = $this->GenerateCode();
        $users = Usuarios::where('sesion', $code)->get();
        if (count($users) == 0) {
            return $code;
        } else {
            $this->ValidateCode();
        }
    }

    public function GenerateCode()
    {
        $code = "";
        $caracteres = "AB0CDE1FGHI2JK3LM4NO5PQ6RS7TUV8WXY9Z";
        $final = array();
        $longitud = 10;
        for ($i = 0; $i <= $longitud; $i++) {
            $final[$i] = $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        foreach ($final as $datos) {
            $code .= $datos;
        }
        return $code;
    }

    public function getArticulos($idusuario)
    {
        $articulos = Carrito::where("idusuario", $idusuario)->with('producto')->count();
        if ($articulos == null) {
            $articulos = 0;
        }
        return $articulos;
    }

    public function getFooter()
    {
        $empresa = Empresa::first();
        return $empresa;
    }
}
