@extends('admin.sidebar')
@section('judul_halaman','Customer | Admin')
@section('customer','active')
@section('admin.customers')
<h2 class="pt-4">Customers</h2>
<hr>
@if(session('update'))
<div class="alert alert-success alert-block dismissible show fade mt-1">
    <div class="alert-body">
        {{session('update')}}
    </div>
</div>
@endif
<table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Membership</th>
                <th>Membership Point</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; $kembalian=0;?>
            @foreach($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->name }}</td>
                @if($item->membership === 1)
                <td>Yes</td>
                @else
                <td>No</td>
                @endif
                <td>{{ $item->point }}</td>
                <td><a href="{{ url('admin/customers/'.$item->id.'/update') }}" class="btn btn-primary">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection