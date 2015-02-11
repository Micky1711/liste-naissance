<?php namespace MyLib\FormBuilder;

use \Illuminate\Html\FormBuilder as IlluminateFormBuilder;

class FormBuilder extends IlluminateFormBuilder {

    public function text($name, $value = null, $options = array())
    {
        $options = $options + array('id'=>"field-{$name}");

        return $this->input('text', $name, $value, $options);
    }

    public function yo($name)
    {
    	return '<input type="text" name="'.$name.'" id="'.$name.'" />';
    }


 	public function admin_field($type, $name,$label,$value="",$attr=array(), $options=array(), $classopt="")
 	{
 		if($classopt != "")
 			$classopt = ' '.$classopt;
 		$options['class'] = (isset($options['class'])) ? 'form-control '.$options['class'] : 'form-control';
 		$form = '
        <div class="form-group">
            <label for="'.$name.'" class="col-sm-12">'.$label.'</label>
            <div class="col-sm-12'.$classopt.'">';
            if($type == "text")
            {
            	$form .= $this->input('text', $name, $value, $options);
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

}