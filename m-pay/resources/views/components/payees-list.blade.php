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
        $(this).children().children("div.btns").toggleClass("hidden");
        
    });
 
    // Hide dropdown menu on click outside
    $(document).on("click", function(event){
        if(!$(event.target).closest(".payees").length){
            //$("div.btns").not(".hidden").slideUp("fast");
            $("div.btns").not(".hidden").toggleClass("hidden");
            
        }
    });
});
</script>
<div class=" py-2 md:py-5">
    <x-add-payee-button onclick="window.location='{{ route('add-payee') }}'" class="ml-3 mb-2">
        {{ __('Add New Payee') }}
    </x-button>
    <x-create-payroll-button onclick="window.location='{{ route('create-payroll') }}'" class="ml-3">
        {{ __('Create Payroll') }}
    </x-button>
</div>
<div>

    @foreach ($payees as $payee)
        <div class="payees md:grid md:grid-cols-2 px-2 py-2 md:px-5 text-sm md:text-base">
            <div class="grid grid-cols-2 mb-1">
                <div>{{ $payee->name }}</div>
                <div>{{ $payee->phone }}</div>
            </div>
            <div class="grid grid-cols-2">
                <div class="hidden btns md:block">
                    <form action="{{ route('update-payee') }}" method="get">
                        @csrf
                        <input type="hidden" name='id' value={{ $payee->id }} />
                        <x-update-button id='update-button' class="ml-3">
                            {{ __('Update') }}
                        </x-button>
                    </form>
                </div>
                <div class="hidden btns md:block">
                    <form action="{{ route('delete-payee') }}" method="POST">
                        @csrf
                        <input type="hidden" name='id' value={{ $payee->id }} />
                        <x-del-button id='delete-button' class="ml-3">
                            {{ __('Delete') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
     @endforeach

@else
    No payees to show yet!
@endif
