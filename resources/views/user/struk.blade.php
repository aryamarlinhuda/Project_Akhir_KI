<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <style>
    body {
        font-family: monospace;
        align-items: center;
    }
  </style>
  <body>
        <h2 class="text-center mt-3">BeliBeli.com</h2>
        <p class="text-center"><i>Jalan Raya No.99</i></p>
        <p class="ms-3">Nama : {{ Auth::user()->name }}</p>
        <p class="ms-3">Tanggal Transaksi : {{ $header->tanggal_transaksi }}</p>
        <p class="ms-3">ID Transaksi : {{ $header->id_header_transaksi }}</p>
        <table class="ms-3">
            <tr>
                <th colspan="5"><hr></th>
            </tr>
            <tr>
                <th>No.</th>
                <th class="px-2">Product</th>
                <th class="px-2">Quantity</th>
                <th class="px-2">Price/Qty</th>
                <th class="px-5">Subtotal</th>
            </tr>
            <tr>
                <th colspan="5"><hr></th>
            </tr>
            <?php $no=1; $kembalian=0; ?>
            @foreach($detail as $item)
            <tr class="text-center">
                <td class="px-3">{{ $no++ }}</td>
                <td class="px-3">{{ $item->product->name }}</td>
                <td class="px-3">{{ $item->quantity }}</td>
                <td class="px-3">{{ number_format($item->product->price) }}</td>
                <td class="px-3">{{ number_format($item->harga_total) }}</td>
            </tr>
            @endforeach
            <tr>
              <th colspan="5"><hr></th>
            </tr>
            <tr>
              @if($header->discount_id)
              <th colspan="3">Discount Code : <b>{{ $header->id_disc->code }}</b></th>
              @else

              @endif
            </tr>
            <tr class="pt-4">
              <th colspan="4" class="text-end">Total :</th>
              <td class="ps-4">Rp {{ number_format($header->total) }}</td>
            </tr>
            @if($header->discount)
            <tr class="pt-4">
            </tr>
              <th colspan="4" class="text-end">Diskon {{ $header->id_disc->discount }}% : </th>
              <td class="ps-4">Rp {{ number_format($header->discount) }}</td>
            </tr>
            @else

            @endif
            
            @if($header->total_pembelian)
            <tr class="pt-4">
              <th colspan="4" class="text-end">Total Pembelian :</th>
              <td class="ps-4">Rp {{ number_format($header->total_pembelian) }}</td>
            </tr>
            @else

            @endif
            <tr class="pt-4">
              <th colspan="4" class="text-end">Pembayaran :</th>
              <td class="ps-4">Rp {{ number_format($header->pembayaran) }}</td>
            </tr>
            @if($header->total_pembelian)
            <?php $kembalian = $header->pembayaran - $header->total_pembelian ?>
            @else
            <?php $kembalian = $header->pembayaran - $header->total ?>
            @endif
            <tr class="pt-4">
              <th colspan="4" class="text-end">Kembalian :</th>
              <td class="ps-4">Rp {{ number_format($kembalian) }}</td>
            </tr>
        </table>
        <p class="text-center my-4"><i>--- Terimakasih sudah berbelanja di BeliBeli.com ---</i></p>
        <p class="text-center my-4"><i>--- BeliBeli.com ---</i></p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>