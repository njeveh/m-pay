
@php $total = 0 @endphp
@if(session('payroll'))
    <div class="md:grid md:grid-cols-2 px-2 py-2 md:px-5 text-sm md:text-base border-b-2 border-slate-400">
        <div class="grid grid-cols-2 mb-1">
            <div class="font-bold"><h3>Name</h3></div>
            <div class="font-bold"><h3>Phone</h3></div>
        </div>
        <div class="grid grid-cols-2">
            <div class="hidden md:block">
            <div class="font-bold"><h3>Amount</h3></div>
            </div>
            <div class="hidden md:invisible">
            </div>
        </div>
    </div>
@foreach(session('payroll') as $id => $details)
    @php $total += $details['amount'] @endphp

    <div data-id="{{ $id }}" class="payee md:grid md:grid-cols-2 px-2 py-2 md:px-5 text-sm md:text-base border-b-2 border-slate-400">
        <div class="grid grid-cols-2 mb-1">
            <div>{{ $details['name'] }}</div>
            <div>{{ $details['phone'] }}</div>
        </div>
        <div class="grid grid-cols-2">
            <div class="hidden btns md:block update-parent-target">
                <input type="number" value="{{ $details['amount'] }}" class="amount w-3/4 md:w-3/5 rounded-md update-payroll" />
            </div>
            <div class="hidden btns md:block flex justify-center">
                <button class="btn btn-danger btn-sm remove-from-payroll"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>
    </div>
     @endforeach
@endif
    <div class="grid grid-cols-2">
        <div class="">
            <h3><strong>Total</strong></h3>
        </div>
        <div class=" flex justify-end">
            <h3><strong>Kshs. {{ $total }}</strong></h3>
        </div>
    </div>
    <div class="flex justify-end">

        <div>
                <a href="{{ url('/create-payroll') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Add More Payees</a>
                <button class="btn btn-success">Checkout</button>
        </div>
    </div>

<script type="text/javascript">
    $(".update-payroll").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.payroll') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents(".payee").attr("data-id"), 
                amount: ele.parents(".update-parent-target").find(".amount").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-payroll").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.payroll') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents(".payee").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
$(document).ready(function(){
    // Toggle dropdown update and delete menu on click
    $(".payee").click(function(){
        // Hide other dropdown menus in case of multiple dropdowns
        //$("div.btns").not($(this).children().children("div.btns")).not(".hidden").slideUp("fast");
        $("div.btns").not($(this).children().children("div.btns")).not(".hidden").toggleClass("hidden");
        
        // Toggle the current dropdown menu
        //$(this).children().children("div.btns").slideToggle("fast");
        $(this).children().children("div.btns").toggleClass("hidden", false);
        
    });
 
    // Hide dropdown menu on click outside
    $(document).on("click", function(event){
        if(!$(event.target).closest(".payee").length){
            //$("div.btns").not(".hidden").slideUp("fast");
            $("div.btns").not(".hidden").toggleClass("hidden");
            
        }
    });
});
</script>
