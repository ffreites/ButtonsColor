<?php
declare(strict_types=1);

namespace Hibrido\ThemeSettings\Block;

class ThemeSettings extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;    

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hibrido\ThemeSettings\Helper\ConfigHelper $configHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,    
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configHelper = $configHelper;
        $this->storeManager = $storeManager;        
    }

    /**
     * @return string
     */
    public function buttonsColor()
    {
        return $this->configHelper->getConfig('buttons_color', $this->storeManager->getStore()->getId());
    }
}

