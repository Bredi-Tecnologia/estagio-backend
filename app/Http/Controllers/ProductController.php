<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Service\ProdutoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    private ProdutoService $produtoService;
    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }
    public function index()
    {
        $products = $this->produtoService->getAllProducts();

        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $validParams = $request->validate();
        try {
            DB::beginTransaction();

            $this->produtoService->createProduct($validParams['product']);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $exception){
            return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao criar o produto.']);
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function update(ProductRequest $request,$id)
    {
        $validParams = $request->validate();
        try {
            DB::beginTransaction();
            $this->produtoService->editProduct($id, $validParams['product']);

            DB::commit();
         return redirect()->route('products.index');
        }catch (\Exception $exception){
            return redirect()->back()->withInput()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function filter($category_id = null)
    {

        $products = $this->produtoService->filterByCategory($category_id);
        return response()->json($products);
    }

    public function destroy($productId)
    {
        $this->produtoService->deleteProduct($productId);

        return redirect()->route('products.index');
    }
}
