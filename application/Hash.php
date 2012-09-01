<?php
class Hash
{
	public static function getHash($algorism, $data, $key)
	{
		$hash = hash_init($algorism, HASH_HMAC, $key);
		hash_update($hash, $data);
		return hash_final($hash);
	}
}
?>