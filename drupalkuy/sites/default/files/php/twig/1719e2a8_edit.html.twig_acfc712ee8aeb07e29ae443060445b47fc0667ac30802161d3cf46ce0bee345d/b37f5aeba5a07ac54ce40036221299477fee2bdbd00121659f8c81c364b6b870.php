<?php

/* core/modules/rest_api/templates/edit.html.twig */
class __TwigTemplate_ce7be17f7a5b774ee9296779d11aa329c141e05faf28d92ae6ba5a051dfa4a67 extends Twig_Template
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
        $functions = array("url" => 35);

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
        echo "<h1 class=\"headerStyle\">REST API Edit</h1>
<form id=\"form-edit\" name=\"form-edit\">
   <table >
    <tr>
      <td width=\"20px\" style=\"vertical-align:top\"><b class=\"boldTitle\">Media <font color='red'>*</font></b></td>
       <td>
        file : <a href=\"\" id=\"link-file\"></a><br/>
        <input type=\"file\" id=\"media\" name=\"media\" style=\"border:1px solid grey\">
        <br/>
        <em class=\"emStyle\">One file only.</em><br/>
        <em class=\"emStyle\">";
        // line 11
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["maxSize"]) ? $context["maxSize"] : null), "html", null, true));
        echo " Size Limit.</em><br/>
        <em class=\"emStyle\">Allowed types:  png, jpg, jpeg, gif, bmp, tiff, x-flv, mp4</em>
      </td>
    </tr>
    <tr>
      <td width=\"20px\" style=\"vertical-align:top\"><b class=\"boldTitle\">Description</b></td>
      <td>
        <textarea id=\"description\" name=\"description\" class=\"textareaStyle\"></textarea>
      </td>
    </tr>
    <tr>
      <td></td>
       <td>
      <section class=\"flat2\">
        <button class=\"hover\" id=\"send\" type=\"button\" onclick=\"doEditProccess();\">Send</button>
        <button class=\"active\" type=\"button\" onclick=\"doBack();\">Back</button>
      </section>
      </td>
    </tr>
   </table>
</form>

