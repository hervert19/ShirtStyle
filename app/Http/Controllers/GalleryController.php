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

class GalleryController extends Controller
{

    public function index()
    {
        $articulos = $this->getArticulos(1);
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

    public function detalles($id)
    {
        $idproducto = base64_decode($id);
        $producto = Productos::find($idproducto);
        $imagenes = Galery::where("idproducto", $idproducto)->first();
        $inventario = Inventario::where("idproducto", $idproducto)->get();
        $tallas = Tallas::all();
        $articulos = $this->getArticulos(1);
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
        $articulos = $this->getArticulos(1);
        $empresa = $this->getFooter();
        $carrito = Carrito::where("idusuario", 1)->with('producto')->get();
        return view('carrito')
            ->with("empresa", $empresa)
            ->with("carrito", $carrito)
            ->with("articulos", $articulos);
    }

    public function Registro()
    {
        $articulos = $this->getArticulos(1);
        $usuario = Usuarios::find(1);
        $empresa = $this->getFooter();
        return view('registro')
            ->with("empresa", $empresa)
            ->with("usuario", $usuario)
            ->with("articulos", $articulos);
    }
}
