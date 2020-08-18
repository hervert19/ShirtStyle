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
        return view('registro')
            ->with("empresa", $empresa)
            ->with("usuario", $usuario)
            ->with("articulos", $articulos);
    }

    public function FinalizarCompra()
    {
        $idusuario = $this->InitSesion();
        $articulos = $this->getArticulos($idusuario);
        $usuario = Usuarios::find($idusuario);
        $empresa = $this->getFooter();
        $tiposenvio["Economico"] = TiposEnvio::find(1);
        $tiposenvio["Express"] = TiposEnvio::find(2);
        $carrito = Carrito::where("idusuario", $idusuario)->with('producto')->get();
        return view('finalizar')
            ->with("empresa", $empresa)
            ->with("usuario", $usuario)
            ->with("carrito", $carrito)
            ->with("tiposenvio", $tiposenvio)
            ->with("articulos", $articulos);
    }

    public function InsertarProducto(Request $request)
    {
        $idproducto = $request->input('idproducto');
        $talla = $request->input('talla');
        $cantidad = $request->input('cantidad');
        $inventario = Inventario::where("idproducto", $idproducto)->where("idtalla", $talla)->get();
        $max = 0;
        foreach ($inventario as $item) {
            $max = $item->disponible;
        }
        if ($cantidad > $max) {
            $response["status"] = "warning";
            $response["msg"] = "La cantidad maxima de este artículo es $max";
        } else {
            $idusuario = $this->InitSesion();
            if ($idusuario != 0) {
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
            } else {
                $response["status"] = "error";
                $response["msg"] = "Error de sesión, vualva a cargar la página";
            }
        }
        return response()->json($response);
    }

    public function ValidateInsertProduct()
    {
    }

    public function EliminarProducto(Request $request)
    {
        $idcarrito = $request->input('idcarrito');
        $delete = Carrito::where('idcarrito', $idcarrito)->delete();
        if ($delete) {
            $response["status"] = "success";
            $response["msg"] = "Se elimino el artículo";
        } else {
            $response["status"] = "error";
            $response["msg"] = "Ocurrio un error, no se elimino";
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
