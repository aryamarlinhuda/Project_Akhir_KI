@extends('user.sidebar')
@section('judul_halaman','Order | User')
@section('order','active')
@section('user.order')
<div class="container py-3">
<h1>Order Products</h1>
    <hr>
    <a href="{{ url('user/product') }}" class="btn btn-success mx-2">Buy Product</a>
    @if(session('delete'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('delete')}}
        </div>
    </div>
    @endif
    @if(empty($data) || count($data) == 0)
        <h3 class="text-white text-center"><i>No Product Orders</i></h3>
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
    @if(session('kurang'))
    <div class="alert alert-danger alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('kurang')}}
        </div>
    </div>
    @endif
    @if(session('use'))
    <div class="alert alert-success alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('use')}}
        </div>
    </div>
    @endif
    @if(session('no'))
    <div class="alert alert-danger alert-block dismissible show fade mt-3">
        <div class="alert-body">
            {{session('no')}}
        </div>
    </div>
    @endif
        <table class="table text-white">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Harga/Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; $grandtotal=0; ?>   
            @foreach($data as $ct => $item)
            <?php $subtotal = $item['price'] * $item['quantity'] ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Rp {{ number_format($item['price']) }}</td>
                <td>Rp {{ number_format($subtotal) }}</td>
                <td><a href="{{ url('user/order/'.$ct.'/delete') }}" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php $grandtotal+= $subtotal; ?>
            @endforeach
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Total Price :</th>
                <th style="border: none;">Rp {{ number_format($grandtotal) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Discount Code :</th>
                <th class="ps-3" style="border: none;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Discount
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($diskon as $disc)
                            @if($disc->minimal < $grandtotal)
                                <li><a class="dropdown-item" href="{{ url('user/order/'.$disc->id.'/discount') }}">{{ $disc->code }}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="4" class="text-end" style="border: none;">Payment : </th>
                <th style="border: none;">
                    <form action="{{ url('user/order/transaksi') }}">
                        Rp <input type="number" name="pembayaran">
                        <br>
                        <button type="submit" class="btn btn-primary px-4 mt-3 offset-md-3">Beli</button>
                    </form>
                </th>
            </tr>
        </tbody>
    </table>
    @endif
</div>
@endsection