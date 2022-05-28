<div class="dropdown">
    <button type="button" class="btn btn-info" data-toggle="dropdown">
        Payroll <span class="badge badge-pill badge-danger">{{ count((array) session('payroll')) }}</span>
    </button>
    <div class="dropdown-menu">
        <div class="row total-header-section">
            <div class="col-lg-6 col-sm-6 col-6">
                <span class="badge badge-pill badge-danger">{{ count((array) session('payroll')) }}</span>
            </div>
            @php $total = 0 @endphp
            @foreach((array) session('payroll') as $id => $details)
                @php $total += $details['amount'] @endphp
            @endforeach
            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                <p>Total: <span class="text-info">Kshs. {{ $total }}</span></p>
            </div>
        </div>
        @if(session('payroll'))
            <div class="overflow-y-scroll max-h-52 min-w-fit md:max-h-80">
            @foreach(session('payroll') as $id => $details)
                <div class="row cart-detail">
                    <div class="col-lg-12 col-sm-12 col-12 cart-detail-product">
                        <p>{{ $details['name'] }}</p>
                        <span class="price text-info"> {{ $details['phone'] }}</span> <span class="count"> Amount:{{ $details['amount'] }}</span>
                    </div>
                </div>
            @endforeach
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                <a href="{{ route('payroll') }}" class="btn btn-secondary btn-block">View all</a>
            </div>
        </div>
    </div>
</div>