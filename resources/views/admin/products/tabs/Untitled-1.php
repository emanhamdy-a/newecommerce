<script type="text/javascript">
$(document).ready(function() {
	var dataSelect = [
				@foreach(App\Model\Country::all() as $country)
				  {
				  	"text":"{{ $country->{'country_name_'.lang()} }}",
				  	"children":[
				 	@foreach($country->malls()->get() as $mall)
				 	{
				 		"id":{{ $mall->id }},
				 		"text":"{{ $mall->{'name_'.lang()} }}",
				 		@if(check_mall($mall->id,$product->id))
				 		"selected":true
				 		@endif
				 	},
				 	@endforeach
				 	],
				 },
				 @endforeach
		];

    $('.mall_select2').select2({data:dataSelect});

});
</script>
