
var url = "http://localhost/drupalkuy/";
var urlProject = "http://localhost/testrest/";
var host = "http://localhost";
var auth =  "Basic dGVzdDp0ZXN0MTIz";
var contentType = "application/hal+json";
var CSRF = getToken(); //"kaFhwdi4KW1FHID1eNdyEnslwpDjtOHjhg_WryAvsmE";

function getParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.split('?')[1]),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function getToken(){
	var token = "";
		jQuery.ajax({
			type: "GET",
			url: url+"rest/session/token",
			cache: false,
			beforeSend: function(data) {
				//Loading Modal
				 
			},
			success: function(data){
			 	token =  data;
				return token; 	
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
 				//Error Modal
				alert(textStatus + " " + errorThrown);
			}
		});
	

}

function doBack(){
	window.location.href= urlProject+"index.html";
}

function doAdd(){
	window.location.href= urlProject+"add.html";
}

function doAddProccess(){
	var file = $("#media").val();
	var description = $("#description").val();
	var message = "";
	
	if(file == ""){
		//message = message + "file media is empty";
	}
	
	if(message == ""){
	var package = {
            'title': { 'value': " " },
            'field_description': { 'value': description },
            '_links': { 'type': { 'href': url+'rest/type/node/gallery' }}
        }	
	jQuery.ajax({		data:  JSON.stringify(package),
				headers:{
					"Authorization":auth,
					"Content-Type":contentType,
					"X-CSRF-Token":CSRF
				},
				method: "POST",
				url: url+"entity/node?_format=hal_json",
				
				cache: false,				
				beforeSend: function(xhr) {
					//xhr.setRequestHeader("X-CSRF-Token",getToken());
					//Loading Modal
					 
				},
				success: function(data){
					alert("Succes Add Content");
					doBack();
				 	//window.location.reload();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
	 				//Error Modal
					alert(textStatus + " " + errorThrown);
				}
			});
	
	}else{
		alert(message);
	}

}

function doEdit(id){
	window.location.href= urlProject+"edit.html?nid="+id;
}

function stripHTML(text){
   var regex = /(<([^>]+)>)/ig;
   return text.replace(regex, "");
}

function doEditGetData(id){
	 if(id != ""){
			jQuery.ajax({
			type: "GET",
			url: url+"api/v1/gallery/"+id,
			cache: false,
			beforeSend: function(data) {
				//Loading Modal
				 
			},
			success: function(data){
			 	var obj =  data;
				
				for(var i=0;i<obj.length;i++){
					var no = i+1;
					var id = obj[i].nid;
					var description = obj[i].field_description;
					var media =  obj[i].field_media; 

					$("#description").html(stripHTML(description)).text();
				}
 
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
 				//Error Modal
				alert(textStatus + " " + errorThrown);
			}
		});
	     }
	 
}

function doEditProccess(){
	var file = $("#media").val();
	var description = $("#description").val();
	var id = $("#id-content").val();
	var message = "";
	
	if(file == ""){
		//message = message + "file media is empty";
	}
	
	if(message == ""){
	var package = {
            'title': { 'value': " " },
            'field_description': { 'value': description },
            '_links': { 'type': { 'href': url+'rest/type/node/gallery' }}
        }	
	jQuery.ajax({		data:  JSON.stringify(package),
				headers:{
					"Authorization":auth,
					"Content-Type":contentType,
					"X-CSRF-Token":CSRF
				},
				method: "PATCH",
				url: url+"node/"+id+"?_format=hal_json",
				
				cache: false,				
				beforeSend: function(xhr) {
					//xhr.setRequestHeader("X-CSRF-Token",getToken());
					//Loading Modal
					 
				},
				success: function(data){
					alert("Succes Edit Content");
					doBack();
				 	//window.location.reload();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
	 				//Error Modal
					alert(textStatus + " " + errorThrown);
				}
			});
	
	}else{
		alert(message);
	}

}

function doList(){
	
	var result = "";
	jQuery.ajax({
			type: "GET",
			url: url+"api/v1/gallery",
			cache: false,
			beforeSend: function(data) {
				//Loading Modal
				 
			},
			success: function(data){
			 	var obj =  data;
				
				for(var i=0;i<obj.length;i++){
					var no = i+1;
					var id = obj[i].nid;
					var description = obj[i].field_description;
					var media =  obj[i].field_media;
					var resultMedia = "";
						if(media != ""){
						 resultMedia = "<img  src='"+host+media+"' style='width:40px !important' class='img-thumbnail' alt=''>";						
						}
					var editAct = "<button type='button' class='btn btn-xs btn-success'  onclick='doEdit("+id+");'>EDIT</button>";
					var deleteAct = "<button type='button' class='btn btn-xs btn-danger'  onclick='doDelete("+id+");'>DELETE</button>";
					result = result + "<tr><td>"+no+"</td><td>"+resultMedia+"</td><td>"+description+"</td><td>"+editAct+" | "+deleteAct+"</td></tr>"; 
				}
				$("#list-data").html(result);		
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
 				//Error Modal
				alert(textStatus + " " + errorThrown);
			}
		});

	
}


function doDelete(id){
		var msg = confirm("Are you sure delete this item?");
		if(msg == true){
			if(id != null){

			jQuery.ajax({
				headers:{
					"Authorization":auth,
					"Content-Type":contentType,
					"X-CSRF-Token":CSRF
				},
				method: "DELETE",
				url: url+"node/"+id+"?_format=hal_json",
				cache: false,				
				beforeSend: function(xhr) {
					//xhr.setRequestHeader("X-CSRF-Token",getToken());
					//Loading Modal
					 
				},
				success: function(data){
				 	window.location.reload();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
	 				//Error Modal
					alert(textStatus + " " + errorThrown);
				}
			});
		}
		}
		
}
