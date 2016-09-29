<form name="_donations" action="https://www.paypal.com/yt/cgi-bin/webscr" method="post">
	<input TYPE="hidden" name="cmd" value="_donations" />
	<input type="hidden" name="business" value="mhsjackrabbitsalumni@gmail.com">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="item_name" value="Mesa High School Donation">
	<input type="radio" name="amount" value="10.00"  required /><label>$10</label>
	<input type="radio" name="amount" value="25.00"  required /><label>$25</label>
	<input type="radio" name="amount" value="50.00"  required /><label>$50</label>
	<input type="radio" name="amount" value="100.00" required /><label>$100</label>
	<input type="radio" name="amount" value="150.00" required /><label>$150</label>
	<input type="radio" name="amount" value="200.00" required /><label>$200</label>
	<input type="radio" name="amount" value="others" required /><label>Others, Please Specify</label>
	<div class="other-container"></div>
	<button>Donate now</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
	$ = jQuery.noConflict();
	$(function(){
		var trig = $("input[name=amount]:radio")
		var container = $('.other-container');
		//console.log('On load');
		trig.change(function(){
			if($(this).val() == 'others'){
				//console.log('On change');
				 container.append($(document.createElement('input')).attr({
					type:'number',
					name:'amount',
					min:'1',
					placeholder:'Amount'
				 }));
			 }
			 else{
				container.empty()
			 }
		});
	});
</script>