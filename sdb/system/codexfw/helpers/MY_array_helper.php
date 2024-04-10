<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Philip Sturgeon
 * @link		http://www.codeigniter.com/user_guide/helpers/text_helper.html
 */

// ------------------------------------------------------------------------

function array_sorter($array, $index, $order = 'asc', $nat_sort = FALSE, $case_sensitive = FALSE)
{
	if(is_array($array) && count($array) > 0)
	{
		foreach (array_keys($array) as $key)
		{
			$temp[$key]=$array[$key][$index];
			if (! $nat_sort)
			{
				($order == 'asc') ? asort($temp) : arsort($temp);
			} 
			else
			{
				($case_sensitive) ? natsort($temp) : natcasesort($temp);
			}
			if ($order != 'asc') $temp = array_reverse($temp,TRUE);
		}
		foreach(array_keys($temp) as $key)
		{
			(is_numeric($key)) ? $sorted[] = $array[$key] : $sorted[$key] = $array[$key];
		}
		return $sorted;
   }
	return $array;
}


function array_object_merge(&$object, $array)
{
	is_array($array) OR $array = get_object_vars($array);
	
	foreach ($array as $key => $value)
	{
        $object->{$key} = $value;
	}
}

function array_for_select()
{
	$args =& func_get_args();

	$return = array();
	
	switch(count($args))
	{
		case 3:
			foreach ($args[0] as $itteration):
				if(is_object($itteration)) $itteration = (array) $itteration;
		        $return[$itteration[$args[1]]] = $itteration[$args[2]];
		    endforeach;
		break;
		
		case 2:
			foreach ($args[0] as $key => $itteration):
				if(is_object($itteration)) $itteration = (array) $itteration;
		        $return[$key] = $itteration[$args[1]];
		    endforeach;
		break;
		
		case 1:
			foreach ($args[0] as $itteration):
		        $return[$itteration] = $itteration;
		    endforeach;
		break;
		
		default:
			return FALSE;
	}
    
    return $return;
}

function html_to_assoc($html_array)
{
	$keys = array_keys($html_array);

	if (!isset($keys[0]))
	{
		return array();
	}

	$total = count(current($html_array));

	$array = array();

	for ($i = 0; $i < $total; $i++)
	{
		foreach ($keys as $key)
		{
			$array[$i][$key] = $html_array[$key][$i];
		}
	}

	return $array;
}

function InArray($array, $key, $value)
{
    # check if an item is in the cart
    foreach($array as $k => $v) {
        if($v[$key] == $value) {
            return TRUE;
        }
    }
}