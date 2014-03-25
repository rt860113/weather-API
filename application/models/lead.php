<?php
	/**
	*  model lead
	*/
	class Lead extends Datamapper
	{
		public $has_one=array("site");
		function __construct($id=NULL)
		{
			parent::__construct($id);
		}
	}
?>