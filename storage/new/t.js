/****************FORM******************/
var P1elments=new Array('p1_name','p1_last','p1_gf','p1_father','p1_nationality','p1_place','p1_bD','p1_bM','p1_bY','p1_app_date','p1_pn','p1_Rplace','p1_Rdate','p1_comDate','p1_address','p1_religion','p1_email','p1_street','p1_state','p_city','p_telephone','p1_mobile','p1_postbox','p1_status');
var P1elments_t=new Array('R','R','R','R','-','R','D:p1_bM','M','Y','date','-','R','date','date','R','R','R|email','R','R','R','R|N:>:7','N:>:7','R','-');
var months=new Array('',31,29,31,30,31,30,31,31,30,31,30,31);

function checkFormElement(val,type){
	var r=0;
	var vv=$('#'+val).val();
	types=type.split('|');
	
	for (t=0;t<types.length;t++){
		//alert(t+'|'+r)
		if(t==0 || r==1){
			ty=types[t].split(':');
			if(ty[0]=='-' ){r=1;}			
			if(ty[0]=='R' ){if(vv !=''){r=1;}else r=0;}
			if(ty[0]=='D' ){Month=$('#'+ty[1]).val();if(Month>0<=12){if(vv >0  && vv<= months[Month]){r=1;}else r=0;}}		
			if(ty[0]=='M' ){if(vv >0 && vv<= 12){r=1;}else r=0;}
			if(ty[0]=='Y' ){if(vv >1900 && vv<= 2100){r=1;}else r=0;}
			if(ty[0]=='date'){if(vv !=''){r=1;}else r=0;}
			if(ty[0]=='email' ){if((checkEmail(vv)=='1')  || vv ==''){r=1;}else r=0;}
			if(ty[0]=='N' ){if(vv!=''){if(!isNaN(vv)){
					if(ty[1]== '-' ){r=1;}else{
						var nLenght=vv.length;
						if(ty[1]== '>'  && nLenght > ty[2] ){r=1;
						}else if(ty[1]== '<'  && nLenght < ty[2] ){r=1;
						}else if(ty[1]== '='  && nLenght == ty[2] ){r=1;}else r=0;}
				}else r=0;}else r=1;
			}
		}
	}
	return r;
}

function cheForm(arrr,arrr2,p){
	var err=0;
	for(i=0;i<arrr.length;i++){if(checkFormElement(arrr[i],arrr2[i])==1){changeBG2(arrr[i],1);
		}else{changeBG2(arrr[i],0);err=1;}
	}if(err==0){sendP1(p,arrr);}	
}

function sendP1(page,arrr){	
	$('#next').hide();
	$('#f_msg').hide();
	$('#f_load').show();
	var p=$('#'+arrr[0]).val();
	for(i=1;i<arrr.length;i++){
		p+='|'+$('#'+arrr[i]).val();
	}	
	$.post('../../ajax/'+page+'.php',{p:p},function (data){
		$('#info').html(data);
		var res= data.split('^');
		if(res.length>1){
			$('#f_load').hide();
			if(res[0]=='1'){				
				changForm(1,2);
				clearForm(P1elments);
				$('#uu').val(res[1]);
			}else{
				$('#f_sub').show();
				$('#f_msg').show();			
			}
		}
	})
}
function changForm(f,t){
	document.getElementById('p'+f).className='pr_t1';
	document.getElementById('pt'+(f)).className='pr_part';
	document.getElementById('p'+(f+1)).className='pr_t1'; 
	
	document.getElementById('p'+t).className='pr_t2';
	
	if(t!=4){			
		document.getElementById('p'+(t+1)).className='pr_t3';
		document.getElementById('pt'+(t)).className='pr_part2';
	}else{
		document.getElementById('pt'+(t)).className='finash';
	}
	
	$("#f"+f).hide();
	$("#f"+t).show();
}

