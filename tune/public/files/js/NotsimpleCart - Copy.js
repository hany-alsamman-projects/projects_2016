function sha1 (str) {
    // Calculate the sha1 hash of a string  
    var rotate_left = function (n, s) {
        var t4 = (n << s) | (n >>> (32 - s));
        return t4;    };
 
    var cvt_hex = function (val) {
        var str = "";
        var i;
        var v; 
        for (i = 7; i >= 0; i--) {
            v = (val >>> (i * 4)) & 0x0f;
            str += v.toString(16);
        }        return str;
    };
 
    var blockstart;
    var i, j;    var W = new Array(80);
    var H0 = 0x67452301;
    var H1 = 0xEFCDAB89;
    var H2 = 0x98BADCFE;
    var H3 = 0x10325476;    var H4 = 0xC3D2E1F0;
    var A, B, C, D, E;
    var temp;
 
    str = this.utf8_encode(str);    var str_len = str.length;
 
    var word_array = [];
    for (i = 0; i < str_len - 3; i += 4) {
        j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 | str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);        word_array.push(j);
    }
 
    switch (str_len % 4) {
    case 0:        i = 0x080000000;
        break;
    case 1:
        i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
        break;    case 2:
        i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
        break;
    case 3:
        i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) << 8 | 0x80;        break;
    }
 
    word_array.push(i);
     while ((word_array.length % 16) != 14) {
        word_array.push(0);
    }
 
    word_array.push(str_len >>> 29);    word_array.push((str_len << 3) & 0x0ffffffff);
 
    for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
        for (i = 0; i < 16; i++) {
            W[i] = word_array[blockstart + i];        }
        for (i = 16; i <= 79; i++) {
            W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
        }
  
        A = H0;
        B = H1;
        C = H2;
        D = H3;        E = H4;
 
        for (i = 0; i <= 19; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
            E = D;            D = C;
            C = rotate_left(B, 30);
            B = A;
            A = temp;
        } 
        for (i = 20; i <= 39; i++) {
            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
            E = D;
            D = C;            C = rotate_left(B, 30);
            B = A;
            A = temp;
        }
         for (i = 40; i <= 59; i++) {
            temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);            B = A;
            A = temp;
        }
 
        for (i = 60; i <= 79; i++) {            temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
            E = D;
            D = C;
            C = rotate_left(B, 30);
            B = A;            A = temp;
        }
 
        H0 = (H0 + A) & 0x0ffffffff;
        H1 = (H1 + B) & 0x0ffffffff;        H2 = (H2 + C) & 0x0ffffffff;
        H3 = (H3 + D) & 0x0ffffffff;
        H4 = (H4 + E) & 0x0ffffffff;
    }
     temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
    return temp.toLowerCase();
}


function utf8_encode (argString) {
// http://kevin.vanzonneveld.net
// +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// +   improved by: sowberry
// +    tweaked by: Jack
// +   bugfixed by: Onno Marsman
// +   improved by: Yves Sucaet
// +   bugfixed by: Onno Marsman
// +   bugfixed by: Ulrich
// +   bugfixed by: Rafal Kukawski
// *     example 1: utf8_encode('Kevin van Zonneveld');
// *     returns 1: 'Kevin van Zonneveld'

if (argString === null || typeof argString === "undefined") {
return "";
}

var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
var utftext = "",
start, end, stringl = 0;

start = end = 0;
stringl = string.length;
for (var n = 0; n < stringl; n++) {
var c1 = string.charCodeAt(n);
var enc = null;

if (c1 < 128) {
end++;
} else if (c1 > 127 && c1 < 2048) {
enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
} else {
enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
}
if (enc !== null) {
if (end > start) {
utftext += string.slice(start, end);
}
utftext += enc;
start = end = n + 1;
}
}

if (end > start) {
utftext += string.slice(start, stringl);
}

return utftext;
}

function base64_encode (data) {
    // Encodes string using MIME base64 algorithm  
    
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        enc = "",
        tmp_arr = [];
     if (!data) {
        return data;
    }
 
    data = this.utf8_encode(data + ''); 
    do { // pack three octets into four hexets
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++); 
        bits = o1 << 16 | o2 << 8 | o3;
 
        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;
 
        // use hexets to index into b64, and append result to encoded string
        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);    } while (i < data.length);
 
    enc = tmp_arr.join('');
 
    switch (data.length % 3) {    case 1:
        enc = enc.slice(0, -2) + '==';
        break;
    case 2:
        enc = enc.slice(0, -1) + '=';        break;
    }
 
    return enc;
}


