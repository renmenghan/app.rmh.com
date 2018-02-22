<?php
/**
 * Created by PhpStorm.
 * User: renmenghan
 * Date: 2018/2/20
 * Time: 下午12:08
 */
namespace app\common\lib\exception;
use think\Exception;

class ApiException extends Exception{

    public $message = '';
    public $httpCode=500;
    public $code = 0;
    public function __construct($message = "", $httpcode= 0, $code=0) {

        $this->httpCode = $httpcode;
        $this->message=$message;
        $this->code=$code;
    }
}