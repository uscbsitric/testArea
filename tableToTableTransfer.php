<?php
	
	function transferToPropertiesTableData($host, $username, $password, $dbname, $targetColumns = null, $sourceColumns = null, $targetTable, $sourceTable)
	{
		// rudimentary MySQL connection
		$connection = mysqli_connect($host, $username, $password, $dbname);
		// some data massage so the table will be transfer ready
		changeFromNullToEmptyString($connection, $sourceColumns, $sourceTable);
		
		$query = 'SET FOREIGN_KEY_CHECKS = 0;
					 INSERT INTO '.$targetTable.'(`'. implode("`,`", $targetColumns) .'`)
					 SELECT `'. implode("`,`", $sourceColumns) .'` FROM '.$sourceTable.';
					 SET FOREIGN_KEY_CHECKS = 1;
					';

		$result = mysqli_multi_query($connection, $query);

		return mysqli_error($connection);
	}

	function transferToPropertyPhotosTableData($host, $username, $password, $dbname, $targetColumns, $sourceColumns, $targetTable, $sourceTable)
	{
		$databaseConnection = mysqli_connect($host, $username, $password, $dbname);
		
		changeFromNullToEmptyString($databaseConnection, $sourceColumns, $sourceTable);
		
		$query = "SET FOREIGN_KEY_CHECKS = 0;
					 INSERT INTO $targetTable (`".implode("`,`", $targetColumns)."`)
					 SELECT `".implode("`,`", $sourceColumns)."` FROM $sourceTable ;
					 SET FOREIGN_KEY_CHECKS = 1;
					";

		$result = mysqli_multi_query($databaseConnection, $query);
		$errors = mysqli_error($databaseConnection);
		mysqli_close($databaseConnection);
		
		// this happens afterwards
		$imagePathColumn = 'url';
		$imageUploadPath = '/media/uploads/';
		appendUploadsDirPath($host, $username, $password, $dbname, $imagePathColumn, $imageUploadPath, $targetTable);

		return $errors;
	}

	function appendUploadsDirPath($host, $username, $password, $dbname, $imagePathColumn, $imageUploadPath, $tableName)
	{
		$databaseConnection = mysqli_connect($host, $username, $password, $dbname);
		$query = 'UPDATE '.$tableName.' set '.$imagePathColumn.' = CONCAT("'.$imageUploadPath.'", url)';
		$result = mysqli_query($databaseConnection, $query);
		
		return mysqli_error($databaseConnection);

	}


	function changeFromNullToEmptyString($databaseConnection, $sourceColumns, $sourceTable)
	{
		$column = '';

		foreach($sourceColumns as $sourceColumn)
		{
			$column = '`' .$sourceColumn. '`';
			$query  = "UPDATE $sourceTable SET $column = 0 WHERE $column is null";
			$queryResult = mysqli_query($databaseConnection, $query);
		}
	}


	function getPropertiesTableColumns()
	{
		// since the target table 'data_synd_platform.properties' has more columns than subject table 'rural_rural.items', they dont get matched up automatically,
		// so we have to specify what columns it will be matched up with the subject table
		$targetColumns = array('id',
									  'cid',
										'title',
										'price',
										'pdate',
										'sold',
										'description',
										'address',
										'city',
										'state',
										'zip_code',
										'featured',
										'active',
										'hits',
										'beds',
										'baths',
										'subdivision',
										'school_district',
										'year_built',
										'acres',
										'sqft',
										'lat',
										'long',
										'show_cities',
										'company_name',
										'contact_name',
										'contact_phone',
										'contact_email',
										'users_id',
										'notes',
										'expires',
										'style_id',
										'has_garage',
										'levels',
										'testimonial',
										'county',
										'sale_price',
										'mls_id',
										'photo_limit',
										'credit_id',
										'mls_url',
										'status',
										'private_financing',
										'fsbo',
										'region',
										'slug'
								  	);

			return $targetColumns;
	}

	function getSourceTableColumns($host, $username, $password, $dbname, $tablename)
	{
		$connection = mysqli_connect($host, $username, $password, $dbname);
		$query = "SELECT COLUMN_NAME  FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA='$dbname' AND TABLE_NAME= '$tablename' ";
		
		$result = mysqli_query($connection, $query);
		$sourceColumns = array();
	
		while($column = mysqli_fetch_assoc($result))
		{
			$sourceColumns[] = $column['COLUMN_NAME'];
		}

		return $sourceColumns;	
	}

	function getPropertyPhotosTableColumns($host, $username, $password, $dbname)
	{
		
		$targetColumns = array('id', 'ptype', 'property_id', 'caption', 'porder', 'url');
		
		return $targetColumns;
	}




	// sample usage
	$host 	 = 'localhost';
	$username = 'lhstage';
	$password = 'landhub$55';
	$dbname	 = 'data_synd_platform';
	$sourceDb = 'deleteMe';
	

	$targetColumns = getPropertiesTableColumns();
	$sourceTable = 'items';
	$sourceColumns = getSourceTableColumns($host, $username, $password, $sourceDb, $sourceTable);
	$targetTable = '`data_synd_platform`.`properties`';
	$sourceTable = '`deleteMe`.`items`';
	$transferResult = transferToPropertiesTableData($host, $username, $password, $dbname, $targetColumns, $sourceColumns, $targetTable, $sourceTable);

	
	
	
	$targetColumns = getPropertyPhotosTableColumns($host, $username, $password, $dbname);
	$sourceTable = 'photos';
	$targetTable = '`data_synd_platform`.`property_photos`';
	$sourceColumns = getSourceTableColumns($host, $username, $password, $sourceDb, $sourceTable);
	$sourceTable = '`deleteMe`.`photos`';
	$transferResult = transferToPropertyPhotosTableData($host, $username, $password, $dbname, $targetColumns, $sourceColumns, $targetTable, $sourceTable);	
	var_dump($transferResult);
?>