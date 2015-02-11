<?php
namespace Cf;

class Cf {



	public static function fields()
	{
		$array[2] = 
					array(
						'main' =>
							array( 
								array( "section" => "section1", 
									"fields" => array(
										array('texte','name','text','', array()),
										array('texte2','name2','textarea','', array()),
									)
								),
								array( "section" => "section2", 
									"fields" => array(
										array('texte3','name3','radio','', array(), array(1=>"oui",0=>"non")),
										array('texte4','name4','checkbox','', array(), array(1=>"oui",0=>"non")),
									)
								),
								array( "section" => "section3", 
									"fields" => array(
										array('texte5','name5','select','', array(), \Post::where('type_id',1)->where('parent_id',0)->lists('title','id')),
										array('texte6','name6','multiple','', array(), array(1=>"oui",0=>"non")),
									)
								)
							),
						'sidebar' =>
							array( 
								array( "section" => "section1", 
									"fields" => array(
										array('texte','name7','text','', array()),
										array('texte2','name8','text','', array()),
									)
								),
								array( "section" => "section2", 
									"fields" => array(
										array('texte3','name9','text','', array()),
										array('texte4','name10','text','', array()),
									)
								)
							),
					);
				$array[4] = 
					array(
						'content' =>
							array( 
								array( "section" => "Réponse", 
									"fields" => array(
										array('reponse','reponse','textarea','', array("rows" =>"10")),
									)
								)
							)
						);


		return $array;
	}

	public static function custom_fields($location,$type_id,$meta="")
	{

		$array = Cf::fields();
		$form = '';
		if(isset($array[$type_id][$location] ))
		{
			foreach($array[$type_id][$location] AS $k => $v)
			{
				$form .= '
			        <div class="panel panel-primary">
			            <div class="panel-heading">
			                <i class="fa fa-bar-chart-o fa-fw"></i> '.$v['section'].'
			            </div>
			            <div class="panel-body">'."\n";
				foreach($v['fields'] AS $f)
				{
					$form .= '
					<div class="form-group">
	                    <label for="display" class="col-sm-12">'.$f[0].'</label>
	                    <div class="col-sm-12">';
	                   if($f[2] == "text")
	                	    $form .= ' <input type="text" value="'.@$meta[$f[1]].'" name="meta['.$f[1].']" class="form-control" />'."\n";
	               		elseif($f[2] == "textarea")
	                    	$form .= ' <textarea name="meta['.$f[1].']" class="form-control">'.@$meta[$f[1]].'</textarea>'."\n";
	                    elseif($f[2] == 'radio')
	                    {
	                    	foreach($f[5] AS $k => $v)
	                    	{
	                    		$form .= '<input type="radio" value="'.$k.'" name="meta['.$f[1].']"';
								if(isset($meta[$f[1]]) && $meta[$f[1]] != "")
	                    		{
		                    		if($k ==$meta[$f[1]])
		                    		{
		                    			$form .= ' checked="checked"';
		                    		}
	                    		}
	                    		$form .= '/> '.$v."\n";
	                    	}
	                    }
	                    elseif($f[2] == 'checkbox')
	                    {
	                    	foreach($f[5] AS $k => $v)
	                    	{
	                    		$form .= '<input type="checkbox" value="'.$k.'" name="meta['.$f[1].'][]"';;
								if(isset($meta[$f[1]]) && $meta[$f[1]] != "")
	                    		{
	                    			if(in_array($k ,json_decode($meta[$f[1]])))
		                    		{
		                    			$form .= ' checked="checked"';
		                    		}
	                    		}	
	                    		$form .= '/> '.$v."\n";
	                    	}
	                    }
	                    elseif($f[2] == 'select')
	                    {
	                    	$form .= '<select name="meta['.$f[1].']" class="form-control">'."\n";
	                    	foreach($f[5] AS $k => $v)
	                    	{
	                    		$form .= '<option value="'.$k.'"';
								if(isset($meta[$f[1]]) && $meta[$f[1]] != "")
	                    		{
		                    		if($k ==$meta[$f[1]])
		                    		{
		                    			$form .= ' selected="selected"';
		                    		}
	                    		}
	                    		$form .= '> '.$v.'</option>'."\n";
	                    	}
	                    	$form .= '</select>'."\n";
	                    }
	                    elseif($f[2] == 'multiple')
	                    {
	                    	$form .= '<select name="meta['.$f[1].'][]" class="form-control" multiple="multiple">'."\n";
	                    	foreach($f[5] AS $k => $v)
	                    	{
	                    		$form .= '<option value="'.$k.'"';
	                    		if(isset($meta[$f[1]]) && $meta[$f[1]] != "")
	                    		{
		                    		if(in_array($k ,json_decode($meta[$f[1]])))
		                    		{
		                    			$form .= ' selected="selected"';
		                    		}
	                    		}
	                    		$form .= '> '.$v.'</option>'."\n";
	                    	}
	                    	$form .= '</select>'."\n";
	                    }
	                $form .= '
	                    </div>
	                </div>
					'."\n";
				}	            
			    $form .='		               
			            </div>
			        </div>';
			}
		}
		return $form;
	}



}