
window.onresize = function(){loadPage();} 
var viewportwidth; 
var viewportheight; 
function getPageSize(){		  
	// the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight  
	if (typeof window.innerWidth != 'undefined') {     
		viewportwidth = window.innerWidth,      
		viewportheight = window.innerHeight 
	}  
	// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document) 
		else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth !='undefined' && document.documentElement.clientWidth != 0) {      
		viewportwidth = document.documentElement.clientWidth,      
		viewportheight = document.documentElement.clientHeight 
	}   
	// older versions of IE   
	else {      
		viewportwidth = document.getElementsByTagName('body')[0].clientWidth,      
		viewportheight = document.getElementsByTagName('body')[0].clientHeight 
	}
	return [viewportwidth,viewportheight];
	
}
var Dwidth=1000;
var Dheight=300;
var i_nameSel='';

var order_n=0;
var invice_n=0;
var damag_n=0;
var invices_n=0;
var orders_n=0;
var selcuss=0;	
var addInviceOpe=0;
var editInviceid=0;
var editOrdereOpe=0;
var editOrderID=0;
var cus_invices=0;
var count_inv_items=0;
var basyloadItem=0;
var itemsEditing=0;
var selItemsEditing=0;
var selItemsEditingval='';
var data_its=new Array();

var clickTracker = [];


function loadPage(){
	var wh=getPageSize();var w=wh[0]; var h=wh[1];
	if(w>Dwidth){
	//$('.main').css('width',w);
		//$('.b2').css('width',w-865);
		$('.footer').css('width',w);		
		//$('.l2').css('width',w-251);
		$('#cus_info').css('left',w-630);
	}
	if(h>Dheight){
		$('.main').css('height',h-10);
		$('.b1').css('height',h);
		$('.b2').css('height',h);
		$('.b3').css('height',h);
		$('#main_of_page').css('height',h-75);
	}
	//$('.l2').html(w+" | "+h);
}
function SHWin(id){
	if(document.getElementById(id).style.display=="block"){
		document.getElementById(id).style.display='none';
	}else{
		document.getElementById(id).style.display='block';
	}
	//$('#'+id).show()
}
function saveIteme2(){
	var err=0;
	var name=$('#it_name').val()
	var price=$('#it_price').val();
	if(name!=''){changeStyle('it_name',1);}else{changeStyle('it_name',0);err=1}
	if(!isNaN(price) && price!=''){changeStyle('it_price',1);}else{changeStyle('it_price',0);err=1}
	if(err==0){
		document.getElementById('addI').style.display='none';
		$.post('inc/ajax/add_item.php',{name:name,price:price}, function(data) {
			$('#it_name').val('');
			$('#it_price').val('');
			loadItems();		
		});
	}
}
function saveCus(){
	var err=0;
	var name=$('#cs_name').val()
	var phone=$('#cs_phone').val()
	var mobile=$('#cs_mobile').val()
	var com=$('#cs_com').val()
	
	if(com!=''){changeStyle('cs_com',1);}else{changeStyle('cs_com',0);err=1}
	if(name!=''){changeStyle('cs_name',1);}else{changeStyle('cs_name',0);err=1}
	if(err==0){
		document.getElementById('addC').style.display='none';
		$.post('inc/ajax/add_cus.php',{name:name,phone:phone,mobile:mobile,com:com}, function(data) {
			$('#cs_name').val('');
			$('#cs_phone').val('');
			$('#cs_mobile').val('');
			$('#cs_com').val('');
			loadCus();		
		});
	}
}
function loadItems(){
	$.post('inc/ajax/loadItems.php',{}, function(data) {
		loadCus();
		$('#Itemes').html(data);

		fixItems();
	});
	
}
function loadCus(){
	$.post('inc/ajax/loadCus.php',{}, function(data) {
		$('#Cus').html(data);
	});
}
function changeStyle(id,s){
	if(s==1){
		document.getElementById(id).style.borderColor='#999'
		document.getElementById(id).style.backgroundColor='#fff'
	}else{
		document.getElementById(id).style.borderColor='#f00'
		document.getElementById(id).style.backgroundColor='#fcc'
	}
}
function openawin(s){
	var ree=0;
		 if(order_n==1 && s!=1){ree=1;}
	else if(invice_n==1 && s!=2){ree=1;}
	else if(damag_n==1 && s!=3){ree=1;}
	else if(invices_n==1 && s!=4){ree=1;}
	else if(orders_n==1 && s!=5){ree=1;}
	return ree;
}
function newOrder(){
	if(openawin(1)==0){
		if(order_n==0){
			order_n=1;
			$('#order').show();
			$('.add_buy').css('backgroundColor','#cec')
			document.getElementById('ord_name').focus()
		}else{
			order_n=0;
			$('#order').hide();
			restOrder()
			$('.add_buy').css('backgroundColor','')
		}
	}
}
function newInvice(op){
	count_inv_items=0;
	addInviceOpe=0;
	if(openawin(2)==0){
		if(invice_n==0){			
			invice_n=1;
			if(editInviceid==0){
				$('#payDiv').show();
			}else{
				$('#payDiv').hide();
			}
			$('#invice').show();			
			$('.new_invice').css('backgroundColor','#cec')
		}else{
			selcuss=0;
			invice_n=0;
			$('#invice').hide();
			$('.new_invice').css('backgroundColor','')
			if(op==1){restInv(1)}
		}
	}
}

