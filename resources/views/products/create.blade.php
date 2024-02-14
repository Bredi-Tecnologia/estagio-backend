@extends('layouts.form')
@section('content')
    <h2 class="mb-4">Novo Produto</h2>
    <form method="post" action="{{ route('product.store') }}">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label">Categoria</label>
            <select name="category_id" id="category" class="form-select">
                <option value="4">Alimentos</option>
                <option value="5">Informática</option>
                <option value="2">Eletrodomésticos</option>
                <option value="3">Celulares</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nome do Produto</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Criar Produto</button>
    </form>
@endsection
