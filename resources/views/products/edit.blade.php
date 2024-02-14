@extends('layouts.form')
@section('content')
    <h2 class="mb-4">Editar Produto</h2>
    <form method="post" action="{{ route('product.update',$product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category" class="form-label">Categoria</label>
            <select name="category_id" id="category" class="form-select">
                <option value="4" {{ $product->category_id == 4 ? 'selected' : '' }}>Alimentos</option>
                <option value="5" {{ $product->category_id == 5 ? 'selected' : '' }}>Informática</option>
                <option value="2" {{ $product->category_id == 2 ? 'selected' : '' }}>Eletrodomésticos</option>
                <option value="3" {{ $product->category_id == 3 ? 'selected' : '' }}>Celulares</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name"  class="form-label">Nome do Produto</label>
            <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" name="price" id="price" class="form-control" value="{{$product->price}}" step="0.01" required>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-warning m-1">
            <i class="mdi mdi-arrow-left"></i> Voltar
        </a>
        <button type="submit" class="btn btn-primary m-1">Salvar edição</button>
    </form>
@endsection
