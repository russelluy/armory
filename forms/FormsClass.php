<?php 
/**********************************************************/
/*            CODE DESIGN FOR PROWEAVERIANS               */ 
/*            CODE BY: DEVELOPERS TEAM                    */
/*            Created: NOVEMBER 24, 2009                  */
/*            Version: 1.0.4                              */
/*            Last Updated: March 23, 2010                */
/**********************************************************/
class FormsClass {
	var $optMonth = array('January','February','March','April','May','June','July','August','September','October','November','December');
	 
	//fields
	// ex. $input->fields('Total','width: 50px;','Total','readonly="readonly" onkeypress="test" ondblclick="test"');
	function fields($name='',$style='',$id='',$attrib='') {
		$fldname = str_replace(' ', '_', $name);
		$value = '';
		if(isset($_SESSION[$fldname])) $value = $_SESSION[$fldname];
		if(isset($_POST[$fldname])) $value = $_POST[$fldname];
		$input = '<input type="text" name="'.$fldname.'" style="'.$style.'" value="'.$value.'" id="'.$id.'" '.$attrib.'>';
		echo $input;
	}
	
	//textarea
	// ex. $input->textarea('Total','width: 50px;','Total','readonly="readonly" onkeypress="test" ondblclick="test"');
	function textarea($name='',$style='',$id='',$attrib='') {
		$fldname = str_replace(' ', '_', $name);
		$value = '';
		if(isset($_SESSION[$fldname])) $value = $_SESSION[$fldname];
		if(isset($_POST[$fldname])) $value = $_POST[$fldname];
		$txtarea = '<textarea name="'.$fldname.'" style="'.$style.'" id="'.$id.'" '.$attrib.'>'.$value.'</textarea>';
		echo $txtarea;
	}
	
	//select with script
	// ex. $input->select('Small_Box','width:100px;',$box,'Small_Box','onchange="getTotal();" onkeypress="test" ondblclick="test"');
	function select($name='',$style='',$optName='',$id='',$attrib='') {
		$n = '';
		$option = '';
		$fldname = str_replace(' ', '_', $name);
		if(isset($_SESSION[$fldname])) $n = $_SESSION[$fldname];
		if(isset($_POST[$fldname])) $n = $_POST[$fldname]; 
		foreach($optName as $optVal){
			$cndtn = ($n == $optVal)? 'selected="selected"' : '';
			$option .= '<option value="'.$optVal.'" '.$cndtn.'>'.$optVal.'</option>';		
		}
		$select = '<select name="'.$fldname.'" style="'.$style.'" id="'.$id.'" '.$attrib.'>'.$option.'</select>';
		echo $select;
	}
	
	//radio
	// ex. $input->radio($input->radio('Example',array('Yes','No'),'Example','readonly="readonly" onkeypress="test" ondblclick="test"');
	function radio($name='',$value='',$id='',$attrib=''){
		$n = ''; 
		$radio = '';
		$fldname = str_replace(' ', '_', $name);
		if(isset($_SESSION[$fldname])) $n = $_SESSION[$fldname];
		if(isset($_POST[$fldname])) $n = $_POST[$fldname]; 
		foreach($value as $radVal){
			$cndtn = ($n == $radVal)? 'checked="checked"' : '';
			$radio .= '<input type="radio" name="'.$fldname.'" value="'.$radVal.'" '.$cndtn.' id="'.$id.'" '.$attrib.'>'.$radVal;
		}
		echo $radio;
	}
	
	//checkbox
	// ex. $input->chkbox($are_you_licensed_in_the_state_of_state?',array('Yes','No'),'Example','readonly="readonly" onkeypress="test" ondblclick="test"');
	function chkbox($name='',$Val='',$id='',$attrib=''){
	  $fldname = str_replace(' ', '_', $name);
	  $ctr = 1;
	  $brekz = 0;
	  $chckbox = '<table border="0" cellpadding="0" cellspacing="0"><tr>';
	  foreach($Val as $chckVal){
	   $cndtn = '';
	   if(isset($_SESSION[$fldname.'_'.$ctr]))
		$cndtn = ($_SESSION[$fldname.'_'.$ctr] == $chckVal)? 'checked="checked"' : '';
	   if(isset($_POST[$fldname.'_'.$ctr]))
		$cndtn = ($_POST[$fldname.'_'.$ctr] == $chckVal)? 'checked="checked"' : '';
	   
	   if($brekz == 4) {
		$chckbox .= '</tr><tr>';
		$brekz = 0; 
	   }
	   $chckbox .= '<td><input type="checkbox" name="'.$fldname.'_'.$ctr.'" value="'.$chckVal.'" '.$cndtn.' id="'.$id.'" '.$attrib.'>'.$chckVal.'</td>'."\n";
	   
	   $brekz++;
	   
	   $ctr++;
	  }
	  $chckbox .= "</tr></table>";
	  
	  echo $chckbox;
	 }
	
