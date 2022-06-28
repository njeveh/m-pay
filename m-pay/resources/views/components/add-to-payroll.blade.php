@props(['payees'])
@if ($payees)

<script>
$(document).ready(function(){
    // Toggle dropdown update and delete menu on click
    $(".payees").click(function(){
        // Hide other dropdown menus in case of multiple dropdowns
        //$("div.btns").not($(this).children().children("div.btns")).not(".hidden").slideUp("fast");
        $("div.btns").not($(this).children().children("div.btns")).not(".hidden").toggleClass("hidden");
        
        // Toggle the current dropdown menu
        //$(this).children().children("div.btns").slideToggle("fast");
        $(this).children().children("div.btns").toggleClass("hidden", false);
        
    });
 
    // Hide dropdown menu on click outside
    $(document).on("click", function(event){
        if(!$(event.target).closest(".payees").length){
            //$("div.btns").not(".hidden").slideUp("fast");
            $("div.btns").not(".hidden").toggleClass("hidden");
            
        }
    });

$(".add-to-payroll").click(function (e) {
    e.preventDefault();
  
    var ele = $(this);
  
    $.ajax({
        url: '{{ route('add.to.payroll') }}',
        method: "post",
        data: {
            _token: '{{ csrf_token() }}', 
            id: ele.parent().find("#payee-id").val(), 
            amount: ele.parents(".btn-ancestor").find(".amount").val()
        },
        success: function (response) {
            window.location.reload();
        }
    });
});
});
</script>

<div class=" py-2 md:py-5">
    <x-add-payee-button onclick="window.location='{{ route('add-payee') }}'" class="ml-3 mb-2">
        {{ __('Add New Payee') }}
    </x-button>
<div>
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
    @foreach ($payees as $payee)
    <!-- exclude the payee if they already exist in the payroll -->
        @if(session('payroll'))
            @if(isset(session('payroll')[$payee->id]))
                @continue
            @endif
        @endif
        <div class="payees md:grid md:grid-cols-2 px-2 py-2 md:px-5 text-sm md:text-base">
            <div class="grid grid-cols-2 mb-1">
                <div>{{ $payee->name }}</div>
                <div>{{ $payee->phone }}</div>
            </div>
            <div class="grid grid-cols-2 btn-ancestor">
                <div class="hidden btns md:block">
                    <input type="number" name="amount" placeholder="amount" class="amount w-3/4 md:w-3/5 rounded-md" />
                </div>
                <div class="hidden btns md:block">
                    <input type="hidden" value="{{ $payee->id }}" id="payee-id"/>
                    <x-create-payroll-button class="ml-3 add-to-payroll">
                        {{ __('Add to Payroll') }}
                    </x-button>
                </div>
            </div>
        </div>
     @endforeach

@else
    No payees to show yet!
@endif