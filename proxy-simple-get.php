<?php
// 创建新的 cURL 资源


// 默认的options
$options = array(
	CURLOPT_RETURNTRANSFER => true,     // return web page
	CURLOPT_HEADER         => false,    // don't return headers
	CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	CURLOPT_ENCODING       => "",       // handle all encodings
	CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'],		// who am i
	CURLOPT_AUTOREFERER    => true,     // set referer on redirect
	CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
	CURLOPT_TIMEOUT        => 120,      // timeout on response
	CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	CURLOPT_SSL_VERIFYPEER => false 	// Disabled SSL Cert checks
);


if( !isset($_GET['url'])) {
	$contents = 'ERROR: url not specified';
	echo $contents;
} else {
	$ch = curl_init($_GET['url']);

	// 设置提交方式是POST还是GET。 默认是GET
	if (isset($_GET['method']) && (strtolower($_GET['method']) == 'post')) {
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $_GET );
	}

	// 设置Cookie
	$cookie = array();
	foreach ( $_COOKIE as $key => $value ) {
	  $cookie[] = $key . '=' . $value;
	}
	//if ( $_GET['send_session'] ) {
	//  $cookie[] = SID;
	//}
	$cookie = implode( '; ', $cookie );
	curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
	
	
	// 将options 一起设置
	curl_setopt_array( $ch, $options );
	
	// 执行访问
	$resp = curl_exec($ch);
	echo $resp;

	// 关闭 cURL 资源，并且释放系统资源
	curl_close($ch);
}

?>