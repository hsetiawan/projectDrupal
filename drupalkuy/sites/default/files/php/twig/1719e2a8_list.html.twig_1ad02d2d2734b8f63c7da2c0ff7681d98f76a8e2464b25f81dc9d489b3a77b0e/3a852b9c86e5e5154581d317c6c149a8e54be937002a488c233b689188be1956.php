<?php

/* core/modules/rest_api/templates/list.html.twig */
class __TwigTemplate_87009913557ae3f8ee629221e6f15f1baf42a5182d68d61afe71890810989966 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array();
        $filters = array();
        $functions = array("url" => 21);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array(),
                array('url')
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "<h1 class=\"headerStyle\">REST API List</h1>
 <section class=\"flat\">
    <button onclick=\"doAdd()\">ADD New File</button>
</section>
<table>
  <thead class=\"thead-style\">
    <tr>
      <td style='width:10px'>No</td>
      <td>Thumbnile</td>
      <td>File Name</td>
      <td>Description</td>
      <td style=\"width:150px;text-align:center\">Operations</td>
    </tr>

  </thead>
  <tbody id=\"list-data\"></tbody>
</table>

<script>

var url = \"";
        // line 21
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->getUrl("rest_api")));
        echo "\";
var contentType = \"application/hal+json\";
var urlFiles = \"";
        // line 23
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true));
        echo "\";
  (function () {
    'use strict';

 function doList(){

  var result = \"\";
  jQuery.ajax({
      type: \"GET\",
      url: url+\"/list?_format=hal_json\",
      cache: false,
      beforeSend: function(data) {
        //Loading Modal

      },
       headers:{
          \"Content-Type\":contentType,
        },
      success: function(data){
        var obj =  data;
         if(obj.data !== undefined){
             for(var i=0;i<obj.data.length;i++){
              var no = i+1;
              var id = obj.data[i].flid;
              var filename =  obj.data[i].filename;
              var description =  obj.data[i].description;
              var media =   obj.data[i].uri;
              var resultMedia = \"\";
                if(media != \"\"){
                   media = media.split(\"//\");
                  resultMedia = \"<img  src='\"+urlFiles+media[1]+\"' style='width:50px !important;border: 1px solid #ddd; border-radius: 4px; padding: 5px;' class='img-thumbnail' alt=''  onclick='window.open(this.src)'>\";
                }
              var editAct = \"<button type='button' class='edit'  onclick='doEdit(\"+id+\");'>EDIT</button>\";
              var deleteAct = \"<button type='button' class='delete'  onclick='doDelete(\"+id+\");'>DELETE</button>\";
              result = result + \"<tr><td ><input type='hidden' id='no\"+id+\"' value=\"+no+\">\"+no+\"</td><td>\"+resultMedia+\"</td><td>\"+filename+\"</td><td>\"+description+\"</td><td style='width:150px;text-align:center'><section class='operation'> \"+editAct+\" \"+deleteAct+\" </section>  </td></tr>\";
            }
         }else{
            result = result +\"<tr><td colspan='5' style='color:grey;'><center><em>Rows is empty..</em></center></td></tr>\";
         }

        jQuery(\"#list-data\").html(result);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
          //Error Modal
        alert(textStatus + \" \" + errorThrown);
      }
    });

     }

 doList();
 })();


  function doDelete(id){
      var no = jQuery(\"#no\"+id).val();
  \t\tvar msg = confirm(\"Are you sure delete item no \"+no+\" ?\");
  \t\tif(msg == true){
  \t\t\tif(id != null){

  \t\t\tjQuery.ajax({
  \t\t\t\theaders:{
  \t\t\t\t\t\"Content-Type\":contentType,
   \t\t\t\t},
  \t\t\t\tmethod: \"DELETE\",
  \t\t\t\turl: url+\"/\"+id+\"/delete?_format=hal_json\",
  \t\t\t\tcache: false,
  \t\t\t\tbeforeSend: function(xhr) {

  \t\t\t\t},
  \t\t\t\tsuccess: function(data){
            alert(\"Data has been deleted\");
  \t\t\t\t\twindow.location.reload();
  \t\t\t\t},
  \t\t\t\terror: function (XMLHttpRequest, textStatus, errorThrown) {
  \t \t\t\t\t//Error Modal
            var err = JSON.parse(XMLHttpRequest.responseText);

            alert(textStatus + \": \\n \" + err.message);
  \t\t\t\t}
  \t\t\t});
  \t\t}
  \t\t}

  }


  function doAdd(){
  \twindow.location.href= url+\"/addForm\";
  }

  function doEdit(id){
  \twindow.location.href= url+\"/editForm/\"+id;
  }



</script>
";
    }

    public function getTemplateName()
    {
        return "core/modules/rest_api/templates/list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 23,  65 => 21,  43 => 1,);
    }
}
/* <h1 class="headerStyle">REST API List</h1>*/
/*  <section class="flat">*/
/*     <button onclick="doAdd()">ADD New File</button>*/
/* </section>*/
/* <table>*/
/*   <thead class="thead-style">*/
/*     <tr>*/
/*       <td style='width:10px'>No</td>*/
/*       <td>Thumbnile</td>*/
/*       <td>File Name</td>*/
/*       <td>Description</td>*/
/*       <td style="width:150px;text-align:center">Operations</td>*/
/*     </tr>*/
/* */
/*   </thead>*/
/*   <tbody id="list-data"></tbody>*/
/* </table>*/
/* */
/* <script>*/
/* */
/* var url = "{{ url('rest_api') }}";*/
/* var contentType = "application/hal+json";*/
/* var urlFiles = "{{ name }}";*/
/*   (function () {*/
/*     'use strict';*/
/* */
/*  function doList(){*/
/* */
/*   var result = "";*/
/*   jQuery.ajax({*/
/*       type: "GET",*/
/*       url: url+"/list?_format=hal_json",*/
/*       cache: false,*/
/*       beforeSend: function(data) {*/
/*         //Loading Modal*/
/* */
/*       },*/
/*        headers:{*/
/*           "Content-Type":contentType,*/
/*         },*/
/*       success: function(data){*/
/*         var obj =  data;*/
/*          if(obj.data !== undefined){*/
/*              for(var i=0;i<obj.data.length;i++){*/
/*               var no = i+1;*/
/*               var id = obj.data[i].flid;*/
/*               var filename =  obj.data[i].filename;*/
/*               var description =  obj.data[i].description;*/
/*               var media =   obj.data[i].uri;*/
/*               var resultMedia = "";*/
/*                 if(media != ""){*/
/*                    media = media.split("//");*/
/*                   resultMedia = "<img  src='"+urlFiles+media[1]+"' style='width:50px !important;border: 1px solid #ddd; border-radius: 4px; padding: 5px;' class='img-thumbnail' alt=''  onclick='window.open(this.src)'>";*/
/*                 }*/
/*               var editAct = "<button type='button' class='edit'  onclick='doEdit("+id+");'>EDIT</button>";*/
/*               var deleteAct = "<button type='button' class='delete'  onclick='doDelete("+id+");'>DELETE</button>";*/
/*               result = result + "<tr><td ><input type='hidden' id='no"+id+"' value="+no+">"+no+"</td><td>"+resultMedia+"</td><td>"+filename+"</td><td>"+description+"</td><td style='width:150px;text-align:center'><section class='operation'> "+editAct+" "+deleteAct+" </section>  </td></tr>";*/
/*             }*/
/*          }else{*/
/*             result = result +"<tr><td colspan='5' style='color:grey;'><center><em>Rows is empty..</em></center></td></tr>";*/
/*          }*/
/* */
/*         jQuery("#list-data").html(result);*/
/*       },*/
/*       error: function (XMLHttpRequest, textStatus, errorThrown) {*/
/*           //Error Modal*/
/*         alert(textStatus + " " + errorThrown);*/
/*       }*/
/*     });*/
/* */
/*      }*/
/* */
/*  doList();*/
/*  })();*/
/* */
/* */
/*   function doDelete(id){*/
/*       var no = jQuery("#no"+id).val();*/
/*   		var msg = confirm("Are you sure delete item no "+no+" ?");*/
/*   		if(msg == true){*/
/*   			if(id != null){*/
/* */
/*   			jQuery.ajax({*/
/*   				headers:{*/
/*   					"Content-Type":contentType,*/
/*    				},*/
/*   				method: "DELETE",*/
/*   				url: url+"/"+id+"/delete?_format=hal_json",*/
/*   				cache: false,*/
/*   				beforeSend: function(xhr) {*/
/* */
/*   				},*/
/*   				success: function(data){*/
/*             alert("Data has been deleted");*/
/*   					window.location.reload();*/
/*   				},*/
/*   				error: function (XMLHttpRequest, textStatus, errorThrown) {*/
/*   	 				//Error Modal*/
/*             var err = JSON.parse(XMLHttpRequest.responseText);*/
/* */
/*             alert(textStatus + ": \n " + err.message);*/
/*   				}*/
/*   			});*/
/*   		}*/
/*   		}*/
/* */
/*   }*/
/* */
/* */
/*   function doAdd(){*/
/*   	window.location.href= url+"/addForm";*/
/*   }*/
/* */
/*   function doEdit(id){*/
/*   	window.location.href= url+"/editForm/"+id;*/
/*   }*/
/* */
/* */
/* */
/* </script>*/
/* */
