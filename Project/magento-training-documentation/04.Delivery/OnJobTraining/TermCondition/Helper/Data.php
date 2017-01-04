<?php

namespace TTV\TermCondition\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * $const enable
     */
    CONST ENABLE = 'customer/term_and_condition_group/term_and_condition';
    /**
     * $const text
     */
    CONST TEXT_ALIGN = 'customer/term_and_condition_group/term_check';

    public function __construct(\Magento\Framework\App\Helper\Context $context,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->_scopeConfig->getValue(self::ENABLE);
    }

    /**
     * @return mixed
     */
    public function getTextAlign()
    {
        return $this->_scopeConfig->getValue(self::TEXT_ALIGN);
    }
}