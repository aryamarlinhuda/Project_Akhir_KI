@extends('admin.sidebar')
@section('judul_halaman','Products | Admin')
@section('product','active')
@section('admin.product')
<div class="container py-5">
    <h1>Products</h1>
    <hr>
    @if(session('create'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('create')}}
        </div>
    </div>
    @endif
    @if(session('update'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('update')}}
        </div>
    </div>
    @endif
    @if(session('restock'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('restock')}}
        </div>
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
    @endif
    <a href="product/create" class="btn btn-success">Add New Product</a>
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Picture</th>
                <th>Description</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Membership Point</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="{{ asset('storage/'.$item->picture) }}" alt="{{ $item->name }}" height="70px"></td>
                <td>{{ Str::limit($item->description, 35) }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->stock }}</td>
                <td>Rp {{ number_format($item->price) }}</td>
                <td>{{ $item->point }}</td>
                <td>
                    <a href="{{ url('admin/product/'.$item->product_id.'/update') }}" class="btn btn-primary btn-sm me-4">Edit</a>
                    <a href="{{ url('admin/product/'.$item->product_id.'/restock') }}" class="btn btn-success btn-sm me-4">Restock</a>
                    <form action="{{ url('admin/product/'.$item->product_id.'/delete') }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection