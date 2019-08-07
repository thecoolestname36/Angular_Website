<?php namespace srad;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:57 PM
 */

define('_MAIN_DIR',__DIR__);

class Web
{

    protected $config;
    protected $url;
    private $_scriptUrl;

    /**
     * @var self
     */
    static $App;

    public function __construct($config='')
    {
        Web::requireDir(_MAIN_DIR.DIRECTORY_SEPARATOR."components");
        $this->config = $config;
        Web::$App = &$this;
        \srad\components\ControllerComponent::run();
    }

    public static function requireDir($dir)
    {
        foreach (scandir($dir) as $filename) {
            $path = $dir.DIRECTORY_SEPARATOR.$filename;
            if (is_file($path)) {
                require_once $path;
            }
        }
    }

    public function getScriptUrl()
    {
        if ($this->_scriptUrl === null) {
            $scriptName = basename($_SERVER['SCRIPT_FILENAME']);
            if (basename($_SERVER['SCRIPT_NAME']) === $scriptName)
                $this->_scriptUrl = $_SERVER['SCRIPT_NAME'];
            elseif (basename($_SERVER['PHP_SELF']) === $scriptName)
                $this->_scriptUrl = $_SERVER['PHP_SELF'];
            elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptName)
                $this->_scriptUrl = $_SERVER['ORIG_SCRIPT_NAME'];
            elseif (($pos = strpos($_SERVER['PHP_SELF'], '/' . $scriptName)) !== false)
                $this->_scriptUrl = substr($_SERVER['SCRIPT_NAME'], 0, $pos) . '/' . $scriptName;
            elseif (isset($_SERVER['DOCUMENT_ROOT']) && strpos($_SERVER['SCRIPT_FILENAME'], $_SERVER['DOCUMENT_ROOT']) === 0)
                $this->_scriptUrl = str_replace('\\', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']));
            else
                throw new \Exception('CHttpRequest is unable to determine the entry script URL.');
        }
        return $this->_scriptUrl;
    }

}

new Web();
