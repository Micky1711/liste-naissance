<?php
namespace MyLib\TwitterBootstrap;
use Form;

class TWB 
{
	private function structure($message, $type, $class="primary", array $attr=array(), $tag='div', $glypgicon="")
	{
 		$structure = '<'.$tag.' class="'.$type.' '.$type.'-'.$class;
 		if(is_array($attr) && isset($attr['class']))
 		{
 			$structure .= ' '.$attr['class'];
 		}
 		$structure .= '"';
 		if(is_array($attr) && count($attr) > 0)
 		{
 			if(isset($attr['class']))
 				unset($attr['class']);
 			foreach($attr AS $k => $v)
 			{
 				$structure .= ' '.$k.'="'.$v.'"';
 			}
 		}
 		$structure .= '>';
 		if($glypgicon != "")
 		{
 			$structure .= '<span class="glyphicon glyphicon-'.$glypgicon.'"></span> ';
 		}
 		$structure .= $message.'</'.$tag.'>';
 		return $structure;
	}

 	public function alert($message, $class="primary", array $attr=array(), $tag='div', $glypgicon="")
 	{
 		return $this->structure($message, 'alert', $class, $attr, $tag, $glypgicon);
 	}

 	public function label($message, $class="primary", array $attr=array(), $tag='span', $glypgicon="")
 	{
 		return $this->structure($message, 'label', $class, $attr, $tag, $glypgicon);
 	}

 	public function badge($message, $class="primary", array $attr=array(), $tag='span', $glypgicon="")
 	{
 		return $this->structure($message, 'badge', $class, $attr, $tag, $glypgicon);
 	}



 	/* Backoffice */
 
 	private function admin_field($type, $name,$label,$value="",$attr=array(), $options=array(), $classopt="")
 	{
 		if($classopt != "")
 			$classopt = ' '.$classopt;
 		$attr['class'] = (isset($attr['class'])) ? 'form-control '.$attr['class'] : 'form-control';
 		$form = '
        <div class="form-group">
            <label for="'.$name.'" class="col-sm-12">'.$label.'</label>
            <div class="col-sm-12'.$classopt.'">';
            if($type == "text")
            {
            	$form .= Form::text($name, $value, $attr);
            }
            elseif($type == "textarea")
            {
            	$form .= Form::textarea($name, $value, $attr);	
            }
            elseif($type == "radio")
            {
            	foreach($options AS $ko => $vo)
            	{
			        if($ko == $value)
			        {
			        	$form .= Form::radio($name, $ko, true);
			        }
			        else
			        {
			        	$form .= Form::radio($name, $ko);
			        }
			        $form .= ' '.$vo.'<br />'; 
			    }     	
            }
            elseif($type == "checkbox")
            {
            	foreach($options AS $ko => $vo)
            	{
	            	if(in_array($ko, $value))
			        {
			        	$form .= Form::checkbox($name, $ko, true);
			        }
			        else
			        {
			        	$form .= Form::checkbox($name, $ko);
			        }    	
			        $form .= ' '.$vo.'<br />'; 
            	}
            }
            elseif($type == "select")
            {
            	$value = isset($attr['value']) ? $attr['value'] : '';
            	$form .= Form::select($name, $options, $value, $attr);
            }
            if(isset(\Session::get('errors_form')[$name][0]))
            {
				$form .= '<div class="alert alert-danger">'.\Session::get('errors_form')[$name][0].'</div>';
            }
                    
 			$form .= '
            </div>
        </div>';
        return $form;
 	}

 	public function admin_text($name,$label,$value="",$attr=array())
 	{
 		return $this->admin_field('text',$name,$label,$value,$attr);
 	}
  	public function admin_textarea($name,$label,$value="",$attr=array())
 	{
 		return $this->admin_field('textarea',$name,$label,$value,$attr);
 	}
 	public function admin_radio($name,$label,$value="",$attr=array(), $options=array(),$classopt="")
 	{
 		return $this->admin_field('radio',$name,$label,$value,$attr,$options,$classopt);
 	}
 	public function admin_checkbox($name,$label,$value="",$attr=array(), $options=array(),$classopt="")
 	{
 		return $this->admin_field('checkbox',$name,$label,$value,$attr,$options,$classopt);
 	}
 	public function admin_select($name,$label,$value="",$attr=array(), $options=array(),$classopt="")
 	{
 		return $this->admin_field('select',$name,$label,$value,$attr,$options,$classopt);
 	}
 	public function admin_multiple($name,$label,$value="",$attr=array(), $options=array(),$classopt="")
 	{
 		return $this->admin_field('checkbox',$name,$label,$value,$attr,$options,$classopt);
 	}
}