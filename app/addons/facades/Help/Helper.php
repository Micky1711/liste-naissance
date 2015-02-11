<?php
namespace Help;
	class Helper 
	{


		public static  function month($month)
		{
			$montharray = array(
				"01" => "janvier",
				"02" => "février",
				"03" => "mars",
				"04" => "avril",
				"05" => "mai",
				"06" => "juin",
				"07" => "juillet",
				"08" => "août",
				"09" => "septembre",
				"10" => "octobre",
				"11" => "novembre",
				"12" => "décembre"
			);	
			return $montharray[$month];
		}

		public static function check_email($email) 
		{
	        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) 
	        {
	            return false;
	        }
	        $email_array = explode("@", $email);
	        $local_array = explode(".", $email_array[0]);
	        for ($i = 0; $i < sizeof($local_array); $i++) 
	        {
	            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
	                return false;
	            }
	        }
	        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) 
	        { 
	            $domain_array = explode(".", $email_array[1]);
	            if (sizeof($domain_array) < 2) 
	            {
	                return false; 
	            }
	            for ($i = 0; $i < sizeof($domain_array); $i++) 
	            {
	                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) 
	                {
	                    return false;
	                }
	            }
	        }
	        return true;
	    }

	    public static function generate_password($limit=12) 
	    {
		    $alphabet = "abcdefghjkmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ123456789";
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < $limit; $i++) 
		    {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}

		public static function datefr($datebdd, $long="1") 
		{	

			$dateexp = explode(" ",$datebdd);
			$date = $dateexp[0];
			$time = $dateexp[1];
			list($year, $month, $day) = explode("-", $date);
			if($long == 1)
				return $day." ".\Help\Facade\Helper::month($month)." ".$year." ".$time;
			elseif($long == 2)
				return $time;
			elseif($long == 4)
				return substr($time,0,5);
			else
				return $day." ".\Help\Facade\Helper::month($month)." ".$year;
		}

		public static function diff_time($date1, $date2, $time=0)
		{
			if($time==0)
			{
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);
			}
			return $date2-$date1;
		}

		public static function recursive_array_children($tab) 
		{

		  	$list = '<ul>';		 
			 foreach ($tab as $elem) 
			 {
			   $list .= '<li>'.$elem->title;

			   $list .= '</li>';
			}			 
			$list .= '</ul>';			 
			return $list;
		}

		public static function recursive_array($tab, $type,$order=0) 
		{	
			if($type == 'admin_categories')
			{
				if($order == 0)
			  		$list = '<ol class="sortable">'."\n";
			  	else
			  		$list = '<ol>';
				 foreach ($tab as $elem) 
				 {			 
				   	$list .= '<li id="list_'.$elem->id.'"><div><span class="disclose"><span></span></span>list_'.$elem->id.' :: '.$elem->title.'</div>'."\n";
	 					$list .= \Help\Facade\Helper::recursive_array($elem->children, $type,1);
				   	$list .= '</li>'."\n";		
				}		
				$list .= '</ol>'."\n";			 

			}

			return $list;

		}


}