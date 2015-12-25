<?php
namespace Brokenspacebars\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framwork\DB\Dbl\Table;

/**
 *
 */
class InstallSchema extends InstallSchemaInterface
{

    function isntall(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('brokenspacebars_blog_post'))
            ->addColumn(
                'post_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Post ID'
            )
            ->addColumn(
                'url_key',
                Table::TYPE_TEXT,
                100,
                ['nullable' => true, 'default' => null]
            )
            ->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Blog Title'
            )
            ->addColumn(
                'content',
                Table::TYPE_TEXT,
                '2M',
                [],
                'Blog Content'
            )
            ->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Post Active?'
            )
            ->addColumn(
                'creation_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Creation Time'
            )
            ->addColumn(
                'update_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Update Time'
            )
            ->addIndex($installer->getIdxName('blog_post', ['url_key']), ['url_key'])
            ->setComment('Blog Posts');

            $installer->getConnection()->createTable($table);
            $isntaller->endSetup();
    }
}