function saveLangs(list,status){
	$('#next2').hide();
	$('#f2_load').show();
	var u=$('#uu').val();
	var vals=u;
	for(ll=1;ll<list+1;ll++){
		vals+='^';
		vals+=''+ll+'|';
		for(l=1;l<status+1;l++){		
			idd='list'+l+'s'+ll;
			val=$('#'+idd).val();			
			vals+=val; 
			if(l<status){
				vals+='|';
			}
		}
	}
	$.post('../../ajax/langs.php',{p:vals},function (data){
		$('#f2_load').hide();
		$('#p2_next').show();
		//$('#info').html(data);
		var res= data.split('^');
		if(res.length>1){
			if(res[0]=='1'){
				$('#f2_lang').hide();
				$('#f2_msg').html(res[1]);				
				$('#f2_msg').show();					
			}else{
				$('#next2').show();
				$('#f2_msg').show();			
			}
		}
	})
	//$('#info').html(vals)
}
var basy=0
function saveAdd(arr,tabl,loader,page){
	if(basy==0){
		if(chackData(arr)==0){
			$('#'+loader).show();	
			n=arr.length;
			basy=1;
			var u=$('#uu').val();
			p=u;
			for(i=0;i<n;i++){				
				nv=arr[i].split(',');
				newVal=$('#'+nv[0]).val();
				p+='|'+newVal		
			}			
			$.post('../../ajax/'+page+'.php',{p:p},function (data){							
				$('#info').html(data);
				var table = document.getElementById(tabl); 
				var rowCount = table.rows.length;
				var row = table.insertRow(rowCount-1);
				for(i=0;i<n;i++){
						var cell = row.insertCell(i);
						if(i<n-1){cell.setAttribute('class','lang_td1')}else{cell.setAttribute('class','lang_td2')}
						nv2=arr[i].split(',');
						newVal=$('#'+nv2[0]).val()			
						cell.innerHTML =newVal;						
				}
				clearData(arr)
				$('#'+loader).hide();
				basy=0;
			})
		}
	}
}
function chackData(arr){
	err=0
	n=arr.length;
	for(i=0;i<n;i++){
		el=arr[i]				
		nv=el.split(',');
		newVal=nv[0];
		che=nv[3];
		if(checkFormElement(newVal,che)==1){
			changeBG(nv[0],1);
		}else{
			changeBG2(nv[0],0);
			err=1;		
		}	
	}			
	return err;
}
function clearData(arr){
	n=arr.length;	
	for(i=0;i<n;i++){				
		nv=arr[i].split('|');
		$('#'+nv[0]).val('');	
	}
}
function moveToP(n){
	nn=n-1;
	$('#f'+nn).hide();
	changForm(nn,n);
	$('#info').html('dsads');
	$.post('../../ajax/p.php',{p:n},function (data){
		$('#f'+n).show();	
	})	
}
function showAnswer(q){
	if(document.getElementById('ans'+q).style.display!='block'){
		$('#ans'+q).show();
		$('#text'+q).html('Cancel Answer');
		Q_use[q]=1;	
	}else{
		$('#ans'+q).hide();
		Q_use[q]=0;	
		$('#text'+q).html('Add Answer');	
	}
}
function save_Qu(){
	var err=0;
	var u=$('#uu').val();
	var p=u;
	for(i=0;i<Q_use.length;i++){
		if(Q_use[i]==1){
			typee=Qu_t[i].split('-');
			if(typee[0]==1){
				if(checkFormElement('ans_t'+i,'R')==1){
					changeBG('ans_t'+i,1);					
				}else{
					changeBG('ans_t'+i,0);
					err=1;
				}
			}
			ans_o=0;
			if(typee[1]==1){
				if(document.getElementById('ans_o1'+i).checked){ans_o=1;}else{ ans_o=2;}
			}
			ans_t=$('#ans_t'+i).val()
			q=Qu[i].split('^');
			q_id=q[0];
			
			p+='|'+q_id+':'+ans_o+':'+ans_t;
		}
	}
	if(err==0){
		$('#p31_next').hide();
		$('#f8_load').show();
		$.post('../../ajax/qu.php',{p:p},function (data){
			$('#f8_load').hide();
			$('#f31').hide();
			$('#f32').show();
			//$('#info').html(data);			
		})	
	}
}
function showCV(l){
	var u=$('#uu').val();
	document.location=l+'/CV'+u

}





/******************************************************************/
/******************************************************************/

var table = document.getElementById(tabl); 
var rowCount = table.rows.length;
var row = table.insertRow(rowCount-1);
for(i=0;i<n;i++){
	var cell = row.insertCell(i);
	if(i<n-1){cell.setAttribute('class','lang_td1')}else{cell.setAttribute('class','lang_td2')}
	nv2=arr[i].split(',');
	newVal=$('#'+nv2[0]).val()			
	cell.innerHTML =newVal;						
}
clearData(arr)
$('#'+loader).hide();
basy=0;

/******************************************************************/
/******************************************************************/