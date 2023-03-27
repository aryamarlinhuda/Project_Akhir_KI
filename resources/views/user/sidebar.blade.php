@extends('components.komponen')
<div class="d-flex flex-column justify-content-end p-3 text-bg-dark h-100" style="width: 280px; position: fixed;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">BeliBeli.com</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ url('user/dashboard') }}" class="nav-link @yield('dashboard') text-white" aria-current="page">
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ url('user/membership') }}" class="nav-link @yield('membership') text-white">
          Membership
        </a>
      </li>
      <li>
        <a href="{{ url('user/discount') }}" class="nav-link @yield('discount') text-white">
          Discount
        </a>
      </li>
      <li>
        <a href="{{ url('user/product') }}" class="nav-link @yield('product') text-white">
          Products
        </a>
      </li>
      <li>
        <a href="{{ url('user/order') }}" class="nav-link @yield('order') text-white">
          Cart
        </a>
      </li>
      <li>
        <a href="{{ url('user/transaksi') }}" class="nav-link @yield('transaksi') text-white">
          Transaction
        </a>
      </li>
    </ul>
    <hr>
    <a href="{{ url('logout') }}" class="text-white text-decoration-none">Logout</a>

</div>

<div class="offset-md-3 text-white">
<!-- User -->
@yield('user.dashboard')
@yield('user.product')
@yield('user.filter-category')
@yield('user.detail-product')
@yield('user.discount')
@yield('user.order')
@yield('user.transaksi')
@yield('user.membership')
@yield('user.detail-membership')
@yield('user.order-membership')
@yield('user.history-membership')
</div>