function setDamage(){
	if(openawin(3)==0){
		if(damag_n==0){
			damag_n=1;
			$('#damag').show();
			$('.damage').css('backgroundColor','#cec')
		}else{
			damag_n=0;
			$('#damag').hide();
			$('.damage').css('backgroundColor','')
		}
	}
}
function showInvices(){
	$('#invs_co').html('');
	$('#load_invs').show();
	if(openawin(4)==0){
		if(invices_n==0){			
			invices_n=1;			
			$('#invices').show();
			$('.s_invices').css('backgroundColor','#cec')
			$.post('inc/ajax/loadInvoices.php',{c:cus_invices}, function(data) {
				$('#invs_co').html(data);
				$('#load_invs').hide();
				$('#invs_co').show();
			});
		}else{
			invices_n=0;
			$('#invs_co').html('');
			$('#invices').hide();
			$('.s_invices').css('backgroundColor','')
		}
	}
}
function showOrder(){
	$('#ords_co').html('');
	$('#load_orders').show();
	if(openawin(5)==0){
		if(orders_n==0){			
			orders_n=1;			
			$('#orders').show();
			$('.s_orders').css('backgroundColor','#cec')
			$.post('inc/ajax/loadOrders.php',{c:cus_invices}, function(data) {
				$('#ords_co').html(data);
				$('#load_orders').hide();
				$('#ords_co').show();
			});
		}else{
			orders_n=0;
			$('#ords_co').html('');
			$('#orders').hide();
			$('.s_orders').css('backgroundColor','')
		}
	}
}
function rest_id(id){
	//alert(id)
	//v=id.split('-');
	//return v[0];
}
var c=0;
function add_iteme(id,q,p,c){

	//alert(c)
	if(order_n==1){
		selcs=$('#itemes_sel').val();
		ss=selcs.split(',')
		var un=0;
		for(i=0;i<ss.length;i++){
			if(id==ss[i]){
				un=1;
			}
		}
		if(un==0){	
			var table = document.getElementById('t_order'); 
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			row.setAttribute('id','ot'+id);
			var cell = row.insertCell(0);
			cell.setAttribute('align','right')		
			cell.innerHTML =data[id]['name']+' : ';
			
			var cell = row.insertCell(1);
			cell.innerHTML ='<input type="text" id="co'+data[id]['id']+'" class="int_text co5 ie"  onkeyup="count_ord()" value="'+q+'"	 />';
			
			var cell = row.insertCell(2);
			cell.innerHTML ='$<input type="text" id="co_p'+data[id]['id']+'" class="int_text co5 ie"  onkeyup="count_ord()" value="'+p+'" />';
			
			var cell = row.insertCell(3);
				cell.innerHTML ='<span id="co_total'+data[id]['id']+'">0</span>';
				cell.setAttribute('align','center')
				cell.setAttribute('style','width:80px;')
			
			
			var cell = row.insertCell(4);	
			cell.innerHTML ='<img src="images/delete.png" border="0" style="cursor:pointer" onclick="del_ite_sel('+data[id]['id']+',\'ot\',\'itemes_sel\')"/>';
			
			clickTracker_track("i"+data[id]['id']);
			
			var ss='';
			ilement_sel('add',id,'itemes_sel');
		}
		document.getElementById('co'+data[id]['id']).focus()
	}
	/*if(invice_n==1 || editInviceOpe==1){
		if(selcuss==1 || editInviceOpe==1){			
			$('#selQiteme').show();
			$('#selQiteme').html(loaderDiv('Loading ...'));
			if(editInviceOpe==1){
				var e_inv=$('#inv_id').val();
				$.post('inc/ajax/selQiteme.php',{id:id,inv:e_inv}, function(data) {
					$('#selQiteme').html(data);		
				});	
			
			}else{				
				$.post('inc/ajax/selQiteme.php',{id:id}, function(data) {
					$('#selQiteme').html(data);		
				});	
			}
		}
	}*/
	if(invice_n==1){
		if(basyloadItem==0){
			basyloadItem=1;
			if(selcuss==1){			
			selcs=$('#itemes_sel2').val();
			ss=selcs.split(',')
			var un=0;
			for(i=0;i<ss.length;i++){
				if(id==ss[i]){
					un=1;
				}
			}
			if(un==0 || 1==1){				
				priceee=data[id]['price'];				
				$('#mLoader').show();				
				//alert(count_inv_items)
				count_inv_items++
				$.post('inc/ajax/counatList.php',{id:id,c:c,n:(count_inv_items)}, function(da) {
					//alert('loding')		
				

					ilement_sel('add',id,'itemes_sel2');					
					if(editInviceid!=0){priceee=p;}
					$('#mLoader').hide();						
					var table = document.getElementById('t_invice'); 
					var rowCount = table.rows.length;
					var row = table.insertRow(rowCount);
					row.setAttribute('id','it'+id+'_'+count_inv_items);
					var cell = row.insertCell(0);
					cell.setAttribute('align','right')		
					cell.innerHTML =data[id]['name']+' : ';
					
					var cell = row.insertCell(1);
					cell.innerHTML =da;					
					
					var cell = row.insertCell(2);
					cell.innerHTML ='<input type="text" id="ci'+data[id]['id']+'_'+count_inv_items+'"value="'+q+'"  class="int_text co5 ie" onkeyup="count_invice()" />';
					
					var cell = row.insertCell(3);
					cell.innerHTML ='$<input type="text" id="ci_price'+data[id]['id']+'_'+count_inv_items+'" value="'+priceee+'" class="int_text co5 ie"  onkeyup="count_invice()"/>';
					
					var cell = row.insertCell(4);
					cell.innerHTML ='<span id="total'+data[id]['id']+'_'+count_inv_items+'">'+data[id]['price']+'</span>';
					cell.setAttribute('align','center')
					cell.setAttribute('style','width:80px;')
					
					var cell = row.insertCell(5);	
					cell.innerHTML ='<img src="images/delete.png" border="0" style="cursor:pointer" onclick="del_ite_sel(\''+data[id]['id']+'_'+count_inv_items+'\',\'it\',\'itemes_sel2\')"/>';
					cell.setAttribute('align','center')
					
					var ss='';					
					$('#ci'+data[id]['id']+'_'+count_inv_items).focus();
					count_invice();
					basyloadItem=0;
					//Click tracker
					clickTracker_track("i"+id);

					editLoadArray(selItemsEditing)
				});
			}
			
		}
		}
	}
	if(damag_n==1){
		$('#selQiteme').html('');		
		$('#selQiteme').show();
		$('#selQiteme').html(loaderDiv('Loading ...'));
		$.post('inc/ajax/selQiteme.php',{id:id,d:1}, function(data) {
			$('#selQiteme').html(data);
	
		});			
	}
}
function add_cus(id,name,e){
	if(invice_n==1){
		selcuss=1;
		$('#selCus_inv').hide();
		$('#cus_id').val(id);
		$('#cus_name').html('Invice to : <b>'+name+'</b>');
		$('#sel_item_inv').show();
		setNewInv();
	}else if(invices_n==1){
		showInvices();
		cus_invices=id;
		showInvices();
	}else{
		loadCusINfo(e,id)
	}
	
}
function init(id) {
	document.getElementById('cus'+id).onclick= getCursorXY;
}
function getPosition(e){
	var reest=new Array(0,0) 
	var isIE = document.all ? true : false;
	if (isIE) {
		reest[0]= event.clientX + (document.documentElement.scrollLeft);
		reest[1]= event.clientY + (document.documentElement.scrollTop);
	}else{
		reest[0] = e.pageX //+ document.body.scrollLeft;
		reest[1] = e.pageY //+ document.body.scrollTop;
	}	
	return reest
}
function loadCusINfo(e,id){
	var isIE = document.all ? true : false;
	if (isIE) {
		var xx= event.clientX + (document.documentElement.scrollLeft);
		var yy= event.clientY + (document.documentElement.scrollTop);
	}else{
		var x = e.pageX //+ document.body.scrollLeft;
		var y = e.pageY //+ document.body.scrollTop;
	}
	document.getElementById('cus_info').style.top=(yy+10)+'px'
	document.getElementById('cus_info').style.left=(xx-200)+'px'
	$('#cus_info').html('<img src="images/loader.gif" width="24" height="24" /><p />LOADING .... ');
	$('#cus_info').show();
	$.post('inc/ajax/loadCusInfo.php',{id:id}, function(data) {
		$('#cus_info').html(data);
	});
}
function editeRvic(e,id){
	p=getPosition(e);
	xx=p[0]
	yy=p[1]
	document.getElementById('cus_info').style.top=(yy+10)+'px'
	document.getElementById('cus_info').style.left=(xx-200)+'px'
	$('#cus_info').html('<img src="images/loader.gif" width="24" height="24" /><p />LOADING .... ');
	$('#cus_info').show();
	$.post('inc/ajax/loadCusInfo.php',{id:id}, function(data) {
		$('#cus_info').html(data);
	});
}
function loadCusINfo2(id,e){
	getCursorXY(document.getElementById('cus'+id).onclick)
}
function saveCusNote(id){
	var note=$('#cus_note').val();
	$('#cus_info').html('<img src="images/loader.gif" width="24" height="24" /><p />Save Data.... ');
	$.post('inc/ajax/saveCusNote.php',{id:id,note:note},function(data){
		$('#cus_info').hide();
	});	
}
function del_ite_sel(id,t,type){	
	var row = document.getElementById(t+id);	
	row.parentElement.removeChild(row); 
	ilement_sel('del',id,type);	
}
function ilement_sel(opr,id,type){
	selcs=$('#'+type).val();
	if(opr=='add'){		
		if(selcs==''){
			if(type!='itemes_sel2'){
				$('#'+type).val(id);
			}else{
				$('#'+type).val(id+"_"+count_inv_items);
			}
		}else{
			if(type!='itemes_sel2'){
				$('#'+type).val(selcs+','+id);
			}else{
				$('#'+type).val(selcs+','+id+"_"+count_inv_items)
			}
		}
		if(type=='itemes_sel'){$('#save_ord').show();}
		if(type=='itemes_sel2'){$('#save_inv').show();}
		if(type=='itemes_sel3'){$('#save_dag').show();}	
	}
	if(opr=='del'){
		var str='';
		ss=selcs.split(',')
		if(ss.length==1){
			if(type=='itemes_sel')$('#save_ord').hide();
			if(type=='itemes_sel2')$('#save_inv').hide();
			if(type=='itemes_sel3'){$('#save_dag').hide();}
		}
		first=0;
		d=0;
		for(i=0;i<ss.length;i++){					
			if(id!=ss[i]){
				if(d!=0 ){str+=',';}
				str+=ss[i];
				d++;				
			}			
		}
		$('#'+type).val(str)
	}
	if(type=='itemes_sel2'){count_invice();}
	if(type=='itemes_sel'){count_invice(); count_ord()}
}
function count_invice(){
	selcs=$('#itemes_sel2').val();
	ss=selcs.split(',')
	tot=0;
	for(i=0;i<ss.length;i++){					
		var p=parseFloat($('#ci'+ss[i]).val());
		var q=parseFloat($('#ci_price'+ss[i]).val());
		t2= p*q
		$('#total'+ss[i]).html(Price(t2));
		tot=tot+t2;		
	}
	$('#inv_total').html('Invoice Total : '+Price(tot));
	
	
}
function count_ord(){
	selcs=$('#itemes_sel').val();
	ss=selcs.split(',')
	tot=0;
	for(i=0;i<ss.length;i++){					
		var p=parseFloat($('#co'+ss[i]).val());
		var q=parseFloat($('#co_p'+ss[i]).val());
		t2= p*q
		$('#co_total'+ss[i]).html(Price(t2));
		tot=tot+t2;		
	}
	$('#ord_total').html('Container Total : '+Price(tot));
	
	
}
function saveOrder(){
	if(checkOrdVals()==0){
		par='';
		par+=$('#ord_name').val()+'|'
		par+=$('#ord_num').val()+'|'
		par+=$('#ord_ex').val()+'^'
		selcs=$('#itemes_sel').val();
		ss=selcs.split(',')
		for(i=0;i<ss.length;i++){
			par+=ss[i]+':'+$('#co'+ss[i]).val()+':'+$('#co_p'+ss[i]).val();
			if(i<ss.length-1){
				par+='|';
			}
		}
		$.post('inc/ajax/save_ord.php',{p:par,e:editOrdereOpe,id:editOrderID}, function(data) {
			//alert(data)
			loadItems();
			
			newOrder();
			editOrdereOpe=0;
			editOrderID=0;
		});		
	}
}
function saveInvice(){

	if(checkInvVals()==0){	
		var c_id=$('#cus_id').val();
		var pay=$('#pay').val();
		var payN=$('#pay_note').val();
		par=c_id+':'+pay+':'+payN+'^';		
		selcs=$('#itemes_sel2').val();
		ss=selcs.split(',')
		for(i=0;i<ss.length;i++){
			//alert(ss[i]+"|"+$('#order_'+ss[i]).val())
			par+=ss[i]+':'+$('#ci'+ss[i]).val()+':'+$('#ci_price'+ss[i]).val()+':'+$('#order_'+ss[i]).val();
			if(i<ss.length-1){
				par+='|';
			}

			myass=ss[i].split('_');
			//mycount = $("#i"+myass[0]+" div:last").text();
			//myname = $("#i"+myss[0]+" div:first").text();
			//alert($('#ci'+ss[i]).val());

			if($('#ci'+ss[i]).val() > $("#i"+myass[0]+" div:last").text()){	
				//$("#i"+myass[0]+"").attr("style","color:red");
				alert("warning: an item "+$("#i"+myass[0]+" div:first").text()+" not have the submitted quantity");
				return false;
			}
		}
		//alert(par)
		$.post('inc/ajax/save_inv.php',{p:par,o:editInviceid}, function(data){
			loadCus();
			loadItems();
			restInv(0);
			alert("added done!");
		});	
	}
}
function saveDamag(){
	if(checkDagVals()==0){
		par='';
		selcs=$('#itemes_sel3').val();
		ss=selcs.split(',')
		for(i=0;i<ss.length;i++){
			par+=ss[i]+':'+$('#da'+ss[i]).val();
			if(i<ss.length-1){
				par+='|';
			}
		}
		$.post('inc/ajax/save_dag.php',{p:par}, function(data){
			//alert(data)
			loadItems();
			restDag();
		});		
	}
}
function restOrder(){
	//newOrder()
	ord_il=new Array('ord_name','ord_num')
	for(f=0;f<ord_il.length;f++){
		$('#'+ord_il[f]).val('');
	}
	$('#ord_ex').val(0);
	var table = document.getElementById('t_order'); 
	var rowCount = table.rows.length;
	for(i=0;i<rowCount-1;i++){
		document.getElementById('t_order').deleteRow(1);		
	}
	$('#itemes_sel').val('');
	$('#ord_total').html('');
	$('#save_ord').hide()
	editOrdereOpe=0;
	editOrderID=0;
}
function restDag(){
	setDamage()
	var table = document.getElementById('t_damag'); 
	var rowCount = table.rows.length;
	for(i=0;i<rowCount;i++){
		document.getElementById('t_damag').deleteRow(0);		
	}
	$('#itemes_sel3').val('');
	$('#save_dag').hide()
}
function restInv(op){
	if(op==0){
		newInvice(0)
	}
	vic_il=new Array('inv_num')
	for(f=0;f<vic_il.length;f++){
		$('#'+vic_il[f]).val('');
	}
	var table = document.getElementById('t_invice'); 
	var rowCount = table.rows.length;
	for(i=0;i<rowCount;i++){
		document.getElementById('t_invice').deleteRow(0);		
	}
	$('#save_inv').hide()
	
	$('#selCus_inv').show();
	$('#cus_id').val('');
	$('#cus_name').html('');
	$('#sel_item_inv').hide();
	$('#inv_total').html('');
	$('#itemes_sel2').val('');
	$('#pay').val('');
	$('#pay_note').val('');
}
function checkOrdVals(){
	err=0;
	ord_il=new Array('ord_name','ord_num','ord_ex')
	for(f=0;f<ord_il.length;f++){
		val=$('#'+ord_il[f]).val();
		if(val==''){
			err=1;
			changeStyle(ord_il[f],0)
		}else{
			changeStyle(ord_il[f],1)
		}
	}
	val=$('#'+ord_il[2]).val();
	if(isNaN(val)){
		err=1;
		changeStyle(ord_il[2],0)
	}else{
		changeStyle(ord_il[2],1)
	}
	
	selcs=$('#itemes_sel').val();
	ss=selcs.split(',')
	for(i=0;i<ss.length;i++){
		var val=$('#co'+ss[i]).val();
		if(val=='' || isNaN(val)){
			err=1;
			changeStyle('co'+ss[i],0)
		}else{
			changeStyle('co'+ss[i],1)
		}
		var val=$('#co_p'+ss[i]).val();
		if(val=='' || isNaN(val)){
			err=1;
			changeStyle('co_p'+ss[i],0)
		}else{
			changeStyle('co_p'+ss[i],1)
		}
				
	}
	return err;
}
function checkInvVals(){
	err=0;
	selcs=$('#itemes_sel2').val();
	ss=selcs.split(',')
	for(i=0;i<ss.length;i++){
		var val=$('#ci'+ss[i]).val();
		if(val=='' || isNaN(val)){
			err=1;
			changeStyle('ci'+ss[i],0)
		}else{
			changeStyle('ci'+ss[i],1)
		}
		var val2=$('#ci_price'+ss[i]).val();
		if(val2=='' || isNaN(val2)){
			err=1;
			changeStyle('ci_price'+ss[i],0)
		}else{
			changeStyle('ci_price'+ss[i],1)
		}			
	}
	var val3=$('#pay').val();
	if(isNaN(val3)){
		err=1;
		changeStyle('pay',0)
	}else{
		changeStyle('pay',1)
	}
	return err;
}
function checkDagVals(){
	err=0;
	selcs=$('#itemes_sel3').val();
	ss=selcs.split(',')
	for(i=0;i<ss.length;i++){
		var val=$('#da'+ss[i]).val();
		if(val=='' || isNaN(val)){
			err=1;
			changeStyle('da'+ss[i],0)
		}else{
			changeStyle('da'+ss[i],1)
		}			
	}
	return err;
}
function delInvice(id){
	if(confirm('Do you want delete this invice')){
		$.post('inc/ajax/delInvoices.php',{id:id}, function(data) {
			orders_n=0;
			showInvices();
			loadItems();
			loadCus();
		});
	}
}
function delOrder(id){
		if(confirm('Do you want delete this Container')){
		$.post('inc/ajax/delOrder.php',{id:id}, function(data) {
			orders_n=0;
			showOrder();
		});
	}	
}
function viewInvice(id){
	$('.viewI').show()
	$('#vi').html(loaderDiv('Load invice'));
	$.post('inc/ajax/veiwInvoice.php',{id:id}, function(data) {
		$('#vi').html(data);

	});
}
function viewOrder(id){
	$('.viewI').show()
	$('#vi').html(loaderDiv('Load Container Please wait'));
	$.post('inc/ajax/veiwOrder.php',{id:id}, function(data) {
		$('#vi').html(data);
	});
}
function loaderDiv(str){
	return '<div  class="loader_in">'+str+'</div>';
}
function clsWin(t){
	if(t==1){
		$('.viewI').hide()
		$('#vi').html('');
	}
	if(t==2){
		$('#selQiteme').hide()
		$('#selQiteme').html('');
	}
}
/*******************************************************/
function editInvice(id){
	showInvices()
	$('#mLoader').show()
	$.post('inc/ajax/editInvoice.php',{id:id}, function(data){
		editInviceid=id;	
		$('#mLoader').hide()
		var data_p=data.split('|');
		var data_cus=data_p[0].split('^');		
		newInvice(0)
		addInviceOpe=id;
		add_cus(data_cus[0],data_cus[1]);		
		count_inv_items=0;	
		editLoadArrayy(data_p[1])
		
	});
}
function editLoadArrayy(dd){
	var data_its=dd.split('^');
	selItemsEditingval=dd
	itemsEditing=data_its.length;
	editLoadArray(0);
	
}
function editLoadArray(n){	
	if(itemsEditing>n){	
		data_its2=selItemsEditingval.split('^');
		data_its_v=data_its2[n].split(':');		
		add_iteme(data_its_v[0],data_its_v[1],data_its_v[2],data_its_v[3]);
		selItemsEditing=n+1;
	}else{
		itemsEditing=0;
		selItemsEditing=0;
		selItemsEditingval=''
	}
}
/*******************************************************/
function editOrder(id){
	editOrdereOpe=1;	
	$('#mLoader').show('slow');
	$('#ords_co').html('');
	$.post('inc/ajax/editOrder.php',{id:id}, function(data){
		$('#mLoader').hide('slow');
		showOrder();
		newOrder();
		edit_data=data.split('^');
		
		m_date=edit_data[0].split('|');
		editOrderID=m_date[0];
		$('#ord_name').val(m_date[1]);
		$('#ord_num').val(m_date[2]);
		$('#ord_ex').val(m_date[3]);
		
		for(i=1;i<edit_data.length;i++){
			
			m_date=edit_data[i].split('|');
			add_iteme(m_date[0],m_date[1],m_date[2],0);
		}		
	});
}
function saveIteme(o){
	var ok=0;
	var err=0
	for(i=0;i<selII.length;i++){
		var val=$('#ord'+selII[i]['i_order']).val();
		var Balance=selII[i]['i_qunt'];
		
		if(val !=''){
			if(isNaN(val) || val > Balance ){
				err=1;
				changeStyle('ord'+selII[i]['i_order'],0)
			}else{
				ok=1;
				changeStyle('ord'+selII[i]['i_order'],1)				
			}
		}else{
			changeStyle('ord'+selII[i]['i_order'],1)
		}
	}
	if(o=='v' || o=='e'){
		var sprice=$('#selPrice').val();
		if(isNaN(sprice) || sprice=='' ){
			err=1;
			changeStyle('selPrice',0)
		}else{
			changeStyle('selPrice',1)
		}
	}	
	if(err==0 && ok==1){
		if(o=='v'){ sendVinv(selII[0]['i_id'],sprice)}
		if(o=='e'){ sendVinve(selII[0]['i_id'],sprice)}
		if(o=='d'){ sendDmg(selII[0]['i_id'])}
	}	
}
function sendVinv(i_id,price){	
	$('#mLoader').show();	
	var prt=i_id+'|'+price;
	for(i=0;i<selII.length;i++){
		idd=selII[i]['i_order']
		var vv=$('#ord'+idd).val();
		if(vv !=''){
			prt+='^'+idd+'|'+vv;
		}			
	}
	clsWin(2);
	//$('#inv_items').html('');
	$.post('inc/ajax/addINvX.php',{p:prt}, function(data) {
		$('#mLoader').hide();
		//$('#inv_items').html(data);
		loadItems();
	});			
}
function sendVinve(i_id,price){	
	$('#mLoader').show();
	var prt=i_id+'|'+price;
	for(i=0;i<selII.length;i++){
		idd=selII[i]['i_order']
		var vv=$('#ord'+idd).val();
		if(vv !=''){
			prt+='^'+idd+'|'+vv;
		}			
	}
	clsWin(2);
	inv_id=$('#inv_id').val()
	$('#invs_co').html('');
	$.post('inc/ajax/addINv.php',{p:prt,v:inv_id}, function(data) {
		$('#mLoader').hide();
		editInvice(inv_id);
		loadItems();
	});			
}
function delRvic(id,inv){
	if(confirm('Do you want delete this Iteme')){
		$('#invs_co').html('');
		$('#mLoader').show();
		$.post('inc/ajax/delInvoices.php',{id:id,i:0}, function(data) {
			$('#mLoader').hide();
			editInvice(inv);
			loadItems();
		});
	}	
}
function sendDmg(i_id){	
	$('#mLoader').show();	
	var prt=i_id+'|0';
	for(i=0;i<selII.length;i++){
		idd=selII[i]['i_order']
		var vv=$('#ord'+idd).val();
		if(vv !=''){
			prt+='^'+idd+'|'+vv;
		}			
	}
	clsWin(2);
	//$('#inv_items').html('');
	$.post('inc/ajax/save_dag.php',{p:prt}, function(data) {
		$('#mLoader').hide();
		$('#dmg_items').html(data);
		loadItems();
	});			
}
function setNewInv(){
	$('#mLoader').show();	
	clsWin(2);
	//$('#inv_items').html('');
	$.post('inc/ajax/addINvX.php',{p:0}, function(data) {
		$('#mLoader').hide();
		//	$('#inv_items').html(data);
		loadItems();
	});	
	
}
function DelInvIt(t,id){
	$('#mLoader').show();
	$('#vi').html(loaderDiv('Load invice'));
	$.post('inc/ajax/delInvRec.php',{id:id,t:t}, function(data){
		$('#mLoader').hide();
		//setNewInv();
		loadItems();
	});	
}
function deliver(v,id,t){
	if(t=='v'){showInvices()}
	if(t=='o'){showOrder()}
	$('#mLoader').show();
	$.post('inc/ajax/deliver.php',{id:id,t:t,v:v}, function(data){
		$('#mLoader').hide();
		if(t=='v'){cus_invices=0;showInvices()}
		if(t=='o'){showOrder()}
	});

}
function Price1(n){
	n =intval($n*100)/100;
	nn=n.split('.');
	num=nn[0];
	len=strlen(num);
	out='$'+number_format($num);
	if(count($nn)>1){
		out+='.'.nn[1];
		if(strlen(nn[1])==1){
			out+='0';
		}
	}
	return out;
}
function Price(num) { 
    var p = num.toFixed(2).split("."); 
    return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) { 
        return  num + (i && !(i % 3) ? "," : "") + acc; 
    }, "") + "." + p[1]; 
} 


