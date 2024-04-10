
$(document).ready(function() {
	$('#add').dialog({
		modal: true, 
		autoOpen: false,
		width:500,
		minHeight:300,
		buttons:{"<?=_save?>":function(){
			document.addForm.submit();
		}},
		closeOnEscape:true		
	})
	//-----------------------------------------
	$('#edit').dialog({
		modal: true,
		autoOpen: false,
		width:500,
		minHeight:300,
		buttons:{"<?=_save?>":function(){
			document.editForm.submit();
		}},
		closeOnEscape:true		
	})
	//-----------------------------------------
	$('#dele').dialog({ 
		modal: true,
		autoOpen: false,
		minHeight:150,
		buttons:
		{"<?=_yes?>":function(){
			document.delForm.submit();
		},"<?=_no?>":function(){
			$(this).dialog('close');
		}}		
	})
	//-----------------------------------------
	$('#deleFile').dialog({ 
		modal: true,
		autoOpen: false,
		minHeight:150,
		buttons:
		{"<?=_yes?>":function(){
			document.delFileForm.submit();
		},"<?=_no?>":function(){
			$(this).dialog('close');
		}}		
	})
	//-----------------------------------------
	$('#deleSel').dialog({ 
		modal: true,
		autoOpen: false,
		minHeight:150,
		buttons:
		{"<?=_yes?>":function(){
			document.deleSelForm.submit();
		},"<?=_no?>":function(){
			$(this).dialog('close');
		}}		
	})
	//-----------------------------------------
	$('#view_win').dialog({ 
		modal: true,
		autoOpen: false,
		minHeight:200,
		width:700,
		height:600
			
	})
	//-----------------------------------------
	$(function() {
		$(".Date").datepicker();
	});
	//-----------------------------------------	
});
function delete_rec(id){	
	$('#del_id').val(id)
	$(dele).dialog('open');
}
function delete_file(id,name,file){
	$('#deleFile_id').val(id)
	$('#deleFile_name').val(name)
	$('#deleFile_file').val(file)
	$(deleFile).dialog('open');
}
function edit_rec(id){
	document.getElementById('edit_id').value=id;
	for(i=0;i<count_c;i++){
		var val=data[id][list_arr[i]];
		var type=list_type[i];
		var name=list_arr[i];
		//alert(i+"|"+name+"|"+type+"|"+val);
		load_val(val,type,name);
	}
	$(edit).dialog('open');
	
}
function load_val(val,type,name){
	if(type=="text" ){
		document.getElementById('e_'+name).value=val;
	}
	if(type=="textarea"){
		var val2=val.replace(/&_&&_&/g,'\n');
		//val=val.replace('($)','\r');
		//val=val.replace('($)','\n');
		//val=val.replace('($)','\r');
		document.getElementById('e_'+name).value=val2;
	}
	if(type=="photo" || type=="file"){
		document.getElementById('x_'+name).value=val;
	}
	if(type=="parent"){
		document.getElementById('e_'+name).value=val;
	}
	if(type=="date"){
		document.getElementById('e_'+name).value=val;
	}
	if(type=="act"){
		if(val==1){
			document.getElementById('e_'+name).checked=true;
		}else{
			document.getElementById('e_'+name).checked=false;
		}
	}
	if(type=="list"){
		document.getElementById('e_'+name).value=val;
	}
	if(type=="pass"){
		document.getElementById('x_'+name).value=val;
		document.getElementById('e_'+name).value='';
	}
}
function chekAll(rows){
	var ch=false;
	if(document.getElementById('check_all').checked==true){
		ch=true;
	}
	for(i=0;i<rows;i++){
		document.getElementById('rec'+i).checked=ch;
	}
}
function check_empty(rows){
	var check=0;
	var not_chek=0;
	for(i=0;i<rows;i++){
		if(document.getElementById('rec'+i).checked==true){
			check++;
		}else{
			not_chek++;
		}
	}
	if(check==0){
		document.getElementById('check_all').checked=false;
	}
	if(not_chek==0){
		document.getElementById('check_all').checked=true;
	}
}
function delete_sel(rows){
	var ch=0;
	for(i=0;i<rows;i++){
		if(document.getElementById('rec'+i).checked==true){
			ch=1;
			i=rows;
		}
	}
	if(ch==1){
		$(deleSel).dialog('open');
	}else{
		alert('<?=_sel1rec?>');
	}	
}
function selPage(n){
	document.location=window.self.location="?p="+n;	
}

// add ads---------------------------------------------------------
var subCat=0;
var addition=0;
function loadAreas(id){
	var cat=$('#category').val();
	changCat(cat);
}
function changCat(id){
	loader(1);
	var city_id=$('#city').val();
	$.post("inc/ajax/changCat.php", {id:id,city_id:city_id,subCat:subCat}, function(data) { 
		//alert("Data Loaded: " + data); 
		if(data!=0){
			var dataArray=data.split('^');
			subCat=dataArray[0];
			addition=dataArray[1];
			if(subCat==1){
				$('#subcat').html(dataArray[2]);
				$('#subCatTR').show();
			}else{
				$('#subcat').html('');
				$('#subCatTR').hide();
			}
			loader(0);
			if(addition!=0){				
				loadAddition();
			}else{
				
				$('#cat3').html('');
			}			
		}
		
   });
}
function loadAddition(){
	loader(1);
	var city_id=$('#city').val();
	$.post("inc/ajax/loadAddition.php", {type:addition,city_id:city_id,sub3:sub3}, function(data) { 
		//alert("Data Loaded: " + data); 
		if(data!=0){
			$('#cat3').html(data);
		}
		loader(0);
	})
	
}
function loader(sw){
	//alert(sw)
	if(sw==1){
		$('#loading').dialog('open');
	}else{
		$('#loading').dialog('close');
	}
}
function view_ad(id){
	loader(1)
	$.post("inc/ajax/viewAD.php", {id:id}, function(data) { 
		//alert("Data Loaded: " + data); 
		if(data!=0){
			$('#viewAD').html(data);
			$('#viewAD').dialog('open');
		}
		loader(0);
	})

}
function view_rec(id,linky){
	$.post(linky, {id:id}, function(data) {
		$('#view_win').html(data);
		$('#view_win').dialog('open');		
	})
}
