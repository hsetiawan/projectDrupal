<?php

/* core/modules/rest_api/templates/add.html.twig */
class __TwigTemplate_466b50045945583090dd787306bb886b4acada03a0b77d3f4ebb6f04ed55b646 extends Twig_Template
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
        $functions = array("url" => 34);

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
        echo "<h1 class=\"headerStyle\">REST API Add</h1>
<form id=\"form-add\" name=\"form-add\">
   <table >
    <tr>
      <td width=\"20px\" style=\"vertical-align:top\"><b class=\"boldTitle\">Media <font color='red'>*</font></b></td>
       <td>
        <input type=\"file\" id=\"media\" name=\"media\" style=\"border:1px solid grey\">
        <br/>
        <em class=\"emStyle\">One file only.</em><br/>
        <em class=\"emStyle\">";
        // line 10
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
        <button class=\"hover\" id=\"send\" type=\"button\" onclick=\"doAddProccess();\">Send</button>
        <button class=\"active\" type=\"button\" onclick=\"doBack();\">Back</button>
      </section>
      </td>
    </tr>
   </table>
</form>

<script>

  var url = \"";
        // line 34
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->getUrl("rest_api")));
        echo "\";
  var contentType = \"application/json\";

  function doBack(){
    window.location.href=url;
  }

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


  function doAddProccess(){

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
                method: \"POST\",
                url: url+\"/add?_format=hal_json\",
                cache: false,
                dataType:\"JSON\",
                beforeSend: function(xhr) {

                },
                success: function(data){
                  alert(\"Succes Add Content\");
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
        return "core/modules/rest_api/templates/add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 34,  54 => 10,  43 => 1,);
    }
}
/* <h1 class="headerStyle">REST API Add</h1>*/
/* <form id="form-add" name="form-add">*/
/*    <table >*/
/*     <tr>*/
/*       <td width="20px" style="vertical-align:top"><b class="boldTitle">Media <font color='red'>*</font></b></td>*/
/*        <td>*/
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
/*         <button class="hover" id="send" type="button" onclick="doAddProccess();">Send</button>*/
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
/* */
/*   function doBack(){*/
/*     window.location.href=url;*/
/*   }*/
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
/*   function doAddProccess(){*/
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
/*                 method: "POST",*/
/*                 url: url+"/add?_format=hal_json",*/
/*                 cache: false,*/
/*                 dataType:"JSON",*/
/*                 beforeSend: function(xhr) {*/
/* */
/*                 },*/
/*                 success: function(data){*/
/*                   alert("Succes Add Content");*/
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
