<?php 


	Class Google
	{
		public $apikey;
		
		function __construct($key){
			$this->apikey = $key;
		}
		
		
		function Translate($param){ 
			$post = array(
				'key'    => $this->apikey,
				'q'      => rawurlencode($param["text"]),
				'target' => $param["target"],
				'source' => $param["source"],
				'format' => "html" 
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/language/translate/v2');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('X-HTTP-Method-Override: GET'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			$response = curl_exec($ch);
			curl_close($ch); 
			$data = json_decode($response,true);
			return ($data["data"]["translations"][0]["translatedText"]); 
		}
		
	}