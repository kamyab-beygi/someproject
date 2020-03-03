<?php 
	
	namespace Classess\PhpVersion;

	class CheckPhpVersion

	{
		public function __construct()
		{
			if (!version_compare(phpversion(), "5.6.0", ">=")) { 
	 			die("You Cannot Use Our Website (PHP Version 5.6.0 Is Required) !");
			} 
    	}	

		

	}

?>