	function chkbox2($name='',$Val='',$id='',$attrib=''){
	  $fldname = str_replace(' ', '_', $name);
	  $ctr = 1;
	  $brekz = 0;
	  $chckbox = '<table border="0" cellpadding="0" cellspacing="0"><tr>';
	  foreach($Val as $chckVal){
	   $cndtn = '';
	   if(isset($_SESSION[$fldname.'_'.$ctr]))
		$cndtn = ($_SESSION[$fldname.'_'.$ctr] == $chckVal)? 'checked="checked"' : '';
	   if(isset($_POST[$fldname.'_'.$ctr]))
		$cndtn = ($_POST[$fldname.'_'.$ctr] == $chckVal)? 'checked="checked"' : '';
	   
	   if($brekz == 4) {
		$chckbox .= '</tr><tr>';
		$brekz = 0; 
	   }
	   $chckbox .= '<td><input type="checkbox" name="'.$fldname.'_'.$ctr.'" value="'.$chckVal.'" '.$cndtn.' id="'.$id.'" '.$attrib.'>'.$chckVal.'</td>'."\n";
	   
	   $brekz++;
	   
	   $ctr++;
	  }
	  $chckbox .= "</tr></table>";
	  
	  echo $chckbox;
	 }
	
	//buttons
	//ex. $input->buttons('submit','submit','Submit','','Submit','onchange="test" onkeypress="test" ondblclick="test"');
	function buttons($type='',$name='',$value='',$style='',$id='',$attrib='') {
		$button = '<input type="'.$type.'" name="'.$name.'" style="'.$style.'" value="'.$value.'" id="'.$id.'" '.$attrib.'>';
		echo $button;
	}
	
	//select option for months $input->selectMonth('Months','width: 80px; font-size:11px;');
	function selectMonth($name='',$style='') {
		$cndtn = '';
		$fldname = str_replace(' ', '_', $name);	
		$curMon = date('F',time());
		$option = '<option value="'.$curMon.'">'.$curMon.'</option>';

		foreach($this->optMonth as $optkey => $optVal){
			if(isset($_SESSION[$fldname]))
				$cndtn = ($_SESSION[$fldname] == $optVal)? 'selected="selected"' : '';
			if(isset($_POST[$fldname]))
				$cndtn = ($_POST[$fldname] == $optVal)? 'selected="selected"' : '';
			$option .= '<option value="'.$optVal.'" '.$cndtn.'>'.$optVal.'</option>';		
		}
		$selectMonth = '<select name="'.$fldname.'" style="'.$style.'">'.$option.'</select>';
		echo $selectMonth;
	}
	
	//select option for days $input->selectDays('Day_Birth','',array(30));
	function selectDays($name='',$style='') {
		$cndtn = '';
		$fldname = str_replace(' ', '_', $name);	
		$numdays = array(date('t'));
		$curMon = date('F',time());
		$curDay = date('j',time());
		$optDays = '<option value="'.$curDay.'">'.$curDay.'</option>';	
		foreach($numdays as $optkey => $optVal){
			if($optkey == $curMon){
				for($days=1;$days<=$optVal;$days++){
					if(isset($_SESSION[$fldname]))
						$cndtn = ($_SESSION[$fldname] == $days)? 'selected="selected"' : '';
					if(isset($_POST[$fldname]))
						$cndtn = ($_POST[$fldname] == $days)? 'selected="selected"' : '';
					if($days<=9)
						$days = 0 . $days;
					$optDays .= '<option value="'.$days.'" '.$cndtn.'>'.$days.'</option>';	
				}	
			}			
		}
		$selectDays = '<select name="'.$fldname.'" style="'.$style.'">'.$optDays.'</select>';
		echo $selectDays;
	}
	
	//select option for years
	function selectYears($name='',$style='',$start,$upto) {	
		$cndtn = '';
		$fldname = str_replace(' ', '_', $name);	
		$curYr = date('Y',time());
		$optYears = '<option value="'.$curYr.'">'.$curYr.'</option>';
		for($year=$start;$year<=$upto;$year++){
			if(isset($_SESSION[$fldname]))
				$cndtn = ($_SESSION[$fldname] == $year)? 'selected="selected"' : '';
			if(isset($_POST[$fldname]))	
				$cndtn = ($_POST[$fldname] == $year)? 'selected="selected"' : '';
			$optYears .= '<option value="'.$year.'" '.$cndtn.'>'.$year.'</option>';	
		}
		$selectYears = '<select name="'.$fldname.'" style="'.$style.'">'.$optYears.'</select>';
		echo $selectYears;
	}
	
	//file
	function files($name='') {
		$fldname = str_replace(' ', '_', $name);	
		$file = '<input name="'.$fldname.'" type="file" />';
		echo $file;
	}
	
}
?>