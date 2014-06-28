<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_DB_mssql_driver extends CI_DB_mssql_driver 
{
	function __construct($params)
	{
		parent::__construct($params);
		log_message('debug', 'Extended DB mssql driver class instantiated.');
	}

	function _limit($sql, $limit, $offset)
	{
		if($offset == 0)
		{
			return preg_replace('/(^\SELECT (DISTINCT)?)/i','\\1 TOP ' . $limit . ' ', $sql);
		}
		else
		{
			$OrderBy = "ORDER BY ";
			if(count($this->ar_orderby) > 0)
			{
				$OrderBy .= implode(', ', $this->ar_orderby);

				if($this->ar_order !== FALSE)
				{
					$OrderBy .= ($this->ar_order == 'desc') ? ' DESC' : ' ASC';
				}
			}
			else
			{
				$OrderBy .= "(SELECT 1)";
			}

			$sql = preg_replace('/(\\'. $OrderBy .'\n?)/i','', $sql);
			$sql = preg_replace('/(^\SELECT (DISTINCT)?)/i','\\1 ROW_NUMBER() OVER ('.$OrderBy.') AS rownum, ', $sql);
			return "SELECT * \nFROM (\n" . $sql . ") AS A \nWHERE A.rownum BETWEEN (" . ($offset + 1) . ") AND (" . ($offset + $limit) . ")";
		}
	}
}

?>