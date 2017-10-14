<script type="text/javascript" src="https://netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
<div class="card">
	<div class="card-body">
	  <h2 class="card-title">Bill</h2>
		<div class="row">
			<div class="col-12">
				<form class="forms-sample repeater" id="bill_form">
					<input type="hidden" id="bill_id" name="bill_id" value='<?php if(isset($id)) echo $id; ?>' />
					<div class="form-group">
						<div class="row">
							<div class="col-4">
								<label for="bill_name">Bill No</label>
								<input type="text" class="form-control p-input" id="bill_no" placeholder="Bill NO" value='<?php if(isset($bill_no)) echo $bill_no; ?>' name="bill_no" readonly>
							</div>
							<div class="col-4">
								<label for="bill_code">Date</label>
								<input type="text" class="form-control p-input" id="biil_date" placeholder="Bill Date" value='<?php if(isset($biil_date)) echo $biil_date; ?>' name="biil_date">
							</div>
							<div class="col-4">
								<label for="bill_code">Lorry No.</label><br>
								<input type="text" class="form-control p-input" id="truck_no" placeholder="Truck No" value='<?php if(isset($truck_no)) echo $truck_no; ?>' name="truck_no">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="mobile_no">Consignor</label>
								<select class="form-control p-input" id="consignor" name="consignor" onchange="get_consignor_address()">
									<option value=''>Please select Consignor</option>
									<?php 
										$sql="SELECT * FROM party WHERE company_id='".$this->session->userdata("id")."' ";
										$res=$this->db->query($sql);
										foreach($res->result_Array() as $row){
											$s='';
											if(isset($consignor) && $consignor==$row['id']) $s="selected='selected'";
											echo "<option value='".$row['id']."' $s>".$row['party_name']."</option>";
										}
									?>
								</select>
							</div>
							<div class="col-6">
								<label for="address">Address</label>
								<input type="text" name="consignor_address" id="consignor_address" class='form-control p-input' placeholder="Address" value='<?php if(isset($address)) echo $address; ?>' readonly>
							</div>
							<div class="col-3">
								<label for="address">From</label>
								<select class="form-control p-input" id="from_destination" name="from_destination">
									<option value=''>Please select From</option>
									<?php 
										$sql="SELECT * FROM cities";
										$res=$this->db->query($sql);
										foreach($res->result_Array() as $row){
											$s='';
											if(isset($from_destination) && $from_destination==$row['id']) $s="selected='selected'";
											echo "<option value='".$row['id']."' $s>".$row['city_name']."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="mobile_no">Consignee</label>
								<select class="form-control p-input" id="consignee" name="consignee" onchange="get_consignee_address()">
									<option value=''>Please select Consignee</option>
									<?php 
										$sql="SELECT * FROM party WHERE company_id='".$this->session->userdata("id")."' ";
										$res=$this->db->query($sql);
										foreach($res->result_Array() as $row){
											$s='';
											if(isset($consignee) && $consignee==$row['id']) $s="selected='selected'";
											echo "<option value='".$row['id']."' $s>".$row['party_name']."</option>";
										}
									?>
								</select>
							</div>	
							<div class="col-6">
								<label for="address">Address</label>
								<input type="text" name="consignee_address" id="consignee_address" class='form-control p-input' placeholder="Address" value='<?php if(isset($address)) echo $address; ?>' readonly>
							</div>
							<div class="col-3">
								<label for="to_destination">To</label>
								<select class="form-control p-input" id="to_destination" name="to_destination">
									<option value=''>Please select From</option>
									<?php 
										$sql="SELECT * FROM cities";
										$res=$this->db->query($sql);
										foreach($res->result_Array() as $row){
											$s='';
											if(isset($to_destination) && $to_destination==$row['id']) $s="selected='selected'";
											echo "<option value='".$row['id']."' $s>".$row['city_name']."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					
					
					<div class="form-group">
						<div class="row">
							<div class="col-12">
								<label for="address">Goods</label>
								<div data-repeater-list="group-a">
								  <div data-repeater-item class="d-flex mb-2">
									<label class="sr-only" for="inlineFormInput">Goods Name</label>
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="product_name" name="product_name" placeholder="Goods Name">
									<label class="sr-only" for="inlineFormInputGroup">Weight</label>
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="product_weight" name="product_weight" placeholder="Weight">
									<input data-repeater-delete type="button" class="btn btn-danger ml-2" value="Delete" />
								  </div>
								</div>
								<input data-repeater-create type="button" class="btn btn-success ml-2 mb-2" value="+" />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="address">Charged Kg</label>
								<input type="text" name="charge_kg" id="charge_kg" class='form-control p-input' placeholder="Charged Kg" value='<?php if(isset($charge_kg)) echo $charge_kg; ?>'>
							</div>
							<div class="col-3">
								<label for="to_destination">Rate Kg</label>
								<input type="text" name="rate_kg" id="rate_kg" class='form-control p-input' placeholder="Rate Kg" value='<?php if(isset($rate_kg)) echo $rate_kg; ?>'>
							</div>
							<div class="col-3">
								<label for="address">Pay Or Not Pay</label>
								<select class='form-control p-input' id="pay_or_not_pay" name="pay_or_not_pay">
									<option value=''>Pay</option>
									<option value=''>Paid</option>
								</select>
							</div>
							<div class="col-3">
								<label for="to_destination">Price</label>
								<input type="text" name="pay_paid_price" id="pay_paid_price" class='form-control p-input' placeholder="Price" value='<?php if(isset($pay_paid_price)) echo $pay_paid_price; ?>'>
							</div>
						</div>
					</div>
				
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="address">Hamali</label>
								<input type="text" name="hamali" id="hamali" class='form-control p-input' placeholder="Hamali" value='<?php if(isset($hamali)) echo $hamali; ?>'>
							</div>
							<div class="col-3">
								<label for="to_destination">C.C</label>
								<input type="text" name="cc" id="cc" class='form-control p-input' placeholder="C.C" value='<?php if(isset($cc)) echo $cc; ?>'>
							</div>
							<div class="col-3">
								<label for="to_destination">B.C</label>
								<input type="text" name="bc" id="bc" class='form-control p-input' placeholder="B.C" value='<?php if(isset($bc)) echo $bc; ?>'>
							</div>
							<div class="col-3">
								<label for="address">Total</label>
								<input type="text" name="total" id="total" class='form-control p-input' placeholder="Total" value='<?php if(isset($total)) echo $total; ?>' readonly>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="to_destination">GST Tax</label>
								<input type="text" name="gst_tax" id="gst_tax" class='form-control p-input' placeholder="GST Tax" value='<?php if(isset($gst_tax)) echo $gst_tax; ?>'>
							</div>
							<div class="col-3">
								<label for="to_destination">Grand Total</label>
								<input type="text" name="grand_total" id="grand_total" class='form-control p-input' placeholder="Grand Total" value='<?php if(isset($grand_total)) echo $grand_total; ?>' readonly>
							</div>
							<div class="col-6">
								<label for="address">Total in Words</label>
								<input type="text" name="price_in_word" id="price_in_word" class='form-control p-input' placeholder="Total in Words" value='<?php if(isset($price_in_word)) echo $price_in_word; ?>' readonly>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							
							<div class="col-6">
								<label for="to_destination">Remarks</label>
								<input type="text" name="ramarks" id="ramarks" class='form-control p-input' placeholder="Remarks" value='<?php if(isset($ramarks)) echo $ramarks; ?>'>
							</div>
							<div class="col-6">
								<label for="to_destination">Delivery At</label>
								<input type="text" name="delivery_at" id="delivery_at" class='form-control p-input' placeholder="Delivery At" value='<?php if(isset($delivery_at)) echo $delivery_at; ?>'>
							</div>
						</div>
					</div>
					
					<button type="button" class="btn btn-primary" id="btn_submit">Submit</button>
					<button type="button" class="btn btn-default" onclick="viewmenu('bill')">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$( document ).ready(function() {
		$("#bill_form").validate({
			rules: {
				bill_no: { required:true},
				biil_date: { required:true},
				consignor: { required:true},
				consignor_address: { required:true},
				from_destination: { required:true},
				consignee: { required:true},
				consignee_address: { required:true},
				to_destination: { required:true},
				product_name: { required:true},
				product_weight: { required:true,number:true},
				charge_kg: { required:true,number:true},
				rate_kg: { required:true,number:true},
				pay_paid_price: { required:true,number:true},
				hamali: { required:true,number:true},
				cc: { required:true,number:true},
				bc: { required:true,number:true},
				total: { required:true,number:true},
				gst_tax: { required:true,number:true},
				grand_total: { required:true,number:true},
				delivery_at: { required:true},
			}
		});
	
	$('#btn_submit').click(function () {
		var bill_id=$("#bill_id").val();
		if ($("#bill_form").valid()) {
			$(".preloader").show();
			var request = $.ajax({
				url: "<?php echo site_url("bill/form_submit"); ?>",
				method: "POST",
				data: $("#bill_form").serialize(),
				dataType: "json"
			});
			request.done(function( data, textStatus, jqXHR ) {
				$(".preloader").hide();
				if(data.success==true){
					success_notification(data.message);
					$('#bill_form')[0].reset();
					if($("#bill_id").val()!=''){
						viewmenu("bill");
					}
				}else{
					error_notification(data.message);
				}
			});
			request.fail(function( jqXHR, textStatus ) {
				console.log( "Request failed: " + textStatus );
			});
        }
    });
	
});
$( "#charge_kg,#rate_kg,#pay_paid_price,#hamali,#cc,#bc,#gst_tax" ).keypress(function() {
	count_amount();
});
$( "#charge_kg,#rate_kg,#pay_paid_price,#hamali,#cc,#bc,#gst_tax" ).keyup(function() {
	count_amount();
});
function count_amount(){
	var charge_kg=$("#charge_kg").val();
	var rate_kg=$("#rate_kg").val();
	var pay_paid_price=$("#pay_paid_price").val();
	var hamali=$("#hamali").val();
	var cc=$("#cc").val();
	var bc=$("#bc").val();
	var gst_tax=$("#gst_tax").val();
	
	var total=parseFloat(charge_kg)+parseFloat(rate_kg)+parseFloat(pay_paid_price)+parseFloat(hamali)+parseFloat(cc)+parseFloat(bc)
	$("#total").val(total.toFixed(2));
	if(gst_tax>0){
		var grand_total=(parseFloat($("#total").val())*parseFloat(gst_tax));
		grand_total=grand_total-total;
		$("#grand_total").val(grand_total.toFixed(2));
	}else{
		$("#grand_total").val(total.toFixed(2));
	}	
	
	$("#price_in_word").val(convert_number($("#grand_total").val()));
}
</script>
<script>
(function($) {
  'use strict';
  $(function() {
    $('.repeater').repeater({
      defaultValues: {
        'text-input': 'foo'
      },
      show: function() {
        $(this).slideDown();
      },
      hide: function(deleteElement) {
        if (confirm('Are you sure you want to delete this element?')) {
          $(this).slideUp(deleteElement);
        }
      },
     
      isFirstItemUndeletable: true
    })
  });
})(jQuery);

$('#biil_date').datepicker({
    format: 'dd-mm-yyyy'
});

$('#biil_date').datepicker('setDate', new Date());
$(document).ready(function() {
    $("#charge_kg,#rate_kg,#pay_paid_price,#hamali,#cc,#bc,#total,#gst_tax,#grand_total").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	if($("#charge_kg").val()==''){
		$("#charge_kg").val("0.00");
	}if($("#rate_kg").val()==''){
		$("#rate_kg").val("0.00");
	}if($("#pay_paid_price").val()==''){
		$("#pay_paid_price").val("0.00");
	}if($("#hamali").val()==''){
		$("#hamali").val("0.00");
	}if($("#cc").val()==''){
		$("#cc").val("0.00");
	}if($("#bc").val()==''){
		$("#bc").val("0.00");
	}if($("#total").val()==''){
		$("#total").val("0.00");
	}if($("#gst_tax").val()==''){
		$("#gst_tax").val("0.00");
	}if($("#grand_total").val()==''){
		$("#grand_total").val("0.00");
	}
});

function convert_number(number)
	{
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */ 
    number -= Hn * 1000; 
    var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
    number = number % 100;               /* Ones */ 
    var tn= Math.floor(number / 10); 
    var one=Math.floor(number % 10); 
    var res = ""; 

    if (Gn>0) 
    { 
        res += (convert_number(Gn) + " CRORE"); 
    } 
    if (kn>0) 
    { 
            res += (((res=="") ? "" : " ") + 
            convert_number(kn) + " LAKH"); 
    } 
    if (Hn>0) 
    { 
        res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " THOUSAND"); 
    } 

    if (Dn) 
    { 
        res += (((res=="") ? "" : " ") + 
            convert_number(Dn) + " HUNDRED"); 
    } 


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

    if (tn>0 || one>0) 
    { 
        if (!(res=="")) 
        { 
            res += " AND "; 
        } 
        if (tn < 2) 
        { 
            res += ones[tn * 10 + one]; 
        } 
        else 
        { 

            res += tens[tn];
            if (one>0) 
            { 
                res += ("-" + ones[one]); 
            } 
        } 
    }

    if (res=="")
    { 
        res = "ZERO"; 
    } 
    return res;
}
function get_consignor_address(){
	var id=$("#consignor").val();
	if(id!=""){
		var request = $.ajax({
			url: "<?php echo site_url("bill/get_party_address"); ?>",
			method: "POST",
			data: {id:id},
			dataType: "html"
		});
		request.done(function( data, textStatus, jqXHR ) {
			$(".preloader").hide();
			$("#consignor_address").val(data);
		});
		request.fail(function( jqXHR, textStatus ) {
			console.log( "Request failed: " + textStatus );
		});
	}else{
		$("#consignor_address").val("");
	}
}
function get_consignee_address(){
	var id=$("#consignee").val();
	if(id!=""){
		var request = $.ajax({
			url: "<?php echo site_url("bill/get_party_address"); ?>",
			method: "POST",
			data: {id:id},
			dataType: "html"
		});
		request.done(function( data, textStatus, jqXHR ) {
			$(".preloader").hide();
			$("#consignee_address").val(data);
		});
		request.fail(function( jqXHR, textStatus ) {
			console.log( "Request failed: " + textStatus );
		});
	}else{
		$("#consignee_address").val("");
	}
}

	$(document).ready(function() {
		$('#truck_no').typeahead({
		name: 'truck_no',
		remote: '<?php echo site_url("bill/get_truck_list"); ?>?query=%QUERY'

	});
})
</script>
<style>
.content {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .tt-hint,
        .city {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

        .tt-dropdown-menu {
            width: 100%;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
</style>