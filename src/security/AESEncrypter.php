<?php


namespace kitten\pack\security;

//https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/

class AESEncrypter
{
    /** @var string  */
    protected $key;

    /**
     * AESEncrypter constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key=$key;
    }

    /**
     * @return string
     */
    public static function generateKey(){
        $key=base64_encode(openssl_random_pseudo_bytes(32));
        return $key;
    }

    /**
     * @param string $data
     * @return string
     */
    public function encrypt(string $data){
        $key=$this->key;
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode($key);
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted . '::' . $iv);
    }

    /**
     * @param string $data
     * @return string
     */
    public function decrypt(string $data){
        $key=$this->key;
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode($key);
        // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }
}