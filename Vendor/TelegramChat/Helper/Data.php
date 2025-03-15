<?php

namespace Vendor\TelegramChat\Helper;

use Magento\Framework\View\Asset\Repository;
use Magento\Framework\App\RequestInterface;

 /**
  * Class Data
  * @package Vendor\TelegramChat\Helper
  */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    protected $assetRepo;
    protected $request;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Repository $assetRepo,
        RequestInterface $request
    ) {
        $this->_storeManager = $storeManager;
        $this->assetRepo = $assetRepo;
        $this->request = $request;
        parent::__construct($context);
    }

    /**
     * Return module status
     *
     * @return string
     */

    public function getTGStatus()
    {
        return $this->scopeConfig->getValue(
            'tg_chat/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return phone number
     *
     * @return string
     */

    public function getTGPhone()
    {
        return $this->scopeConfig->getValue(
            'tg_chat/general/phone_number',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return message
     *
     * @return string
     */

    public function getTGMessage()
    {
        return $this->scopeConfig->getValue(
            'tg_chat/general/message',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return icon position
     *
     * @return string
     */

    public function getTGPosition()
    {
        return $this->scopeConfig->getValue(
            'tg_chat/general/position',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return relative position
     *
     * @return string
     */

    public function getTGRelPx()
    {
        return $this->scopeConfig->getValue(
            'tg_chat/general/rel_px',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return icon image url
     *
     * @return string
     */

    public function getTGIconUrl()
    {
        $telegramIcon = $this->scopeConfig
            ->getValue('tg_chat/general/vendor_telegram_chat_icon_upload', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if (!$telegramIcon) {
            $params = ['_secure' => $this->request->isSecure()];
            return $this->assetRepo->getUrlWithParams('Vendor_TelegramChat::images/telegram-chat-button.jpg', $params);
        }

        return $this->getMediaUrl(). 'vendor/telegram_chat_image/'.$telegramIcon;
    }

    /**
     * Return media path
     *
     * @return string
     */

    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
