<?php

class Response{

	//默认参数；
	const JSON = 'json';


	//综合通信方法；
	public static function show($code,$message = '',$data=array(),$type = self::JSON){
		
		if(!is_numeric($code)){
			return '';
		}

		$result = array(
			'code' => $code,
			'message'=> $message,
			'data' => $data
		);

		$type = isset($_GET['format']) ? $_GET['format']:self::JSON;

		if($type == 'json'){
			//json
			self::json($code,$message,$data);
			exit;
		}elseif ($type == 'array') {
			//测试数组；
			var_dump($result);
		}elseif ($type == 'xml') {
			//xml
			self::xmlEncode($code,$message,$data);
			exit;
		}



	}


	/**
	*按json方法输出通信数据
	*@param integer $code 状态吗；
	*@param string $message 提示信息；
	*@param arrat $data 数据；
	*return string
	**/

	public static function json($code,$message = '',$data=array()){

		if(!is_numeric($code)){
			return '';
		}

		$result = array(
			'code' => $code,
			'message'=> $message,
			'data' => $data
		);

		echo json_encode($result);

	}


	/**
	*按xml方法输出通信数据
	*@param integer $code 状态吗；
	*@param string $message 提示信息；
	*@param arrat $data 数据；
	*return string
	**/
	public static function xmlEncode($code,$message = '',$data=array()){

		if(!is_numeric($code)){
			return '';
		}

		$result = array(
			'code' => $code,
			'message'=> $message,
			'data' => $data
		);

		header("Content-Type:text/xml");

		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<root>";
		$xml .= self::xmlToEncode($result);
		$xml .="</root>";

		echo $xml;
	}


	public static function xmlToEncode($data)
	{

		$xml = $attr = '';
		foreach($data as $key => $value){

			//<0><4></0>  转化为<item id="0">4</item>
			if(is_numeric($key)){
				$attr = "id = '$key'";
				$key = "item";
			}


			$xml .= "<$key $attr>";
			$xml .= is_array($value) ? self::xmlToEncode($value):$value;
			$xml .= "</$key>";
		}

		return $xml;
	}

}


