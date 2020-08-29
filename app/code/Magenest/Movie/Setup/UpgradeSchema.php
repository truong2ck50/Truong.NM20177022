<?php

namespace Magenest\Movie\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.15') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            //Install new database table
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'actor Id'
            )->addColumn(
                'actor_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false
            ],
                'name'
            )->setComment(
                'magenest_actor'
            );
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
        if (version_compare($context->getVersion(), '2.0.15') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            //Install new database table
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'movie Id'
            )->addColumn(
                'movie_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false
            ],
                'name'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => true
            ],
                'description'
            )->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'nullable' => false
            ],
                'name'
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'unsigned' => true,
                'nullable' => false
            ],
                'director Id'
            )->addForeignKey(
                $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                'director_id',
                $installer->getTable('magenest_director'),
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment(
                'magenest_movie'
            );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
        if (version_compare($context->getVersion(), '2.0.15') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            //Install new database table
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'unsigned' => true,
                'nullable' => false
            ],
                'movie Id'
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'unsigned' => true,
                'nullable' => false
            ],
                'actor Id'
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'movie_id',
                $installer->getTable('magenest_movie'),
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'actor_id',
                $installer->getTable('magenest_actor'),
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment(
                'magenest_movie_actor'
            );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
        if (version_compare($context->getVersion(), '2.0.15') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();
            //Install new database table
            $table = $installer->getConnection()->newTable($installer->getTable('magenest_director')
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
                'director Id'
            )->addColumn(
                'director_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255, [
                'nullable' => false
            ],
                'name'
            )->setComment(
                'magenest_director'
            );
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }

        if (version_compare($context->getVersion(), '2.0.16' <0)) {
            $installer = $setup;
            $installer->startSetup();
            $tableName = $installer->getTable('magenest_actor');
            $fullTextIntex = ['actor_name'];

            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
            $installer->endSetup();
        }

        if (version_compare($context->getVersion(), '2.0.16') <0) {
            $installer = $setup;
            $installer->startSetup();
            $tableName = $installer->getTable('magenest_director');
            $fullTextIntex = ['director_name'];

            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
            $installer->endSetup();
        }

        if (version_compare($context->getVersion(), '2.0.17') <0) {
            $installer = $setup;
            $installer->startSetup();
            $tableName = $installer->getTable('magenest_movie');
            $fullTextIntex = array('movie_name', 'description'); // Column with fulltext index, you can put multiple fields


            $setup->getConnection()->addIndex(
                $tableName,
                $installer->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
            $installer->endSetup();
        }
    }
}
