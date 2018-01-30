@extends('layout.app') 
@section('title','My Profile') 
@section('body')
<script src="js/jquery.payform.min.js" charset="utf-8"></script>
 <script src="js/script.js"></script>
<!--wrapper start-->
	<!--wrapper start-->
    <div class="wrapper">
    	<div class="row Nomarg">
            	@include('layout.provider_header')
        </div> 
        <section class="package_body">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">                    	
                            @if ($message = Session::get('success'))
                            <div class="custom-alerts alert alert-success fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {!! $message !!}
                            </div>
                            <?php Session::forget('success');?>
                            @endif
                            @if ($message = Session::get('error'))
                            <div class="custom-alerts alert alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {!! $message !!}
                            </div>
                            <?php Session::forget('error');?>
                            @endif
                            @if(@$credit_point==0)                           	
                            <p>You can not quote any job without credit point.</p>
                            @endif
                         </div>
                        
                        <div class="package_table">
                        	<h2>Package</h2>
                            <div class="table_area">
                            	<div class="trip_table">
                                    	<div class="">
                                        	<div class="table">
                                                <div class="one_row1 hidden-xs">
                                                    <div class="cell1 tab_head_sheet">Package Type</div>
                                                    <div class="cell1 tab_head_sheet">Cost</div>
                                                    <div class="cell1 tab_head_sheet">Credits You Recieve</div>                                                    
                                                    <div class="cell1 tab_head_sheet">&nbsp;</div>
                                                </div>
                                                @if(count($creditPackages))
                                                @foreach($creditPackages as $item)
                                                <form action="payment" method="post" id="payment_{{$item->package_id}}">
                                                     {{csrf_field()}}
                                                    {{--  <input type="hidden" name="credit_package_id" value="{{$item->package_id}}">  --}}
                                                    <div class="one_row1 small_screen31 small_1">
                                                        <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                            <span class="W55_1">Package Type</span>
                                                            <p class="add_ttrr">{{$item->credit_type_package_name}}</p>
                                                        </div>
                                                        <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                            <span class="W55_1">Cost</span>
                                                            <p class="add_ttrr">&pound; {{$item->cost}}</p>
                                                        </div>
                                                        <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                            <span class="W55_1">Credits You Recieve</span>
                                                            <p class="add_ttrr">{{$item->credit_point}}</p>
                                                        </div>
                                                        <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                            <span class="W55_1">&nbsp;</span>
                                                            <p class="add_ttrr"><a class="sub_bttn sub_b uu credit_card_form"  href="javascript:void(0)" data-package-id="{{$item->package_id}}" > Buy </a>
                                                    </div>
                                                </form>
                                                    </div>
                                                    @endforeach
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        {{--  <div class="card_details">
                        	<h2>Your Credit Card is Saved</h2>
                            <a class="sub_bttn" href="javascript:void(0)" id="credit_card_form">Change card details</a>
                        </div>  --}}
                    </div>
                </div>
            </div>
        </section>
        @include('layout.builder_footer')
        <!-- Return to Top -->
		<a href="javascript:" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
    </div>
    <!--wrapper end-->
    @component('modal.builder_buy_credit_by_credit_card',['title'=>'Change Card Details'])
		Modal pop-up HTML of mark complete will be included.
@endcomponent
<script>
        $(document).ready(function() {
        var package_id=''; 
        $('.credit_card_form').click(function(event){
            package_id=$(this).attr('data-package-id');           
            $('#credit_package_id').val(package_id); 
            $('#change_card_details').modal('show');   
        });
        function copyForms( $form1 , $form2 ) {
            $(':input[name]', $form2).val(function() {
              return $(':input[name=' + this.name + ']', $form1).val();
            });
          }
        });

</script>
<script>
    $('#renew').click(function(){
        $('#renew_package').submit();
    });
</script>
@if(session()->get('success'))
@component('alert.sweet_alert')
	 @slot('message')
	 {{session()->get('success')}}
    @endslot
 Sweet alert message
@endcomponent
@endif 
@endsection
<!-- Modal -->




