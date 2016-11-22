<?php
/**
 *
 */
namespace Drupal\rest_api\Controller;

use Drupal\Core\Entity\Query;
use Drupal\Component\Serialization\Json;
use Drupal\rest_api\RestApiModel;

use Drupal\Core\Controller\ControllerBase;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\Core\Url;
#use Drupal\Component\Uuid\UuidInterface;

 use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
 use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
 use Symfony\Component\HttpKernel\Exception\HttpException;

class RestApiController extends ControllerBase
{

  protected $messageError = "Unprocessable Entity: validation failed.\n";
  public function getUuid() {
    return $this->uuid;
  }


  public function getMimeTypes() {
    $mime_types = array(

              'image/png',
              'image/jpeg',
              'image/jpeg',
              'image/jpeg',
              'image/gif',
              'image/bmp',
              'image/tiff',
              'image/tiff',
              'image/svg+xml',
              'image/svg+xml',

              'video/quicktime',
              'video/quicktime',
              'application/x-shockwave-flash',
              'video/x-flv',
              'video/mp4'

    );
      return $mime_types;
  }

  function convertPHPSizeToBytes($sSize)
  {
      if ( is_numeric( $sSize) ) {
         return $sSize;
      }
      $sSuffix = substr($sSize, -1);
      $iValue = substr($sSize, 0, -1);
      switch(strtoupper($sSuffix)){
      case 'P':
          $iValue *= 1024;
      case 'T':
          $iValue *= 1024;
      case 'G':
          $iValue *= 1024;
      case 'M':
          $iValue *= 1024;
      case 'K':
          $iValue *= 1024;
          break;
      }
      return $iValue;
  }

  // returns true if $needle is a substring of $haystack
  function contains($needle, $haystack)
  {
      return strpos($haystack, $needle) !== false;
  }

   public function restapi()
  {
    $my_path = file_create_url("public://");
    return [
      '#theme' => 'hello_page',
      '#name' => $my_path,
      '#attached' => [
        'library' => [
          'rest_api/rest_api-styles', //include our custom library for this response
        ]
      ]
    ];

  }

  //route restapiAddForm
  public function restapiAddForm()
 {
   $iniMax = ini_get('upload_max_filesize');
    return [

     '#theme' => 'add_page',
     '#maxSize' => $iniMax,
     '#attached' => [
       'library' => [
         'rest_api/rest_api-styles', //include our custom library for this response
       ]
     ]
   ];

 }


 //route restapiEditForm
 public function restapiEditForm($value)
{
  $iniMax = ini_get('upload_max_filesize');
  $my_path = file_create_url("public://");
   return [

    '#theme' => 'edit_page',
    '#maxSize' => $iniMax,
    '#urlFiles' => $my_path,
    '#value' => $value,
    '#attached' => [
      'library' => [
        'rest_api/rest_api-styles', //include our custom library for this response
      ]
    ]
  ];

}


    public function restApiList(Request $request){
        //$message = array("success" => false,"message" => "parameter is not found");
        //var_dump($request->request->all());
          $header = $request->headers->get('Content-Type');
          $typeFormat = $this->validateFormat($header);
          $list = RestApiModel::getAll();
          if(empty($list)){
            $message = array("success"=>true,"message" => "data not found.");
          }else{
            $dataResult = array();
            foreach($list as $key=>$data) {
              foreach ($data as $keyData => $valueData) {
                $result = "";
                if($keyData == "uri"){
                       $valueData = file_create_url($valueData);
                  }
                  $dataResult = array($keyData => $valueData);

                }
            }
             $message = array("success"=>true,"data"=>$list);
          }
          return new JsonResponse($message);


    }

  //wmcmfd
  public function restApiAdd(Request $request){

        $header = $request->headers->get('Content-Type');
        $typeFormat = $this->validateFormat($header);

        if(empty($request->getContent())){

          throw new BadRequestHttpException('No entity  content received.');

        }else{
           $values =  $request->getContent();

          $error       = "0";
          $params = json_decode($values, TRUE);
          $description = "";
          $file        = ""; //base64_decode($file_data);
          $filemime    = "";
          $filesize    = "";
          $filename    = "";

          foreach ($params as $key=>$data) {

            if($key == "fileMime"){
              $filemime = $data;
            }
            if($key == "fileSize"){
              $filesize = $data;
            }
            if($key == "fileName"){
              $filename = $data;
            }
            if($key == "description"){
              $description = $data;
            }

            if($key == "data"){
              $file = base64_decode($data);
            }

          }

               if(is_null($file)){
                  $error = "1";
                  $this->validateField("field media is empty");
                }else{

                  $maxSize =  $this->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
                  $iniMax = ini_get('upload_max_filesize');

                  if(!in_array($filemime, $this->getMimeTypes())){
                    $error = "1";
                    $this->validateField("The mime type of the file is invalid (".$filemime."). Allowed  types are  png,jpg,jpeg,jpeg,gif,bmp,x-flv,mp4.");
                  }else if($filesize > $maxSize){
                    $error = "1";
                    $this->validateField("The file is too large  . Allowed maximum size is ".$iniMax.".");

                  }

                }

                  if($error != "0"){}else{

                    $typeFolderAccess = "public://";
                    $pathUpload = drupal_realpath($typeFolderAccess);
                    $timeDir =  date("Y-m");
                    $uriWithFileName  = $pathUpload."/".$timeDir."/".$filename;
                    $fileupload = file_unmanaged_save_data($file,  $uriWithFileName,FILE_EXISTS_RENAME);
                    if($fileupload){
                      $uri = $typeFolderAccess.$timeDir."/".drupal_basename($fileupload);
                      $uuid = \Drupal::service('uuid');
                      RestApiModel::add($uuid->generate(),$uri,$filename,$filemime,$filesize,$description);
                      $message = array("success" => true,"message" => "data has been uploaded.");
                    }else{
                      $this->validateField("Failed to save the file");
                    }

                  }

              return new JsonResponse($message);
        }
  }


