<?
/*function newcookie($name, $value='', $expire = 0, $path = '', $domain='', $secure=false, $httponly=false) { 
	print "galeta!";
	$_COOKIE[$name] = $value; 
	return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly); 
}
*/
function set_cookie($Name, $Value = '', $MaxAge = 0, $Path = '', $Domain = '', $Secure = false, $HTTPOnly = false) {
  header('Set-Cookie: ' . rawurlencode($Name) . '=' . rawurlencode($Value)
                        . (empty($MaxAge) ? '' : '; Max-Age=' . $MaxAge)
                        . (empty($Path)   ? '' : '; path=' . $Path)
                        . (empty($Domain) ? '' : '; domain=' . $Domain)
                        . (!$Secure       ? '' : '; secure')
                        . (!$HTTPOnly     ? '' : '; HttpOnly'), false);
}
 

function destroycookie($name) { 
	unset($_COOKIE[$name]); 
	return setcookie($name, NULL, -1); 
}
?>
