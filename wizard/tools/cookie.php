<?php
if(!defined('STDIN') ) {
?>
<!-- WizardPHP Framework http://www.wizardphp.com -->
<?php
}
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
