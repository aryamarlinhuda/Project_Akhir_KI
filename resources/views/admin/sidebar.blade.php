@extends('components.komponen')
<div class="d-flex flex-column justify-content-end p-3 text-bg-dark h-100" style="width: 280px; position: fixed;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">BeliBeli.com</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ url('admin/dashboard') }}" class="nav-link @yield('dashboard') text-white" aria-current="page">
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ url('admin/product') }}" class="nav-link @yield('product') text-white">
          Products
        </a>
      </li>
      <li>
        <a href="{{ url('admin/recap') }}" class="nav-link @yield('recap') text-white">
          Transaction Recap
        </a>
      </li>
      <li>
        <a href="{{ url('admin/discount') }}" class="nav-link @yield('discount') text-white">
          Discount
        </a>
      </li>
      <li>
        <a href="{{ url('admin/membership') }}" class="nav-link @yield('membership') text-white">
          Membership Point
        </a>
      </li>
      <li>
        <a href="{{ url('admin/customers') }}" class="nav-link @yield('customer') text-white">
          Customers
        </a>
      </li>
    </ul>
    <hr>
    <a href="{{ url('logout') }}" class="text-white text-decoration-none">Logout</a>

</div>

<div class="offset-md-3 text-white">
<!-- Admin -->
@yield('admin.dashboard')
@yield('admin.product')
@yield('admin.create-product')
@yield('admin.update-product')
@yield('admin.membership')
@yield('admin.create-membership')
@yield('admin.update-membership')
@yield('admin.restock-membership')
@yield('admin.recap-membership')
@yield('admin.discount')
@yield('admin.create-discount')
@yield('admin.update-discount')
@yield('admin.costomers')
@yield('admin.update-costomers')
@yield('admin.restock')
@yield('admin.recap')
@yield('admin.customers')
</div>