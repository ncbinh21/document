<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TTV\TermCondition\Block;

use Magento\Customer\Block\Form\Register;

/**
 * Class RegisterCondition
 * @package TTV\TermCondition\Block
 */
class RegisterCondition extends Register
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Directory\Helper\Data $directoryHelper, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\App\Cache\Type\Config $configCacheType, \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory, \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory, \Magento\Framework\Module\Manager $moduleManager, \Magento\Customer\Model\Session $customerSession, \Magento\Customer\Model\Url $customerUrl, array $data = [], \TTV\TermCondition\Helper\Data $helper)
    {
        parent::__construct($context, $directoryHelper, $jsonEncoder, $configCacheType, $regionCollectionFactory, $countryCollectionFactory, $moduleManager, $customerSession, $customerUrl, $data);
        $this->_helper = $helper;
    }

    /**
     * @return mixed|null
     */
    public function enable()
    {
        $check = $this->_helper->getEnable();
        if ($check == 1) {
            return $this->_helper->getTextAlign();
        } else {
            return null;
        }
    }
}