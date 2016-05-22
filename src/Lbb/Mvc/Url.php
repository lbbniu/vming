<?php
/**
 * LbbEngine (http://lbbniu.com/)
 * A development engine based on Phalcon Framework.
 *
 * @copyright Copyright (c) 2014-2015 LbbEngine Team (https://github.com/lbbniu/LbbEngine)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Lbb\Mvc;

use Lbb\Exception;
use Phalcon\Mvc\Url as PhalconUrl;

/**
 * Url generate class with static file version support.
 * @package Lbb\Mvc
 */
class Url extends PhalconUrl
{
    /**
     * @var string
     */
    protected $version;

    /**
     * Load version from a file
     * @var string
     */
    protected $versionFile;

    /**
     * @return string
     */
    public function getVersion()
    {
        if ($this->version) {
            return $this->version;
        }

        $version = date('Ymd');
        if ($this->versionFile && $fh = fopen($this->versionFile, 'r')) {
            $version = fread($fh, 10);
            fclose($fh);
        }
        return $this->version = $version;
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param $versionFile
     * @return $this
     */
    public function setVersionFile($versionFile)
    {
        $this->versionFile = $versionFile;
        return $this;
    }

    /**
     * @param null $url
     * @return string
     */
    public function getStatic($url = null)
    {
        return parent::getStatic($url) . '?' . $this->getVersion();
    }
}
