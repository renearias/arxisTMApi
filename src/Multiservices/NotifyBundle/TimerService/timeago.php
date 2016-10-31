<?php
namespace Multiservices\NotifyBundle\TimerService;
/**
 * Description of timeago
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class timeago
{
    var $tiempo;
    var $color;
    
    function __construct($timestamp)
    {
        $this->tiempo=$this->fechainteligente($timestamp);
        $this->color=$this->color($timestamp);
    }
    function fechainteligente($timestamp) 
     {
        if (!is_int($timestamp)and !is_numeric($timestamp)) 
	{
		$timestamp=strtotime($timestamp, 0);
	}
        $diff = time() - $timestamp;
	if ($diff <= 0) return 'Ahora';
	else if ($diff < 60) return "hace ".$this->ConSoSinS(floor($diff), ' segundo(s)');
	else if ($diff < 60*60) return "hace ".$this->ConSoSinS(floor($diff/60), ' minuto(s)');
	else if ($diff < 60*60*24) return "hace ".$this->ConSoSinS(floor($diff/(60*60)), ' hora(s)');
	else if ($diff < 60*60*24*30) return "hace ".$this->ConSoSinS(floor($diff/(60*60*24)), ' día(s)');
	else if ($diff < 60*60*24*30*12) return "hace ".$this->ConSoSinS(floor($diff/(60*60*24*30)), ' mes(es)');
	else return "hace ".$this->ConSoSinS(floor($diff/(60*60*24*30*12)), ' año(s)');
     }
     function color($timestamp) 
     {
	if (!is_int($timestamp)) 
	{
		$timestamp=strtotime($timestamp, 0);
	}
	$diff = time() - $timestamp;
	if ($diff <= 0) return 'orange';
	else if ($diff < 60) return "orange";
	else if ($diff < 60*60) return "green";
	else if ($diff < 60*60*24) return "blue";
	else if ($diff < 60*60*24*30) return "grey";
	else if ($diff < 60*60*24*30*12) return "grey";
	else return "grey";
     }
     function ConSoSinS($val, $sentence) 
     {
	if ($val > 1) return $val.str_replace(array('(s)','(es)'),array('s','es'), $sentence); 
	else return $val.str_replace('(s)', '', $sentence);
    }
    
}