function number_format( number, decimals, dec_point, thousands_sep ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://crestidg.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)    
    // *     example 1: number_format(1234.5678, 2, '.', '');
    // *     returns 1: 1234.57     
 
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

var NextId=1,Custom="Custom",alertpay="alertpay",GoogleCheckout="GoogleCheckout",liqpay="liqpay",Email="Email",AustralianDollar=AUD="AUD",CanadianDollar=CAD="CAD",CzechKoruna=CZK="CZK",DanishKrone=DKK="DKK",Euro=EUR="EUR",HongKongDollar=HKD="HKD",HungarianForint=HUF="HUF",IsraeliNewSheqel=ILS="ILS",JapaneseYen=JPY="JPY",MexicanPeso=MXN="MXN",NorwegianKrone=NOK="NOK",NewZealandDollar=NZD="NZD",PolishZloty=PLN="PLN",PoundSterling=GBP="GBP",SingaporeDollar=SGD="SGD",SwedishKrona=SEK="SEK",SwissFranc=CHF="CHF",SyrianPond=SYP="SYP",USDollar=USD="USD";
function Cart(){

	var me = this;
	/* member variables */
	me.Version = '2.0.1';
	me.Shelf = new Shelf();
	me.items = {};
	me.isLoaded = false;
	me.pageIsReady = false;
	me.quantity = 0;
	me.total = 0;
	me.taxRate = 0;
	me.taxCost = 0;
	me.shippingFlatRate = 0;
	me.shippingTotalRate = 0;
	me.shippingQuantityRate = 0;
	me.shippingRate = 0;
	me.shippingCost = 0;
	me.currency = USD;
	me.checkoutTo = liqpay;
	me.email = "";
	me.merchantId	 = "";
	me.cartHeaders = ['Name','Price','Quantity','Total'];
	/* 
		cart headers: 
		you can set these to which ever order you would like, and the cart will display the appropriate headers
		and item info.  any field you have for the items in the cart can be used, and 'Total' will automatically 
		be price*quantity.  
		
		there are keywords that can be used:
			
			1) "_input" - the field will be a text input with the value set to the given field. when the user
				changes the value, it will update the cart.  this can be useful for quantity. (ie "Quantity_input")
			
			2) "increment" - a link with "+" that will increase the item quantity by 1
			
			3) "decrement" - a link with "-" that will decrease the item quantity by 1
			
			4) "remove" - a link that will remove the item from the cart 
			
			5) "_image" or "Image" - the field will be an img tag with the src set to the value. You can simply use "Image" if
				you set a field in the items called "Image".  If you have a field named something else, like "Thumb", you can add
				the "_image" to create the image tag (ie "Thumb_image").
				
			6) "_noHeader" - this will skip the header for that field (ie "increment_noHeader")
		
	
	*/
	
	/******************************************************
			add/remove items to cart  
 	 ******************************************************/

	me.add = function () {
		var me=this;
		/* load cart values if not already loaded */
		if( !me.pageIsReady 	) { 
			me.initializeView(); 
			me.update();	
		}
		if( !me.isLoaded 		) { 
			//me.load(); 
			me.update();	
		}
		
		var newItem = new CartItem();
		
		/* check to ensure arguments have been passed in */
		if( !arguments || arguments.length === 0 ){
			error( 'No values passed for item.');
			return;
		}
		var argumentArray = arguments;
		if( arguments[0] && typeof( arguments[0] ) != 'string' && typeof( arguments[0] ) != 'number'  ){ 
			argumentArray = arguments[0]; 
		} 
	
		newItem.parseValuesFromArray( argumentArray );
		newItem.checkQuantityAndPrice();
		
		/* if the item already exists, update the quantity */
		if( me.hasItem(newItem) ) {
		//	var id=me.hasItem(newItem);
		//	me.items[id].quantity= parseInt(me.items[id].quantity,10) + parseInt(newItem.quantity,10);
		} else {
			me.items[newItem.id] = newItem;
		}	
		
		me.update();
        jQuery('a[rel*=facebox]').facebox();
	};
	
	
	me.remove = function( id ){
	   
		var tempArray = {};
		for( var item in this.items ){
			if( item != id ){ 
				tempArray[item] = this.items[item]; 
			}
		}
		this.items = tempArray;
	};
	
	me.empty = function () {
		simpleCart.items = {};
		simpleCart.update();
	};
	
	/******************************************************
			 item accessor functions
     ******************************************************/

	me.find = function (criteria) {
		if( !criteria )
			return null;
		var results = [];
		for( var next in me.items ){
			var item = me.items[next],
				fits = true;
			for( var name in criteria ){
				if( !item[name] || item[name] != criteria[name] )
					fits = false;
			}
			if( fits )
				results.push( me.next )
		}
		return (results.length == 0 ) ? null : results;
	}

	/******************************************************
			 checkout management 
     ******************************************************/

	me.checkout = function() {
		if( simpleCart.quantity === 0 ){
			error("Please Select Payment Methode");
			return;
		}
		switch( simpleCart.checkoutTo ){
		  
//			case EcommerceCheckout:
//				simpleCart.MyEcommerceCheckout();
//				break;
			case liqpay:
				simpleCart.liqpay();
				break;
			case GoogleCheckout:
				simpleCart.googleCheckout();
				break;                
			case alertpay:
				simpleCart.alertpay();
				break;
			case Email:
				simpleCart.emailCheckout();
				break;
			default:
				simpleCart.customCheckout();
				break;
		}
	};
	
	me.liqpay = function() {
		
         
		var form = document.createElement("form");
        
		form.style.display = "none";
		form.method = "POST";
		form.action = "https://liqpay.com/?do=clickNbuy";
		form.acceptCharset = "utf-8";
        var OrderID = '1';
        var txthttp = 'http://tune-forex.com/en/index.php?action=OrderProcess';
        
        var MyMerchNum = 'finance@tune-forex.com';
        var Mycurrency = 'USD';
        var MyPrice = $("#amount").val();
        
        var MyType = 'item';
        var MyName = 'Charge My Account';

        jQuery.facebox({ div: '#totalam' }, function(){ $(this).delay(5000) }); 
        
        var map = { 
          'version': '1.2', 
          'result_url': 'no duh',
          'server_url': 'no duh',
          'merchant_id': 'no duh',
          'order_id': '1',
          'amount': parseFloat( MyPrice ),
          'description': 'no duh',
          'currency': Mycurrency,
          'description': 'no duh',
          'pay_way': 'card',
        };

        var node = '';
        $.each(map, function(key, value){ 
            //alert('<' + key + '>' + value + '</' +  key + '>');
            //if($(this).attr('name') != '')
            node += '<' + key + '>' + value + '</' +  key + '>';
            
        });
        
        var xml = '<request>'+node+'</request>';

        form.appendChild( me.createHiddenElement( "operation_xml", base64_encode(xml)) );
        
        form.appendChild( me.createHiddenElement( "signature", base64_encode(sha1(xml+map[3]+xml)) ) );
        
        document.body.appendChild( form );

	};
    
	me.alertpay = function() {

		
		var form = document.createElement("form");
        
		form.style.display = "none";
		form.method = "POST";
		form.action = "https://www.alertpay.com/PayProcess.aspx";
		form.acceptCharset = "utf-8";
        var OrderID = '1';
        var txthttp = 'http://tune-forex.com/en/index.php?action=OrderProcess';
        
        var MyMerchNum = 'finance@tune-forex.com';
        var Mycurrency = 'USD';
        var MyPrice = $("#amount").val();
        
        var MyType = 'item';
        var MyName = 'Charge My Account';
		
        form.appendChild( me.createHiddenElement( "ap_merchant", MyMerchNum) );        
        //form.appendChild( me.createHiddenElement( "ap_itemcode", document.getElementById('OrderID').value) );
        form.appendChild( me.createHiddenElement( "ap_currency", Mycurrency ) );        
        form.appendChild( me.createHiddenElement( "ap_returnurl", txthttp) );        
        form.appendChild( me.createHiddenElement( "ap_amount", parseFloat( MyPrice )) );        
        form.appendChild( me.createHiddenElement( "ap_quantity", 1) );
        form.appendChild( me.createHiddenElement( "ap_purchasetype", MyType) );
        form.appendChild( me.createHiddenElement( "ap_itemname", MyName) );
        

        //form.appendChild( me.createHiddenElement( "signature", calcMD5(Total+Mycurrency+OrderID+MyMerchNum+txthttp+md5_key)) );       
         
        jQuery.facebox({ div: '#totalam' }, function(){ $(this).delay(5000) }); 
          
        document.body.appendChild( form );
        //alert(myquantity);
        
		form.submit();
		document.body.removeChild( form );
	};

	me.googleCheckout = function() {

		
		var form = document.createElement("form"),
			counter = 1;
		form.style.display = "none";
		form.method = "POST";
		form.action = "https://www.netcommercepay.com/iPAY/Default.asp";
		form.acceptCharset = "utf-8";
        var OrderID = document.getElementById('OrderID').value;
        var txthttp = 'http://jasmin.3njoom.com/en/index.php?action=OrderProcess';
        var MyMerchNum = '04050502';
        var md5_key = '3NJOOM505';
        var Mycurrency = 840;
		
        form.appendChild( me.createHiddenElement( "txtMerchNum", MyMerchNum) );        
        form.appendChild( me.createHiddenElement( "txtIndex", document.getElementById('OrderID').value) );
        form.appendChild( me.createHiddenElement( "txtCurrency", Mycurrency ) );
        form.appendChild( me.createHiddenElement( "Lng", 'EN') );
        form.appendChild( me.createHiddenElement( "txthttp", 'http://jasmin.3njoom.com/en/index.php?action=OrderProcess') );
        
        var myquantity = '';
        var myname = '';
        var myprice = '';
        
        var myprice = 0;
        
        var myquantity = 0;

                
        for( var current in me.items ){
			var item = me.items[current];
                        

            myprice = myprice + parseFloat( item.price );
            
            myquantity = myquantity + item.quantity;
            
            //var myprice += number_format(item.price, 2, '.', '');
			
			counter++;
		}
        
        var Total = number_format(myprice, 2, '.', '');
        
        form.appendChild( me.createHiddenElement( "item_quantity", myquantity) );
        
		form.appendChild( me.createHiddenElement( "txtAmount", Total) );

        form.appendChild( me.createHiddenElement( "signature", calcMD5(Total+Mycurrency+OrderID+MyMerchNum+txthttp+md5_key)) );
        
        document.body.appendChild( form );
        //alert(myquantity);
		form.submit();
		document.body.removeChild( form );
	};
	
	
	me.emailCheckout = function() {
		return;
	};
	
	me.customCheckout = function() {

//          if ($(".simpleCart_finalTotal").text()) {
//            $(".simpleCart_total").text("Not valid!").show().fadeIn(2000);
//            return false;         
//          }

	};




	/******************************************************
				data storage and retrival 
	 ******************************************************/
	
	/* load cart from cookie */
	me.load = function () {
		var me = this;
		/* initialize variables and items array */
		me.items = {};
		me.total = 0.00;
		me.quantity = 0;
		
		/* retrieve item data from cookie */
		if( readCookie('simpleCart') == 'fuck'){
			var data = unescape(readCookie('simpleCart')).split('++');
			for(var x=0, xlen=data.length;x<xlen;x++){
			
				var info = data[x].split('||');
				var newItem = new CartItem();
			
				if( newItem.parseValuesFromArray( info ) ){
					newItem.checkQuantityAndPrice();
					/* store the new item in the cart */
					me.items[newItem.id] = newItem;
				}
 			}
		}
		me.isLoaded = true;
	};
	
	
	
	/* save cart to cookie */
	me.save = function () {
		var dataString = "";
		for( var item in this.items ){
			dataString = dataString + "++" + this.items[item].print();
		}
		createCookie('simpleCart', dataString.substring( 2 ), 30 );
	};
	
	

	
		
	/******************************************************
				 view management 
	 ******************************************************/
	
	me.initializeView = function() {
		var me = this;
		me.totalOutlets 			= getElementsByClassName('simpleCart_total');
		me.quantityOutlets 			= getElementsByClassName('simpleCart_quantity');
		me.cartDivs 				= getElementsByClassName('simpleCart_items');
		me.taxCostOutlets			= getElementsByClassName('simpleCart_taxCost');
		me.taxRateOutlets			= getElementsByClassName('simpleCart_taxRate');
		me.shippingCostOutlets		= getElementsByClassName('simpleCart_shippingCost');
		me.finalTotalOutlets		= getElementsByClassName('simpleCart_finalTotal');
		
		me.addEventToArray( getElementsByClassName('simpleCart_checkout') , simpleCart.checkout , "click");
		me.addEventToArray( getElementsByClassName('simpleCart_empty') 	, simpleCart.empty , "click" );
		
		me.Shelf.readPage();
			
		me.pageIsReady = true;
		
	};
    
    
	me.removeextra = function ( id ) {
		
        var extra = id;
        var product_id = $('#OrderID').val();
        
        $.ajax({
           type: "POST",
           url: "index.php?task=removefromorder",
           data: "extra_id="+extra+"&product_id="+product_id+"",
           success: function(msg){
             jQuery.facebox("Deleted Ok");
           }
        });
        
        
	};	
	
	me.updateView = function() {
		me.updateViewTotals();
		if( me.cartDivs && me.cartDivs.length > 0 ){ 
			me.updateCartView(); 
		}
	};
	
	me.updateViewTotals = function() {
		var outlets = [ ["quantity"		, "none"		] , 
						["total"		, "currency"	] , 
						["shippingCost"	, "currency"	] ,
						["taxCost"		, "currency"	] ,
						["taxRate"		, "percentage"	] ,
						["finalTotal"	, "currency"	] ];
						
		for( var x=0,xlen=outlets.length; x<xlen;x++){
			
			var arrayName = outlets[x][0] + "Outlets",
				outputString;
				
			for( var element in me[ arrayName ] ){
				switch( outlets[x][1] ){
					case "none":
						outputString = "" + me[outlets[x][0]];
						break;
					case "currency":
						outputString = me.valueToCurrencyString( me[outlets[x][0]] );
						break;
					case "percentage":
						outputString = me.valueToPercentageString( me[outlets[x][0]] );
						break;
					default:
						outputString = "" + me[outlets[x][0]];
						break;
				}
				me[arrayName][element].innerHTML = "" + outputString;
			}
		}
	};
	
	me.updateCartView = function() {
		var newRows = [],
			x,newRow,item,current,header,newCell,info,outputValue,option,headerInfo;
		
		/* create headers row */
		newRow = document.createElement('div');
		for( header in me.cartHeaders ){
			newCell = document.createElement('div');
			headerInfo = me.cartHeaders[header].split("_");
			
			newCell.innerHTML = headerInfo[0];
			newCell.className = "item" + headerInfo[0];
			for(x=1,xlen=headerInfo.length;x<xlen;x++){
				if( headerInfo[x].toLowerCase() == "noheader" ){
					newCell.style.display = "none";
				}
			}
			newRow.appendChild( newCell );
			
		}
		newRow.className = "cartHeaders";
		newRows[0] = newRow;
		
		/* create a row for each item in the cart */
		x=1;
		for( current in me.items ){
			newRow = document.createElement('div');
			item = me.items[current];
			
			for( header in me.cartHeaders ){
				
				newCell = document.createElement('div');
				info = me.cartHeaders[header].split("_");
				
				switch( info[0].toLowerCase() ){
					case "total":
						outputValue = me.valueToCurrencyString(parseFloat(item.price)*parseInt(item.quantity,10) );
						break;
					case "increment":
						outputValue = me.valueToLink( "<img src='images/up.png' />" , "javascript:;" , "onclick=\"simpleCart.items[\'" + item.id + "\'].increment();\"" );
						break;
					case "decrement":
						outputValue = me.valueToLink( "<img src='images/down.png' />" , "javascript:;" , "onclick=\"simpleCart.items[\'" + item.id + "\'].decrement();\"" );
						break;
					case "remove":
						outputValue = me.valueToLink( "<img src='images/delete.gif' />" , "javascript:;" , "class=\"removeextra\" onclick=\"simpleCart.items[\'" + item.id + "\'].remove();simpleCart.removeextra("+item['myremove']+");\"" );
						break;
					case "price":
						outputValue = me.valueToCurrencyString( item[ info[0].toLowerCase() ] ? item[info[0].toLowerCase()] : " " );
						break;
					default: 
						outputValue = item[ info[0].toLowerCase() ] ? item[info[0].toLowerCase()] : " ";
						break;
				}	
				
				for( var y=1,ylen=info.length;y<ylen;y++){
					option = info[y].toLowerCase();
					switch( option ){
						case "image":
						case "img":
							outputValue = me.valueToImageString( outputValue );		
							break;
						case "input":
							outputValue = me.valueToTextInput( outputValue , "onchange=\"simpleCart.items[\'" + item.id + "\'].set(\'" + outputValue + "\' , this.value);\""  );
							break;
						case "div":
						case "span":
						case "h1":
						case "h2":
						case "h3":
						case "h4":
						case "p":
							outputValue = me.valueToElement( option , outputValue , "" );
							break;
						case "noheader":
							break;
						default:
							error( "unkown header option: " + option );
							break;
					}
				
				}		  
				newCell.innerHTML = outputValue;
				newCell.className = "item" + info[0];
				newRow.appendChild( newCell );
			}			
			newRow.className = "itemContainer";
			newRows[x] = newRow;
			x++;
		}
		
		
		
		for( current in me.cartDivs ){
			
			/* delete current rows in div */
			var div = me.cartDivs[current];
			while( div.childNodes[0] ){
				div.removeChild( div.childNodes[0] );
			}
			
			for(var j=0, jLen = newRows.length; j<jLen; j++){
				div.appendChild( newRows[j] );
			}
			
			
		}
	};

	me.addEventToArray = function ( array , functionCall , theEvent ) {
		for( var outlet in array ){
			var element = array[outlet];
			if( element.addEventListener ) {
				element.addEventListener(theEvent, functionCall , false );
			} else if( element.attachEvent ) {
			  	element.attachEvent( "on" + theEvent, functionCall );
			}
		}
	};
	
	
	me.createHiddenElement = function ( name , value ){
		var element = document.createElement("input");
		element.type = "hidden";
		element.name = name;
        element.id = name;
		element.value = value;
		return element;
	};
	
	
	
	/******************************************************
				Currency management
	 ******************************************************/
	
	me.currencySymbol = function() {		
		switch(me.currency){
			case JPY:
				return "&yen;";
			case EUR:
				return "&euro;";
			case GBP:
				return "&pound;";
			case USD:
			case CAD:
			case AUD:
			case NZD:
			case HKD:
//            case SYP:
//            return "SP ";
			case SGD:
				return "&#36;";
			default:
				return "";
		}
	};
	
	
	me.currencyStringForPaypalCheckout = function( value ){
		if( me.currencySymbol() == "&#36;" ){
			return "$" + parseFloat( value ).toFixed(2);
		} else {
			return "" + parseFloat(value ).toFixed(2);
		}
	};
	
	/******************************************************
				Formatting
	 ******************************************************/
	
	
	me.valueToCurrencyString = function( value ) {
		return parseFloat( value ).toCurrency( me.currencySymbol() );
	};
	
	me.valueToPercentageString = function( value ){
		return parseFloat( 100*value ) + "%";
	};
	
	me.valueToImageString = function( value ){
		if( value.match(/<\s*a.*href\=/) ){
			return value;
		} else {
			return "<a rel=\"facebox\" href=\"" + value + "\"><img src=\"images/pictures.png\" ></a>";
		}
	};
	
	me.valueToTextInput = function( value , html ){
		return "<input type=\"text\" value=\"" + value + "\" " + html + " />";
	};
	
	me.valueToLink = function( value, link, html){
		return "<a href=\"" + link + "\" " + html + " >" + value + "</a>";
	};
	
	me.valueToElement = function( type , value , html ){
		return "<" + type + " " + html + " > " + value + "</" + type + ">";
	};
	
	/******************************************************
				Duplicate management
	 ******************************************************/
	
	me.hasItem = function ( item ) {
		for( var current in me.items ) {
			var testItem = me.items[current];
			var matches = true;
			for( var field in item ){
				if( typeof( item[field] ) != "function"	&& 
					field != "quantity"  				&& 
					field != "id" 						){
					if( item[field] != testItem[field] ){
						matches = false;
					}
				}	
			}
			if( matches ){ 
				return current; 
			}
		}
		return false;
	};
	
	
	
	
	/******************************************************
				Cart Update managment
	 ******************************************************/
	
	me.update = function() {
		if( !simpleCart.isLoaded ){
			simpleCart.load();
		} 
		if( !simpleCart.pageIsReady ){
			simpleCart.initializeView();
		}
		me.updateTotals();
		me.updateView();
		//me.save();
	};
	
	me.updateTotals = function() {
		me.total = 0 ;
		me.quantity  = 0;
		for( var current in me.items ){
			var item = me.items[current];
			if( item.quantity < 1 ){ 
				item.remove();
			} else if( item.quantity !== null && item.quantity != "undefined" ){
				me.quantity = parseInt(me.quantity,10) + parseInt(item.quantity,10); 
			}
			if( item.price ){ 
				me.total = parseFloat(me.total) + parseInt(item.quantity,10)*parseFloat(item.price); 
			}
		}
		me.shippingCost = me.shipping();
		me.taxCost = parseFloat(me.total)*me.taxRate;
		me.finalTotal = me.shippingCost + me.taxCost + me.total;
	};
	
	me.shipping = function(){
		if( parseInt(me.quantity,10)===0 )
			return 0;
		var shipping = 	parseFloat(me.shippingFlatRate) + 
					  	parseFloat(me.shippingTotalRate)*parseFloat(me.total) +
						parseFloat(me.shippingQuantityRate)*parseInt(me.quantity,10),
			nextItem,
			next;
		for(next in me.items){
			nextItem = me.items[next];
			if( nextItem.shipping ){
				if( typeof nextItem.shipping == 'function' ){
					shipping += parseFloat(nextItem.shipping());
				} else {
					shipping += parseFloat(nextItem.shipping);
				}
			}
		}
		
		return shipping;
	}
	
	me.initialize = function() {
		simpleCart.initializeView();
		simpleCart.load();
		simpleCart.update();
	};
				
}

/********************************************************************************************************
 *			Cart Item Object
 ********************************************************************************************************/

function CartItem() {
	this.id = "c" + NextId++;
}
	CartItem.prototype.set = function ( field , value ){
		field = field.toLowerCase();
		if( typeof( this[field] ) != "function" && field != "id" ){
			if( field == "quantity" ){
				value = value.replace( /[^(\d|\.)]*/gi , "" );
				value = value.replace(/,*/gi, "");
				value = parseInt(value,10);
			} else if( field == "price"){
				value = value.replace( /[^(\d|\.)]*/gi, "");
				value = value.replace(/,*/gi , "");
				value = parseFloat( value );
			}
			if( typeof(value) == "number" && isNaN( value ) ){
				error( "Improperly formatted input.");
			} else {
				this[field] = value;
				this.checkQuantityAndPrice();
			}			
		} else {
			error( "Cannot change " + field + ", this is a reserved field.");
		}
		simpleCart.update();
	};
	
	CartItem.prototype.increment = function(){
		this.quantity = parseInt(this.quantity,10) + 1;
		simpleCart.update();
	};
	
	CartItem.prototype.decrement = function(){
		if( parseInt(this.quantity,10) < 2 ){
			this.remove();
		} else {
			this.quantity = parseInt(this.quantity,10) - 1;
			simpleCart.update();
		}
	};
	
	CartItem.prototype.print = function () {
		var returnString = '';
		for( var field in this ) {
			if( typeof( this[field] ) != "function" ) {
				returnString+= escape(field) + "=" + escape(this[field]) + "||";
			}
		}
		return returnString.substring(0,returnString.length-2);
	};
	
	
	CartItem.prototype.checkQuantityAndPrice = function() {
		if( !this.price || this.quantity == null || this.quantity == 'undefined'){ 
			this.quantity = 1;
			error('No quantity for item.');
		} else {
			this.quantity = ("" + this.quantity).replace(/,*/gi, "" );
			this.quantity = parseInt( ("" + this.quantity).replace( /[^(\d|\.)]*/gi, "") , 10); 
			if( isNaN(this.quantity) ){
				error('Quantity is not a number.');
				this.quantity = 1;
			}
		}
				
		if( !this.price || this.price == null || this.price == 'undefined'){
			this.price=0.00;
			error('No price for item or price not properly formatted.');
		} else {
			this.price = ("" + this.price).replace(/,*/gi, "" );
			this.price = parseFloat( ("" + this.price).replace( /[^(\d|\.)]*/gi, "") ); 
			if( isNaN(this.price) ){
				error('Price is not a number.');
				this.price = 0.00;
			}
		}
        
	};
	
	
	CartItem.prototype.parseValuesFromArray = function( array ) {
		if( array && array.length && array.length > 0) {
			for(var x=0, xlen=array.length; x<xlen;x++ ){
			
				/* ensure the pair does not have key delimeters */
				array[x].replace(/||/, "| |");
				array[x].replace(/\+\+/, "+ +");
			
				/* split the pair and save the unescaped values to the item */
				var value = array[x].split('=');
				if( value.length>1 ){
					if( value.length>2 ){
						for(var j=2, jlen=value.length;j<jlen;j++){
							value[1] = value[1] + "=" + value[j];
						}
					}
					this[ unescape(value[0]).toLowerCase() ] = unescape(value[1]);
				}
			}
			return true;
		} else {
			return false;
		}
	};
	
	CartItem.prototype.remove = function() {
		simpleCart.remove(this.id);
		simpleCart.update();
	};
	


/********************************************************************************************************
 *			Shelf Object for managing items on shelf that can be added to cart
 ********************************************************************************************************/

function Shelf(){
	this.items = {};
}	
	Shelf.prototype.readPage = function () {
		this.items = {};
		var newItems = getElementsByClassName( "simpleCart_shelfItem" );
		for( var current in newItems ){
			var newItem = new ShelfItem();
			this.checkChildren( newItems[current] , newItem );
			this.items[newItem.id] = newItem;
		}
	};
	
	Shelf.prototype.checkChildren = function ( item , newItem) {
		
		for(var x=0;item.childNodes[x];x++){
			
			var node = item.childNodes[x];
			if( node.className && node.className.match(/item_[^ ]+/) ){
				
				var data = /item_[^ ]+/.exec(node.className)[0].split("_");
				
				if( data[1] == "add" || data[1] == "Add" ){
					var tempArray = [];
					tempArray.push( node );
					var addFunction = simpleCart.Shelf.addToCart(newItem.id);
					simpleCart.addEventToArray( tempArray , addFunction , "click");
					node.id = newItem.id;
				} else {
					newItem[data[1]]  = node;
				}
			}		
			if( node.childNodes[0] ){ 
				this.checkChildren( node , newItem );	
			}	
		}
	};
	
	Shelf.prototype.empty = function () {
		this.items = {};
	};
	
	
	Shelf.prototype.addToCart = function ( id ) {
		return function(){
			if( simpleCart.Shelf.items[id]){
				simpleCart.Shelf.items[id].addToCart();
			} else {
				error( "Shelf item with id of " + id + " does not exist.");
			}
		};
	};
	

/********************************************************************************************************
 *			Shelf Item Object
 ********************************************************************************************************/


function ShelfItem(){
	this.id = "s" + NextId++;
}	
	ShelfItem.prototype.remove = function () {
		simpleCart.Shelf.items[this.id] = null;
	};
	
	
	ShelfItem.prototype.addToCart = function () {
		var outStrings = [],valueString;
		for( var field in this ){
			if( typeof( this[field] ) != "function" && field != "id" ){
				valueString = "";
				
				switch(field){
					case "price":
						if( this[field].value ){
							valueString = this[field].value; 
						} else if( this[field].innerHTML ) {
							valueString = this[field].innerHTML;
						}
						/* remove all characters from price except digits and a period */
						valueString = valueString.replace( /[^(\d|\.)]*/gi , "" );
						valueString = valueString.replace( /,*/ , "" );
						break;
					case "image":
						valueString = this[field].src;
						break;
					default:
						if( this[field].value ){
							valueString = this[field].value; 
						} else if( this[field].innerHTML ) {
							valueString = this[field].innerHTML;
						} else if( this[field].src ){
							valueString = this[field].src;
						} else {
							valueString = this[field];
						}
						break;
				}
				outStrings.push( field + "=" + valueString );
			}
		}
		
		simpleCart.add( outStrings );
	};
	


/********************************************************************************************************
 * Thanks to Peter-Paul Koch for these cookie functions (http://www.quirksmode.org/js/cookies.html)
 ********************************************************************************************************/
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}


