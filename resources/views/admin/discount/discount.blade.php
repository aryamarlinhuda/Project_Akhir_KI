@extends('admin.sidebar')
@section('judul_halaman','Discount Products | Admin')
@section('discount','active')
@section('admin.discount')
<h1 class="pt-4">Discount Products</h1>
<hr>
<a href="{{ url('admin/discount/create') }}" class="btn btn-success">Add New</a>
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
@if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-1">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
@endif
    <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Discount Code</th>
                <th>Discount</th>
                <th>Minimum</th>
                <th>Limit Use</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->discount }}%</td>
                @if(!$item->minimal)
                <td>-</td>
                @else
                <td>{{ $item->minimal }}</td>
                @endif
                @if(!$item->limit)
                <td>-</td>
                @else
                <td>{{ $item->limit }}</td>
                @endif
                <td>
                    <a href="{{ url('admin/discount/'.$item->id.'/update') }}" class="btn btn-primary btn-sm me-4">Edit</a>
                    <form action="{{ url('admin/discount/'.$item->id.'/delete') }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection