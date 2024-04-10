<!DOCTYPE html>
<html>
<head>
<style>
body{ font-size: 12px; font-family: Arial; }
</style>
<script src="http://eservices.mci.gov.sa/Eservices/Commerce/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">

	jQuery.fn.myshake = function (steps, duration, amount, vertical) {
		var s = steps || 3;
		var d = duration || 120;
		var a = amount || 3;
		var v = vertical || false;
		this.css('position', 'relative');
		var cur = parseInt(this.css(v ? "top" : "left"), 10);
		if (isNaN(cur))
		    cur = 0;

		var ds = d / s;

		if (v) {
		    for (i = 0; i < s; i++)
			this.animate({ "top": cur + a + "px" }, ds).animate({ "top": cur - a + "px" }, ds);
		    this.animate({ "top": cur }, 20);
		}
		else {
		    for (i = 0; i < s; i++)
			this.animate({ "left": cur + a }, ds).animate({ "left": cur - a + "px" }, ds);
		    this.animate({ "left": cur }, 20);
		}

		return this;
	}

	function getContent(){
		var mDivDestino = $('#Destino');
		var practice = $('select[name="practice"]').val()
		var location = $('select[name="location"]').val()

		$.post("mget.php", { lid: location , pid: practice})
		.done(function(data) {
			mDivDestino.html(data);
		});
	}
</script>


</head>
<body>

<div id='Destino'></div>

<form action="#">

		             	<!-- <input type="text" placeholder="Type name" id="txtSearch" name="lawyername" value="Type name" class="txt"> -->
		                    <select name="practice">
			                    			                    	<option value="">Practice</option>
			                    			                    	<option value="1448">Arbitration</option>
			                    			                    	<option value="2">Banking &amp; Finance</option>
			                    			                    	<option value="90">Commercial Advisory</option>
			                    			                    	<option value="6">Construction &amp; Engineering</option>
			                    			                    	<option value="5">Corporate Governance</option>
			                    			                    	<option value="7">Corporate Structuring</option>
			                    			                    	<option value="8">Employment</option>
			                    			                    	<option value="9">Equity Capital Markets</option>
			                    			                    	<option value="10">Family Business</option>
			                    			                    	<option value="11">Hospitality</option>
			                    			                    	<option value="12">Insurance</option>
			                    			                    	<option value="13">Intellectual Property</option>
			                    			                    	<option selected="selected" value="15">Legislation &amp; Policy</option>
			                    			                    	<option value="84">Litigation</option>
			                    			                    	<option value="16">Mergers &amp; Acquisitions</option>
			                    			                    	<option value="17">Property</option>
			                    			                    	<option value="19">Special Projects</option>
			                    			                    	<option value="20">Technology, Media &amp; Telecoms</option>
			                    			                    	<option value="18">Transport</option>
			                    		                    </select>
	
		                    <select id="location" name="location">
		                        			                    	<option value="">Location</option>
			                    			                    	<option value="44">Kuwait</option>
			                    			                    	<option selected="selected" value="45">Qatar</option>
			                    			                    	<option value="40">United Arab Emirates</option>
			                    			                    	<option value="41">Iraq</option>
			                    			                    	<option value="42">Jordan</option>
			                    			                    	<option value="43">Kingdom of Saudi Arabia</option>
			                    		                    </select>                
		        </form>

<a href="#" onclick="javascript:getContent()">Get ID</a>
</body>
</html>