//*************************************************************************************************
/*
	Developed by Robert Nyman, http://www.robertnyman.com
	Code/licensing: http://code.google.com/p/getelementsbyclassname/
*/	
var getElementsByClassName = function (className, tag, elm){
	if (document.getElementsByClassName) {
		getElementsByClassName = function (className, tag, elm) {
			elm = elm || document;
			var elements = elm.getElementsByClassName(className),
				nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
				returnElements = [],
				current;
			for(var i=0, il=elements.length; i<il; i+=1){
				current = elements[i];
				if(!nodeName || nodeName.test(current.nodeName)) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	else if (document.evaluate) {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = "",
				xhtmlNamespace = "http://www.w3.org/1999/xhtml",
				namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
				returnElements = [],
				elements,
				node;
			for(var j=0, jl=classes.length; j<jl; j+=1){
				classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
			}
			try	{
				elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
			}
			catch (e) {
				elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
			}
			while ((node = elements.iterateNext())) {
				returnElements.push(node);
			}
			return returnElements;
		};
	}
	else {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = [],
				elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
				current,
				returnElements = [],
				match;
			for(var k=0, kl=classes.length; k<kl; k+=1){
				classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
			}
			for(var l=0, ll=elements.length; l<ll; l+=1){
				current = elements[l];
				match = false;
				for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
					match = classesToCheck[m].test(current.className);
					if (!match) {
						break;
					}
				}
				if (match) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	return getElementsByClassName(className, tag, elm);
};


/********************************************************************************************************
 *  Helpers
 ********************************************************************************************************/


String.prototype.reverse=function(){return this.split("").reverse().join("");};
Number.prototype.withCommas=function(){var x=6,y=parseFloat(this).toFixed(2).toString().reverse();while(x<y.length){y=y.substring(0,x)+","+y.substring(x);x+=4;}return y.reverse();};
Number.prototype.toCurrency=function(){return(arguments[0]?arguments[0]:"$")+this.withCommas();};


/********************************************************************************************************
 * error management 
 ********************************************************************************************************/

function error( message ){
	try{ 
		//console.log( message ); 
        jQuery.facebox(message);
	}catch(err){ 
	//	alert( message );
	}
}

var simpleCart = new Cart();

if( typeof jQuery !== 'undefined' ) $(document).ready(function(){simpleCart.initialize();}); 
else if( typeof Prototype !== 'undefined') Event.observe( window, 'load', function(){simpleCart.initialize();});
else window.onload = simpleCart.initialize;