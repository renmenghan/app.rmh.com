<?php
namespace app\common\lib;

/**
 * aes 加密 解密类库
 * @by singwa
 * Class Aes
 * @package app\common\lib
 */
class Aes {

    private $key = '';
    /**
     *
     * @param $key 		密钥
     * @return String
     */
    public function __construct() {
        // 需要小伙伴在配置文件app.php中定义aeskey
        $this->key = config('app.aeskey');

    }
    /**
     * PHP DES 加密程式
     *
     * @param $key 密鑰（八個字元內）
     * @param $encrypt 要加密的明文
     * @return string 密文
     */

    function encrypt ( $encrypt) {
        // 根據 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 加入 Padding
        $block = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);
        $pad = $block - (strlen($encrypt) % $block);
        $encrypt .= str_repeat(chr($pad), $pad);

        // 不需要設定 IV 進行加密
        $passcrypt = mcrypt_encrypt(MCRYPT_DES, $this->key, $encrypt, MCRYPT_MODE_ECB);
        return base64_encode($passcrypt);
    }



    /**
     * PHP DES 解密程式
     *
     * @param $key 密鑰（八個字元內）
     * @param $decrypt 要解密的密文
     * @return string 明文
     */
    function decrypt ($decrypt)
    {
        // 不需要設定 IV
        $str = mcrypt_decrypt(MCRYPT_DES, $this->key, base64_decode($decrypt), MCRYPT_MODE_ECB);

        // 根據 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 移除 Padding
        $pad = ord($str[strlen($str) - 1]);
        return substr($str, 0, strlen($str) - $pad);
    }

}