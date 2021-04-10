<?php


namespace Qdysup;
use Qdysup\core\Base;
use Qdysup\exception\ClientException;

class Client extends Base
{


    public function __construct($appKey="", $appSecret="")
    {


        if (!empty($app_secret)) {
            $this->app_secret = $app_secret;
        }
        if (!empty($app_key)) {
            $this->app_key = $app_key;
        }

        self::checkEnv();
    }


    public static function checkEnv()
    {
        if (function_exists('get_loaded_extensions')) {
            //检测curl扩展
            $enabled_extension = array("curl");
            $extensions = get_loaded_extensions();
            if ($extensions) {
                foreach ($enabled_extension as $item) {
                    if (!in_array($item, $extensions)) {
                        throw new ClientException("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
                    }
                }
            } else {
                throw new ClientException("function get_loaded_extensions not found.");
            }
        } else {
            throw new ClientException('Function get_loaded_extensions has been disabled, please check php config.');
        }
    }
}