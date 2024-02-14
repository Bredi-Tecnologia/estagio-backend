@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4" style="width: 800px;">
            <h1 class="mb-4">Lista de Produtos</h1>

            <div class="d-flex justify-content-end mb-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">Todos</option>
                </select>
                <button class="btn btn-dark" onclick="filterProducts()"> <i class="mdi mdi-filter"></i></button>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody id="productTableBody">
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>R${{ $product->price }}</td>
                        <td>{{ $product->category->title }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning"> <i class="mdi mdi-pencil"></i></a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Criar Produto</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            axios.get("{{ route('category.index') }}")
                .then(function(response) {
                    // Preencher o select com as categorias
                    $('#categoryFilter').empty();
                    $('#categoryFilter').append('<option value="">Todos</option>');
                    response.data.forEach(function(category) {
                        $('#categoryFilter').append('<option value="' + category.id + '">' + category.title + '</option>');
                    });
                })
                .catch(function(error) {
                    console.error('Erro ao obter categorias:', error);
                });
        });

        function filterProducts() {
            var selectedValue = document.getElementById('categoryFilter').value;

            axios.get("{{ route('products.filter') }}/" + selectedValue)
                .then(function(response) {
                    // Limpar a tabela
                    $('#productTableBody').empty();

                    response.data.forEach(function(product) {
                        var categoryName;

                        switch (product.category_id) {
                            case 4:
                                categoryName = "Alimentos";
                                break;
                            case 2:
                                categoryName = "Eletrodomésticos";
                                break;
                            case 3: categoryName = "Celulares"
                                break;
                            case 5: categoryName = "Informática"
                        }
                        var row = '<tr>' +
                            '<th scope="row">' + product.id + '</th>' +
                            '<td>' + product.name + '</td>' +
                            '<td>' + product.price + '</td>' +

                            '<td>' + categoryName + '</td>' +
                            '<td>' +
                            `<a href="product/${product.id}/edit" class="btn btn-warning m-1"> <i class="mdi mdi-pencil"></i></a>` +
                            `<form action="product/${product.id}/delete" method="post" style="display: inline-block;">` +
                            '@csrf' +
                            '@method('DELETE')' +
                            '<button type="submit" class="btn btn-danger m-1" onclick="return confirm(\'Tem certeza que deseja excluir?\')"><i class="mdi mdi-delete"></i></button>' +
                            '</form>' +
                            '</td>' +
                            '</tr>';
                        $('#productTableBody').append(row);
                    });
                })
                .catch(function(error) {
                    console.error('Erro ao filtrar produtos:', error);
                });
        }

    </script>
@endsection

