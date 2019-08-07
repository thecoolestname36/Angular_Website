<?php namespace srad\components;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 7:30 PM
 */

use srad\Web;

class ControllerComponent
{

    private $_entryScriptUrl;
    private $_hostInfo;
    private $_securePort;
    private $_port;


    public function __construct()
    {
    }

    public function renderView($viewFile) {
        $viewFile = _MAIN_DIR.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$viewFile.".php";
        ob_start();
        ob_implicit_flush(false);
        require($viewFile);
        return ob_get_clean();
    }

    public static function run()
    {

        try {
            $request = array(
                0 => 'Home',
            );
            if (isset($_GET['request']) && strlen($_GET['request']) > 0) {
                $request = explode('/', $_GET['request']);
            }
            if (!array_key_exists(1, $request) || !strlen($request[1]) > 0) {
                $request[1] = 'Index';
            }
            $request[0] = ucfirst($request[0]);
            $request[0] = $request[0] . "Controller";
            $request[1] = ucfirst($request[1]);
            $request[1] = 'action' . $request[1];

            require_once _MAIN_DIR . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $request[0] . ".php";
            $c = "\\srad\\controllers\\" . $request[0];
            $c = new $c;
            $c->{$request[1]}();

        } catch (\Exception $e) {
            throw new \HttpException($e, 500);
        }
    }



    public function createRequestUrl($controllerAction) {
        if($this->_entryScriptUrl === null) {
            $this->_entryScriptUrl = $this->getHostInfo().Web::$App->getScriptUrl();
        }
        return $this->_entryScriptUrl."?request=".$controllerAction;
    }
    /**
     * Returns the schema and host part of the application URL.
     * The returned URL does not have an ending slash.
     * By default this is determined based on the user request information.
     * You may explicitly specify it by setting the {@link setHostInfo hostInfo} property.
     * @param string $schema schema to use (e.g. http, https). If empty, the schema used for the current request will be used.
     * @return string schema and hostname part (with port number if needed) of the request URL (e.g. http://www.yiiframework.com)
     * @see setHostInfo
     */
    public function getHostInfo($schema='')
    {
        if($this->_hostInfo===null)
        {
            if($secure=$this->getIsSecureConnection())
                $http='https';
            else
                $http='http';
            if(isset($_SERVER['HTTP_HOST']))
                $this->_hostInfo=$http.'://'.$_SERVER['HTTP_HOST'];
            else
            {
                $this->_hostInfo=$http.'://'.$_SERVER['SERVER_NAME'];
                $port=$secure ? $this->getSecurePort() : $this->getPort();
                if(($port!==80 && !$secure) || ($port!==443 && $secure))
                    $this->_hostInfo.=':'.$port;
            }
        }
        if($schema!=='')
        {
            $secure=$this->getIsSecureConnection();
            if($secure && $schema==='https' || !$secure && $schema==='http')
                return $this->_hostInfo;

            $port=$schema==='https' ? $this->getSecurePort() : $this->getPort();
            if($port!==80 && $schema==='http' || $port!==443 && $schema==='https')
                $port=':'.$port;
            else
                $port='';

            $pos=strpos($this->_hostInfo,':');
            return $schema.substr($this->_hostInfo,$pos,strcspn($this->_hostInfo,':',$pos+1)+1).$port;
        }
        else
            return $this->_hostInfo;
    }

    /**
     * Returns the port to use for secure requests.
     * Defaults to 443, or the port specified by the server if the current
     * request is secure.
     * You may explicitly specify it by setting the {@link setSecurePort securePort} property.
     * @return integer port number for secure requests.
     * @see setSecurePort
     * @since 1.1.3
     */
    public function getSecurePort()
    {
        if($this->_securePort===null)
            $this->_securePort=$this->getIsSecureConnection() && isset($_SERVER['SERVER_PORT']) ? (int)$_SERVER['SERVER_PORT'] : 443;
        return $this->_securePort;
    }

    /**
     * Return if the request is sent via secure channel (https).
     * @return boolean if the request is sent via secure channel (https)
     */
    public function getIsSecureConnection()
    {
        return isset($_SERVER['HTTPS']) && (strcasecmp($_SERVER['HTTPS'],'on')===0 || $_SERVER['HTTPS']==1)
        || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'],'https')===0;
    }

    /**
     * Returns the port to use for insecure requests.
     * Defaults to 80, or the port specified by the server if the current
     * request is insecure.
     * You may explicitly specify it by setting the {@link setPort port} property.
     * @return integer port number for insecure requests.
     * @see setPort
     * @since 1.1.3
     */
    public function getPort()
    {
        if($this->_port===null)
            $this->_port=!$this->getIsSecureConnection() && isset($_SERVER['SERVER_PORT']) ? (int)$_SERVER['SERVER_PORT'] : 80;
        return $this->_port;
    }


}
