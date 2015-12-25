<?php
namespace Brokenspacebars\Blog\Model\ResourceModel;

/**
* Post mysql resource
*/
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

	protected $_date;

	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context,
		\Magento\Framework\Stdlib\DateTime $date,
		$resourcePrefix = null
	)
	{
		parent::__construct($context. $resourcePrefix);
		$this->_date = $date;
	}

	protected function _construct()
	{
		$this->_init('brokenspacebars_blog_post', 'post_id');
	}

	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		if (!$this->isValidPostUrlKey($object)) {
			throw new \Magento\Framework\Exception\LocalizedException(
				__('The post URL key contains capital letters or disallowed symbols.')
			);
		}
		if (!$this->isNumericPostUrlKey($object)) {
			throw new \Magento\Framework\Exception\LocalizedException(
				__('The post URL key cannot be made of only numbers.')
			);
		}

		if ($object->isObjectNew() && !$object->hasCreationTime()) {
			$object->setCreationTime($this->_date->gmtDate());
		}

		$object->setUpdateTime($this->_date->gmtDate());

		return parent::_beforeSave($object);
	}

	public function load(
		\Magento\Framework\Model\AbstractModel $object,
		$value,
		$field = null
	)
	{
		if (!is_numeric($value) && is_null($field)) {
			$field = 'url_key';
		}

		return parent::load($object, $value, $field);
	}

	protected function _getLoadSelect($field, $value, $object)
	{
		$select = parent::_getLoadSelect($field, $value, $object);

		$select->where(
			'is_active = ?',
			1
		)->limit(
			1
		);

		return $select;
	}

	protected function _getLoadByUrlKeySelect($url_key, $is_active = null)
	{
		$select = $this->getConnection()->select()->from(
			['bp' => $this->getMainTable()]
		)->where(
			'bp.url_key = ?',
			$url_key
		);

		if (!is_null($isActive)) {
			$select->where('bp.is_active = ?', $isActive);
		}

		return $select;
	}

	protected function isNumericPostUrlKey(\Magento\Framework\Model\AbstractModel $object)
	{
		return preg_match('/^[0-9]+$/', $object->getData('url_key'));
	}

	protected function isValidPostUrlKey(\Magento\Framework\Model\AbstractModel $object)
	{
		return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('url_key'));
	}

	public function checkUrlKey($url_key)
	{
		$select = $this->_getLoadByUrlKeySelect($url_key, 1);
		$select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.post_id')->limit(1);

		return $this->getConnection()->fetchOne($select);
	}
}