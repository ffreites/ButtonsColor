<?php

namespace Hibrido\ThemeSettings\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigHelper extends AbstractHelper
{

    const XML_PATH_THEMESETTING = 'theme_options/';

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        WriterInterface $writterInterface
    )
    {
        $this->configWriter = $writterInterface;
        parent::__construct($context);
    }

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }

    public function setConfigValue($field, $value, $storeId = null)
    {
        $scope = ScopeInterface::SCOPE_STORES;

        if ($storeId == 'default') {
            $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
        }

        return $this->configWriter->save(
            $field,
            $value,
            $scope,
            $storeId
        );
        //$this->configWriter->save($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
    }

    public function getConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_THEMESETTING . 'general/' . $code, $storeId);
    }

    public function setConfig($code, $value, $storeId = null)
    {
        return $this->setConfigValue(self::XML_PATH_THEMESETTING . 'general/' . $code, $value, $storeId);
    }
}
