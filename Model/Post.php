<?php
namespace Brokenspacebars\Blog\Model;

use Brokenspacebars\Blog\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
*
*/
class Post extends \Magento\Framework\Model\AbstractModel implements PostInterface,IdentityInterface
{
	// Post's statuses
	const STATUS_ENABLED 	= 1;
	const STATUS_DISABLED 	= 0;
	// Cache tag
	const CACHE_TAG			= 'blog_post';

	protected $_cacheTag	= 'blog_post';
	protected $_eventPrefix	= 'blog_post';

	// Initialize resource model
	protected function _construct()
	{
		$this->_init('Brokenspacebars\Blog\Model\ResourceModel\Post');
	}

	// Use it to check if post with that URL_KEY exists
	public function checkUrlKey($url_key)
	{
		return $this->_getResource()->checkUrlKey($url_key);
	}

	// Use it to restrict statuses that can be used
	public function getAvailableStatuses()
	{
		return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
	}

	// Getters
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getId()
	{
		return $this->getData(self::POST_ID);
	}

	public function getUrlKey()
	{
		return $this->getData(self::URL_KEY);
	}

	public function getTitle()
	{
		return $this->getData(self::TITLE);
	}

	public function getContent()
	{
		return $this->getData(self::CONTENT);
	}

	public function getCreationTime()
	{
		return $this->getData(self::CREATION_TIME);
	}

	public function getUpdateTime()
	{
		return $this->getData(self::UPDATE_TIME);
	}

	public function isActive()
	{
		return $this->getData(self::IS_ACTIVE);
	}

	// Setters
	public function setId($id)
	{
		return $this->setData(self::POST_ID, $id);
	}

	public function setUrlKey($url_key)
	{
		return $this->setData(self::URL_KEY, $url_key);
	}

	public function setTitle($title)
	{
		return $this->setData(self::TITLE, $title);
	}

	public function setContent($content)
	{
		return $this->setData(self::CONTENT, $content);
	}

	public function setCreationTime($creation_time)
	{
		return $this->setData(self::CREATION_TIME, $creation_time);
	}

	public function setUpdateTime($update_time)
	{
		return $this->setData(self::UPDATE_TIME, $update_time);
	}

	public function setIsActive($is_active)
	{
		return $this->setData(self::IS_ACTIVE, $is_active);
	}
}