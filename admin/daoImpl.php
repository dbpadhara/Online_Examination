<?php
include_once './config/dbConnection.php';

class daoImpl extends dbConnection{

	public function insert($tablename,$data) {
		
		$con=$this -> getConnect();
		$fields='';
		$values='';
		$count=0;

		foreach ($data as $key => $value) {
			if ($count == 0) {
				$fields .= $key;
				$values .= "'".$value."'";
			} else {
				$fields .= ", ".$key;
				$values .= ", '".$value."'";
			}

			$count++;
		}

		$insertQuery="INSERT INTO $tablename($fields) VALUES ($values)";
		$insert = mysqli_query($con,$insertQuery);
		mysql_close();
		return $insert;
	}

	public function select($tableName, $data = "*", $where='', $other= '')
	{
		$con = $this -> getConnect();

		if ($where != "") {
			$where = "WHERE ".$where;
		}

		$selectQuery = "SELECT $data FROM $tableName $where $other";
		$select = mysqli_query($con, $selectQuery);
		mysqli_close($con);

		if (mysqli_num_rows($select) > 0) {
			return $select;
		}
		else
		{
			return '0';
		}
	}
}
?>