<?php
function aliqr_encrypt($spfcf742, $spb81a55) { $spb81a55 = base64_decode($spb81a55); $spfcf742 = trim($spfcf742); $spfcf742 = addPKCS7Padding($spfcf742); $sp5a04cd = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), 1); $sp65b719 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $spb81a55, $spfcf742, MCRYPT_MODE_CBC); return base64_encode($sp65b719); } function aliqr_decrypt($spfcf742, $spb81a55) { $spfcf742 = base64_decode($spfcf742); $spb81a55 = base64_decode($spb81a55); $sp5a04cd = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), 1); $sp65b719 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $spb81a55, $spfcf742, MCRYPT_MODE_CBC); $sp65b719 = trim($sp65b719); $sp65b719 = stripPKSC7Padding($sp65b719); return $sp65b719; } function addPKCS7Padding($spfc668c) { $spfc668c = trim($spfc668c); $sp53ba11 = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC); $spe5a1f6 = $sp53ba11 - strlen($spfc668c) % $sp53ba11; if ($spe5a1f6 <= $sp53ba11) { $spff3536 = chr($spe5a1f6); $spfc668c .= str_repeat($spff3536, $spe5a1f6); } return $spfc668c; } function stripPKSC7Padding($spfc668c) { $spfc668c = trim($spfc668c); $spff3536 = substr($spfc668c, -1); $sp260870 = ord($spff3536); if ($sp260870 == 62) { return $spfc668c; } $spfc668c = substr($spfc668c, 0, -$sp260870); return $spfc668c; }