@extends('user.sidebar')
@section('judul_halaman','Order Membership Product | User')
@section('membership','active')
@section('user.order-membership')
<div class="container py-3">
<h1>Order Membership Products</h1>
    <hr>
    <a href="{{ url('user/membership') }}" class="btn btn-success mx-2">Buy Membership Product</a>
    @if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
    @endif
    @if(empty($item) || count($item) == 0)
        <h3 class="text-white text-center"><i>No Membership Product Orders</i></h3>
    @else
    @if(session('add'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('add')}}
        </div>
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
    @endif
    @if(session('min'))
    <div class="alert alert-danger alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('min')}}
        </div>
    </div>
    @endif
        <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Point/Qty</th>
                <th>Total Points</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; $total_points=0; $sisa_points=0; ?>   
            @foreach($item as $ct => $data)
            <?php $total = $data['point'] * $data['quantity'] ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['quantity'] }}</td>
                <td>{{ number_format($data['point']) }}</td>
                <td>{{ number_format($total) }}</td>
                <td><a href="{{ url('user/membership/order/'.$ct.'/delete') }}" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php $total_points+= $total; ?>
            @endforeach
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Total Points :</th>
                <th style="border: none;">{{ number_format($total_points) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Your Point :</th>
                <th>{{ number_format(Auth::user()->point) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Your Remaining Point :</th>
                <?php $sisa_points = auth()->user()->point - $total_points ?>
                <th>{{ number_format($sisa_points) }}</th>
            </tr>
            <tr>
                <th colspan="5" class="text-end" style="border: none;">
                    <a href="{{ url('user/membership/order/exchange') }}" class="btn btn-success px-5 me-5">Buy</a>
                </th>
            </tr>
        </tbody>
    </table>
    @endif
</div>
@endsection