    //wmcmfd
    public function restApiEdit(Request $request,$value){

        $header = $request->headers->get('Content-Type');
        $typeFormat = $this->validateFormat($header);

        $id = $value;
        if(empty($request->getContent())){

          throw new BadRequestHttpException('No entity  content received.');

        }else{
          $values =  $request->getContent();

          $error       = "0";
          $params = json_decode($values, TRUE);
          $description = "";
          $file        = ""; //base64_decode($file_data);
          $filemime    = "";
          $filesize    = "";
          $filename    = "";

          foreach ($params as $key=>$data) {

            if($key == "fileMime"){
              $filemime = $data;
            }
            if($key == "fileSize"){
              $filesize = $data;
            }
            if($key == "fileName"){
              $filename = $data;
            }
            if($key == "description"){
              $description = $data;
            }

            if($key == "data"){
              $file = base64_decode($data);
            }

          }

               if(is_null($file)){
                  $error = "1";
                  $this->validateField("field media is empty");
                }else{

                  $maxSize =  $this->convertPHPSizeToBytes(ini_get('upload_max_filesize'));
                  $iniMax = ini_get('upload_max_filesize');

                  if(!in_array($filemime, $this->getMimeTypes())){
                    $error = "1";
                    $this->validateField("The mime type of the file is invalid (".$filemime."). Allowed  types are  png,jpg,jpeg,jpeg,gif,bmp,x-flv,mp4.");
                  }else if($filesize > $maxSize){
                    $error = "1";
                    $this->validateField("The file is too large  . Allowed maximum size is ".$iniMax.".");

                  }

                }

                if(empty($id)){
                  $error = "1";
                  $this->validateField("field id is empty");
                 }else{
                  if(!RestApiModel::exists($id)){
                    $error = "1";
                    $this->validateField("id is not valid,please enter your valid id.");
                   }
                }

                  if($error != "0"){}else{

                    $typeFolderAccess = "public://";
                    $pathUpload = drupal_realpath($typeFolderAccess);
                    $timeDir =  date("Y-m");
                    $uriWithFileName  = $pathUpload."/".$timeDir."/".$filename;
                    $fileupload = file_unmanaged_save_data($file,  $uriWithFileName,FILE_EXISTS_RENAME);
                    if($fileupload){
                      $uri = $typeFolderAccess.$timeDir."/".drupal_basename($fileupload);
                      $data = array ('uri' => $uri, 'filename' => $filename,'$filemime' => $filemime,'filesize' => $filesize,'description' => $description);
                      RestApiModel::update ($id,$data);
                      $message = array("success" => true,"message" => "data has been updated.");
                    }else{
                      $this->validateField("Failed to save the file");
                    }

                  }

              return new JsonResponse($message);
        }
    }


        //DELETE FUNCTION
        public function restApiDelete(Request $request ,$value){

          $header = $request->headers->get('Content-Type');
          $typeFormat = $this->validateFormat($header);

            $id = $value;
            $error = "0";

                  if(empty($id)){
                    $this->validateField("id is empty");
                    $error = "1";
                   }else{
                    if(!RestApiModel::exists($id)){
                      $this->validateField("id is not found,please enter your valid id.");
                      $error = "1";
                     }
                  }

                  if($error != "0"){}else{
                      //unlink($file);
                      $result = RestApiModel::getDetail($id);
                      $uri = "";
                      if(!empty($result)){
                        foreach($result as $key=>$value){
                            $uri =$value->uri;
                        }

                        if($uri != ""){
                          if(file_unmanaged_delete($uri)){
                            RestApiModel::delete($id);
                            $message = array("success" => true,"message" => "data has been deleted.");
                          }
                        }else{
                          $this->validateField("file is not found");
                        }

                      }
                  }

            return new JsonResponse($message);
        }

        //GET DETAIL FUNCTION
        public function restapiDetail(Request $request ,$value){

          $header = $request->headers->get('Content-Type');
          $typeFormat = $this->validateFormat($header);

            $id = $value;
            $error = "0";

                  if(empty($id)){
                    $this->validateField("id is empty");
                    $error = "1";
                   }else{
                    if(!RestApiModel::exists($id)){
                      $this->validateField("id is not found,please enter your valid id.");
                      $error = "1";
                     }
                  }

                  if($error != "0"){}else{

                      $result = RestApiModel::getDetail($id);
                      $message = array("success" => true,"data" => $result);

                  }

            return new JsonResponse($message);
        }


        //VALIDATION for content-type
        protected function validateFormat($type) {

          $resultVal = $type;
          $formats = ['application/json', 'application/hal+json'];
          if (!in_array($type,$formats)) {

            throw new UnsupportedMediaTypeHttpException('No route found that matches "Content-Type: ' .$type . '"');

          }

          return $resultVal;
        }

        //VALIDATION for field entity
        protected function validateField($message){
          if(!empty($message)){
              $messageError .= $message;
              throw new HttpException(422, $messageError);
          }
          return '';

        }



}

 ?>
