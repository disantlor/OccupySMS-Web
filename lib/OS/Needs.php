<?php
class OS_Needs
{
	const PUMP = 'pump'; 
	const CLEANUP = 'cleanup'; 
	const REPAIR = 'repair';
	const SUPPLIES = 'supplies';
	
	/**
	 * Return array of class constants
	 * @return array
	 */
	public static function listValidNeeds()
	{
		$refl = new ReflectionClass('OS_Needs');
		return $refl->getConstants();		
	}
}