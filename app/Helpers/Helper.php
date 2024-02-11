<?php
namespace App\Helpers;

use App\Tag;
use App\Curso;
use App\Constants\CommonsConstants;

class Helper
{
	public static function recentPosts( $categoria_id = null ){
			// Obtener cursos y ofertas académicas
		$curs = Curso::where('categoria_id', '!=', 2)
                         ->where('estado', Curso::ESTADO_PROXIMO)
					->orderBy('created_at', 'DESC')
					->get()
					->take(4);
		return $curs;

	}

	public static function getTags(){
          $tags = Tag::whereHas('cursos')->get();
		return $tags;
	}

	public static function getRecentPostInstagram()
	{
		// Supply a user id and an access token
          $userid = "3040871634";
          $accessToken = "3040871634.0b0a53a.271afbc2524c47b0b5b38e701bf0e98d";

          // Gets our data
          function fetchData($url){
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_TIMEOUT, 20);
               $result = curl_exec($ch);
               curl_close($ch); 
               return $result;
          }

          // Pulls and parses data.
          $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
          $result = json_decode($result);

          return $result;
	}


     public static function makeNewPassword($user)
     {
          $letter1 = chr(rand(97,122));
          $letter2 = chr(rand(97,122));
          $number =  $user->documento_nro != null ? substr($user->documento_nro, -4) : substr(str_shuffle("0123456789"), 0, 4);

          $newPassword = $letter1 . $letter2 . $number;

          return $newPassword;
     }

     public static function getCountries()
     {
          $arrContextOptions = array(
               "ssl"=>array(
                   "verify_peer" => false,
                   "verify_peer_name" => false,
               ),
           );

           return  json_decode(
               file_get_contents( asset(CommonsConstants::COUNTRIES_JSON_PATH), false, stream_context_create($arrContextOptions) ), 
               true
          );
     }
}