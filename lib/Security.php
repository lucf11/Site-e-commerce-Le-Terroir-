<?php
class Security {
	public static function hacher($texte_en_clair) {
		$texte_hache = hash('sha256', $texte_en_clair);
		return $texte_hache;
	}

	public static function generateRandomHex() {
		// Generate a 32 digits hexadecimal number
		$numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
		$bytes = openssl_random_pseudo_bytes($numbytes); 
		$hex   = bin2hex($bytes);
		return $hex;
	  }
}


// echo $mot_passe_hache;
//affiche '3a7bd3e2360a3d29eea436fcfb7e44c735d117c42d1c1835420b6b9942dd4f1b'
?>