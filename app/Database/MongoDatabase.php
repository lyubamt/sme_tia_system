<?php
// app/Database/MongoDatabase.php
namespace App\Database;

use App\Services\Contracts\NosqlServiceInterface;

class MongoDatabase implements NosqlServiceInterface
{
  // private $manager;
  // private $database;
  //
  // public function __construct($host, $port, $database)
  // {
  //   $this->database = $database;
  //   $this->manager = new \MongoDB\Driver\Manager( "mongodb://".$host.":".$port."/".$database );
  // }

  /**
   * @see \App\Services\Contracts\NosqlServiceInterface::find()
   */
  public function find($collection, Array $criteria)
  {
    $post_data = $criteria;
    $response = json_decode($this->api_call_json($url = "agyw_get_one_user",$post_data,$headers = []));
    $user = [];
    if ($response){
      if (isset($response->data)){

        $data = $response->data;
        $user_info = $data[0];
        $user['username'] = $user_info->email;
        $user['password'] = '$2y$10$JEawqkLG2BWfPm/QI7seK.kB4skeOgfG1g..E36pgVGPSk.Oc65nO';

      }
    }

    return $user;
  }

  public function create($collection, Array $document) {}
  public function update($collection, $id, Array $document) {}
  public function delete($collection, $id) {}

  public function api_call_json($url,$post_data,$headers){

    $active_base_url_info = "http://154.118.230.203/tomsha/test/";
    $server_output = "";
    if ($active_base_url_info){

        $url = $active_base_url_info->name.$url;

        $encoded_data = json_encode($post_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$encoded_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);

        if (!empty($headers)) {

          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        }

        $respons = curl_exec($ch);

        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
           $server_output = "cURL Error #:" . $err;
        } else {
           $server_output = $respons;
        }

    }

    return $server_output;

  }

}
