function submitenter(e){
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13){
	   AddUserToList();
	   return false;
	}else{
	   return true;
	}
}

function ShowHideRows(id, disp, x, y){
	for(i=x;i<=y;i++){
		document.getElementById(id+i).style.display = disp;
	}
}

function ChangeMail(){
	if(document.getElementById('enablemail').checked){
		ShowHideRows("warsmail", "block", 1, 3);
	}else{
		ShowHideRows("warsmail", "none", 1, 3);		
	}
}

function ChangeLineUp(){
	if(document.getElementById('enablelineup').checked){
		ShowHideRows("lineup", "block", 1, 2);
	}else{
		ShowHideRows("lineup", "none", 1, 2);		
	}
}

function ChangeScreens(){
	if(document.getElementById('resizescreens').checked){
		ShowHideRows("resizewidth", "block", 1, 1);
	}else{
		ShowHideRows("resizewidth", "none", 1, 1);		
	}
}

function ChangeComments(){
	if(document.getElementById('enablecomments').checked){
		ShowHideRows("comments", "block", 1, 1);
	}else{
		ShowHideRows("comments", "none", 1, 1);		
	}
}

function CheckFormat(id){
	var obj1 = document.getElementById('format1');
	var obj2 = document.getElementById('format2');
	var obj3 = document.getElementById('format3');
	var selval1 = obj1.options[obj1.selectedIndex].text;
	var selval2 = obj2.options[obj2.selectedIndex].text;
	var selval3 = obj3.options[obj3.selectedIndex].text;
	
	var listops = new Array("dd","mm","yyyy");
	
	if(id == 1){
		obj2.length = 0;
		obj3.length = 0;
		var j=0;
		for(i=0;i<=2;i++){
			if(listops[i] != selval1){
				obj2.options[obj2.length] = new Option(listops[i],listops[i]);
				if(selval2 == listops[i]){
					obj2.selectedIndex = j;
				}
				j++;
			}
		}
		
	
	selval2 = obj2.options[obj2.selectedIndex].text;
	
		for(i=0;i<=2;i++){
			if(listops[i] != selval1 && listops[i] != selval2){
				obj3.options[obj3.length] = new Option(listops[i],listops[i]);
			}
		}
	}else{
		obj3.length = 0;
		for(i=0;i<=2;i++){
			if(listops[i] != selval1 && listops[i] != selval2){
				obj3.options[obj3.length] = new Option(listops[i],listops[i]);
			}
		}
	}
}

function ChangeTable(type){
	if(type == "users"){
		document.getElementById('tablename').value = 'user';
		document.getElementById('fieldname').value = 'user_name';
	}else if(type == "members"){
		document.getElementById('tablename').value = 'clan_members_info';
		document.getElementById('fieldname').value = 'userid';
	}
}

function XMLHTTPObject() {
    var xmlhttp=false;
    //If XMLHTTPReques is available
    if (XMLHttpRequest) {
        try {xmlhttp = new XMLHttpRequest();}
        catch(e) {xmlhttp = false;}
    } else if(typeof ActiveXObject != 'undefined') {
	//Use IE's ActiveX items to load the file.
        try {xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");} 
        catch(e) {
            try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
            catch(E) {xmlhttp = false;}
        }
    } else  {
        xmlhttp = false; //Browser don't support Ajax
    }
    return xmlhttp;
}
var http = new XMLHTTPObject();

function DelAllComments() {
	var sure = confirm(suredelallcomms);
	
	if(sure){
		http.open("GET","admin_old.php?DelAllComments&code="+Math.floor(Math.random()*99999),true);
		
		http.onreadystatechange = function() {
			if(http.readyState == 4) {
				if(http.status == 200) {
                	var result = parseInt(http.responseText.replace(/(<([^>]+)>)/ig,"").replace(/ /ig,""));
					if(result == 1) {
						confirm(allcommsdel);
					}else{
						alert(errordelcomms);
					}
				}
			}
		}
		http.send(null);  
	}
	document.getElementById('delallcomms').checked = true;
}
 
 