function fixItems(){
	if(invice_n==1){
		for (i =0;i<clickTracker.length;i++){
			var id_str = clickTracker[i];
			$("#"+id_str + " > " + ".itm_b2").addClass("itm_b2_clicked");
		$("#"+id_str + " > " + ".itm_b2_clicked").removeClass("itm_b2");
		
		}
	}
	else
	{
		for (i =0;i<clickTracker.length;i++){
		var id_str = clickTracker[i];
		$("#"+id_str + " > " + ".itm_b2_clicked").addClass("itm_b2");
		$("#"+id_str + " > " + ".itm_b2").removeClass("itm_b2_clicked");
		
		}
		clickTracker = [];
	}
}

function clickTracker_track(data_s){
	clickTracker.push(data_s);
	var id_str = data_s;
	$("#"+id_str + " > " + ".itm_b2").addClass("itm_b2_clicked");
	$("#"+id_str + " > " + ".itm_b2_clicked").removeClass("itm_b2");
}
function clickTracker_untrack(data_s){
	clickTracker.splice(clickTracker.indexOf(data_s),1);
}

function clickTracker_isTracked(data_s){
	
	return clickTracker.indexOf(data_s) >= 0;
}


function resetCusShit(id){
	if (!confirm("Reset invoices for customer?")) 
		return;
		
	$.post("inc/ajax/resetCus.php",{ id: id}, function(data){
		if (data == "-1")
		alert("Error, couldn't reset");
		else
		$("#cus_info").hide();
	});
}