<script>

  var url = \"";
        // line 35
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->getUrl("rest_api")));
        echo "\";
  var contentType = \"application/json\";
  var urlFiles = \"";
        // line 37
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["urlFiles"]) ? $context["urlFiles"] : null), "html", null, true));
        echo "\";
  var idDetail = \"";
        // line 38
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true));
        echo "\";

  function doBack(){
    window.location.href=url;
  }

  function doGetDetail(idDetail){
    if(idDetail == \"\"){
      alert(\"id is not found\");
      doBack();
    }

    jQuery.ajax({
      headers:{
        \"Content-Type\":contentType,
      },
      method: \"POST\",
      url: url+\"/\"+idDetail+\"/detail?_format=hal_json\",
      cache: false,
      beforeSend: function(xhr) {

      },
      success: function(data){
         var obj = data;
        if(obj.data !== undefined){
          var media =  obj.data[idDetail].uri;
          media =  media.split(\"//\");
          jQuery(\"#description\").html(obj.data[idDetail].description);
          jQuery(\"#link-file\").html(obj.data[idDetail].filename);
          jQuery(\"#link-file\").attr(\"href\",urlFiles+media[1]);
        }

      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        //Error Modal
        var err = JSON.parse(XMLHttpRequest.responseText);

        alert(textStatus + \": \\n \" + err.message);
      }
    });
  }

  doGetDetail(idDetail);

  function getBase64(file) {
     var reader = new FileReader();
     var result = \"\";
     //reader.readAsDataURL(file);
     reader.onload = function(readerEvt) {
           var binaryString = readerEvt.target.result;
           result = btoa(binaryString);
           return result;
       };

       reader.readAsBinaryString(file);

     /*reader.onload = function () {

       result = reader.result;
       result = btoa(result);
        console.log(result);

     };*/
     reader.onerror = function (error) {
       console.log('Error: ', error);
     };

  }


  function doEditProccess(){

  \tvar file = jQuery(\"#media\").val();
  \tvar description = jQuery(\"#description\").val();
  \tvar message = \"\";

  \tif(file == \"\"){
  \t\tmessage = message + \"file media is empty\\n\";
  \t}

  \tif(message == \"\"){
    jQuery(\"#send\").html(\"Please wait ...\").css(\"width\",\"120px\");
    file = document.getElementById('media').files;
    //var base64 = getBase64(file[0]);
    var fileName = file[0].name;
    var fileMime = file[0].type;
    var fileSize = file[0].size;

    var reader = new FileReader();
    var result = \"\";

    reader.onload = function(readerEvt) {
          var binaryString = readerEvt.target.result;
          result = btoa(binaryString);
          var package = {

                    fileMime :fileMime,
                    fileName :fileName,
                    fileSize :fileSize,
                    data : result,
                    description: description
                 }

          var formData = new FormData(jQuery('#form-add')[0]);
          jQuery.ajax({
                data:  JSON.stringify(package),
                 headers:{
                \t\"Content-Type\":contentType,
                },
                method: \"PATCH\",
                url: url+\"/\"+idDetail+\"/edit?_format=hal_json\",
                cache: false,
                dataType:\"JSON\",
                beforeSend: function(xhr) {

                },
                success: function(data){
                  alert(\"Succes Edit Content\");
                  doBack();
                 },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                  //Error Modal
                  var err = JSON.parse(XMLHttpRequest.responseText);

                  alert(textStatus + \": \\n \" + err.message);
                  jQuery(\"#send\").html(\"Send\").css(\"width\",\"60px\");

                }
              });
      };
        reader.readAsBinaryString(file[0]);

  \t}else{
  \t\talert(message);
  \t}

  }

</script>
";
    }

    public function getTemplateName()
    {
        return "core/modules/rest_api/templates/edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 38,  87 => 37,  82 => 35,  55 => 11,  43 => 1,);
    }
}
/* <h1 class="headerStyle">REST API Edit</h1>*/
/* <form id="form-edit" name="form-edit">*/
/*    <table >*/
/*     <tr>*/
/*       <td width="20px" style="vertical-align:top"><b class="boldTitle">Media <font color='red'>*</font></b></td>*/
/*        <td>*/
/*         file : <a href="" id="link-file"></a><br/>*/
/*         <input type="file" id="media" name="media" style="border:1px solid grey">*/
/*         <br/>*/
/*         <em class="emStyle">One file only.</em><br/>*/
/*         <em class="emStyle">{{maxSize}} Size Limit.</em><br/>*/
/*         <em class="emStyle">Allowed types:  png, jpg, jpeg, gif, bmp, tiff, x-flv, mp4</em>*/
/*       </td>*/
/*     </tr>*/
/*     <tr>*/
/*       <td width="20px" style="vertical-align:top"><b class="boldTitle">Description</b></td>*/
/*       <td>*/
/*         <textarea id="description" name="description" class="textareaStyle"></textarea>*/
/*       </td>*/
/*     </tr>*/
/*     <tr>*/
/*       <td></td>*/
/*        <td>*/
/*       <section class="flat2">*/
/*         <button class="hover" id="send" type="button" onclick="doEditProccess();">Send</button>*/
/*         <button class="active" type="button" onclick="doBack();">Back</button>*/
/*       </section>*/
/*       </td>*/
/*     </tr>*/
/*    </table>*/
/* </form>*/
/* */
/* <script>*/
/* */
/*   var url = "{{ url('rest_api') }}";*/
/*   var contentType = "application/json";*/
/*   var urlFiles = "{{urlFiles}}";*/
/*   var idDetail = "{{value}}";*/
/* */
/*   function doBack(){*/
/*     window.location.href=url;*/
/*   }*/
/* */
/*   function doGetDetail(idDetail){*/
/*     if(idDetail == ""){*/
/*       alert("id is not found");*/
/*       doBack();*/
/*     }*/
/* */
/*     jQuery.ajax({*/
/*       headers:{*/
/*         "Content-Type":contentType,*/
/*       },*/
/*       method: "POST",*/
/*       url: url+"/"+idDetail+"/detail?_format=hal_json",*/
/*       cache: false,*/
/*       beforeSend: function(xhr) {*/
/* */
/*       },*/
/*       success: function(data){*/
/*          var obj = data;*/
/*         if(obj.data !== undefined){*/
/*           var media =  obj.data[idDetail].uri;*/
/*           media =  media.split("//");*/
/*           jQuery("#description").html(obj.data[idDetail].description);*/
/*           jQuery("#link-file").html(obj.data[idDetail].filename);*/
/*           jQuery("#link-file").attr("href",urlFiles+media[1]);*/
/*         }*/
/* */
/*       },*/
/*       error: function (XMLHttpRequest, textStatus, errorThrown) {*/
/*         //Error Modal*/
/*         var err = JSON.parse(XMLHttpRequest.responseText);*/
/* */
/*         alert(textStatus + ": \n " + err.message);*/
/*       }*/
/*     });*/
/*   }*/
/* */
/*   doGetDetail(idDetail);*/
/* */
/*   function getBase64(file) {*/
/*      var reader = new FileReader();*/
/*      var result = "";*/
/*      //reader.readAsDataURL(file);*/
/*      reader.onload = function(readerEvt) {*/
/*            var binaryString = readerEvt.target.result;*/
/*            result = btoa(binaryString);*/
/*            return result;*/
/*        };*/
/* */
/*        reader.readAsBinaryString(file);*/
/* */
/*      /*reader.onload = function () {*/
/* */
/*        result = reader.result;*/
/*        result = btoa(result);*/
/*         console.log(result);*/
/* */
/*      };*//* */
/*      reader.onerror = function (error) {*/
/*        console.log('Error: ', error);*/
/*      };*/
/* */
/*   }*/
/* */
/* */
/*   function doEditProccess(){*/
/* */
/*   	var file = jQuery("#media").val();*/
/*   	var description = jQuery("#description").val();*/
/*   	var message = "";*/
/* */
/*   	if(file == ""){*/
/*   		message = message + "file media is empty\n";*/
/*   	}*/
/* */
/*   	if(message == ""){*/
/*     jQuery("#send").html("Please wait ...").css("width","120px");*/
/*     file = document.getElementById('media').files;*/
/*     //var base64 = getBase64(file[0]);*/
/*     var fileName = file[0].name;*/
/*     var fileMime = file[0].type;*/
/*     var fileSize = file[0].size;*/
/* */
/*     var reader = new FileReader();*/
/*     var result = "";*/
/* */
/*     reader.onload = function(readerEvt) {*/
/*           var binaryString = readerEvt.target.result;*/
/*           result = btoa(binaryString);*/
/*           var package = {*/
/* */
/*                     fileMime :fileMime,*/
/*                     fileName :fileName,*/
/*                     fileSize :fileSize,*/
/*                     data : result,*/
/*                     description: description*/
/*                  }*/
/* */
/*           var formData = new FormData(jQuery('#form-add')[0]);*/
/*           jQuery.ajax({*/
/*                 data:  JSON.stringify(package),*/
/*                  headers:{*/
/*                 	"Content-Type":contentType,*/
/*                 },*/
/*                 method: "PATCH",*/
/*                 url: url+"/"+idDetail+"/edit?_format=hal_json",*/
/*                 cache: false,*/
/*                 dataType:"JSON",*/
/*                 beforeSend: function(xhr) {*/
/* */
/*                 },*/
/*                 success: function(data){*/
/*                   alert("Succes Edit Content");*/
/*                   doBack();*/
/*                  },*/
/*                 error: function (XMLHttpRequest, textStatus, errorThrown) {*/
/*                   //Error Modal*/
/*                   var err = JSON.parse(XMLHttpRequest.responseText);*/
/* */
/*                   alert(textStatus + ": \n " + err.message);*/
/*                   jQuery("#send").html("Send").css("width","60px");*/
/* */
/*                 }*/
/*               });*/
/*       };*/
/*         reader.readAsBinaryString(file[0]);*/
/* */
/*   	}else{*/
/*   		alert(message);*/
/*   	}*/
/* */
/*   }*/
/* */
/* </script>*/
/* */
