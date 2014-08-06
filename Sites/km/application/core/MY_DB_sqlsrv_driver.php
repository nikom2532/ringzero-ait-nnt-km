<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_DB_sqlsrv_driver extends CI_DB_sqlsrv_driver 
{
	/**
	 * Constructor.  Accepts one parameter containing the database
	 * connection settings.
	 *
	 * @param array
	 */
	function __construct($param)
	{
		parent::__construct($param);
		log_message('debug', 'Extended DB sqlsrv driver class instantiated.');
	}
	
	// --------------------------------------------------------------------

	/**
	 * Limit string
	 *
	 * Generates a platform-specific LIMIT clause
	 *
	 * @access	public
	 * @param	string	the sql query string
	 * @param	integer	the number of rows to limit the query to
	 * @param	integer	the offset value
	 * @return	string
	 */
	/*function _limit($sql, $limit, $offset)
	{
		if($offset == 0)
		{
			return preg_replace('/(^\SELECT (DISTINCT)?)/i','\\1 TOP ' . $limit . ' ', $sql);
		}
		else
		{
			$order_by = "ORDER BY ";
			if(count($this->ar_orderby) > 0)
			{
				$order_by .= implode(', ', $this->ar_orderby);

				if($this->ar_order !== FALSE)
				{
					$order_by .= ($this->ar_order == 'desc') ? ' DESC' : ' ASC';
				}
			}
			else
			{
				$order_by .= "(SELECT 1)";
			}

			$sql = preg_replace('/(\\'. $order_by .'\n?)/i','', $sql);
			$sql = preg_replace('/(^\SELECT (DISTINCT)?)/i','\\1 ROW_NUMBER() OVER ('.$order_by.') AS rownum, ', $sql);
			return "SELECT * \nFROM (\n" . $sql . ") AS A \nWHERE A.rownum BETWEEN (" . ($offset + 1) . ") AND (" . ($offset + $limit) . ")";
		}*/

		/**
		 * Limit string
		 *
		 * Generates a platform-specific LIMIT clause
		 *
		 * @access	public
		 * @param	string	the sql query string
		 * @param	integer	the number of rows to limit the query to
		 * @param	integer	the offset value
		 * @return	string
		 */
		function _limit($sql, $limit, $offset)
		{

			$sql = str_replace("\n", " ", $sql);

			$orderby = stristr($sql, 'ORDER BY');

			if ( ! $orderby)
			{
				$over = 'ORDER BY (SELECT 0)';
			}
			else
			{
				$over = preg_replace('/\"[^,]*\".\"([^,]*)\"/i', '"inner_tbl"."$1"', $orderby);
			}

			// Remove ORDER BY clause from $sql
			$sql = preg_replace('/\s+ORDER BY(.*)/', '', $sql);

			// Add ORDER BY clause as an argument for ROW_NUMBER()
			$sql = 'SELECT ROW_NUMBER() OVER (' . $over . ') AS ZEND_DB_ROWNUM, * FROM (' . $sql. ') AS inner_tbl';

			//$start = $offset + 1;
			//$end = $offset + $limit;

			$sql = 'WITH outer_tbl AS (' . $sql . ') SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ' . ($offset + 1) . ' AND ' . ($offset + $limit);

			return $sql;
		}

	// --------------------------------------------------------------------

}

?>