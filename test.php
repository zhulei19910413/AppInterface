<?php

require_once('./response.php');


// $data = array(
// 	'id'=>1,
// 	'name'=>'singwa',
// 	);

// $data = array(
// 	'id'=>1,
// 	'name'=>'singwa',
// 	'type' => array(4,5,6),
// 	);


$data = array(
	'id'=>1,
	'name'=>'singwa',
	'type' => array(4,5,6),
	'test' => array(1,45,67=>array(123,'tasty')),
	);


// Response::json(200,'数据返回成功',$aaa);

// Response::xmlEncode(200,'数据返回成功',$aaa);

Response::show(200,'数据返回成功',$data,'json');