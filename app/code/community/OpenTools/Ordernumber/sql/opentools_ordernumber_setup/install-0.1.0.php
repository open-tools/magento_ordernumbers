<?php
/**
 * Ordernmber installation script
 * @author OpenTools
 */
/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

/**
 * Create table opentools_ordernumber
 */
$connection = $installer->getConnection();
$tablename = $installer->getTable('opentools_ordernumber/ordernumber');

if (!$connection->isTableExists($tablename)) {

	$table = $connection
		->newTable($tablename)
		->addColumn('ordernumber_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
			'unsigned' => true,
			'identity' => true,
			'nullable' => false,
			'primary'  => true,
		), 'Ordernumber id')
		->addColumn('number_type',   Varien_Db_Ddl_Table::TYPE_TEXT,      63, array('nullable'=> false),                  'Number Type')
		->addColumn('number_scope',  Varien_Db_Ddl_Table::TYPE_TEXT,      20, array('nullable'=> true, 'default'=>''),    'Number Scope')
		->addColumn('number_format', Varien_Db_Ddl_Table::TYPE_TEXT,     255, array('nullable'=> true, 'default'=>''),    'Number Format')
		->addColumn('count',         Varien_Db_Ddl_Table::TYPE_INTEGER, null, array('unsigned'=>true, 'nullable'=>false), 'Counter')
		->addIndex($installer->getIdxName(
				$tablename,
				array('number_type', 'number_scope', 'number_format'),
				Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
			),
			array('number_type', 'number_scope', 'number_format'),
			array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
		)
		->setComment('Ordernumber Counter Table');
	// TODO: drop table if exists!
	$installer->getConnection()->createTable($table);
} else {
	// Table already exists, don't do anything (but also don't try to create the table again)
}
