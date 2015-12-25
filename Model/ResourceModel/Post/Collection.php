<?php
namespace Brokenspacebars\Blog\Model\ResourceModel\Post;

/**
*
*/
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

	protected function _construct()
	{
		$this->_init('Brokenspacebars\Blog\Model\Post', 'Brokenspacebars\Blog\Model\ResourceModel\Post');
	}
}