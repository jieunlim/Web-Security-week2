<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', [ 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  //My custom validation email
  // has_valid_email_format('test@test.com')
    function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    if (filter_var($value, FILTER_VALIDATE_EMAIL))
      return false; //valid
    else {
      return true; //invalid
    }
  }

  //My custom validation usersname
 // has_valid_username_format
 //contain only A-Z, a-z, 0-9, _
  function has_valid_username_format($value) {
    if(preg_match("/^[a-zA-Z0-9_]+$/",$value)){
      return true;
    }
    else return false;
  }

  //My custom validation  unique usersname
  // has_valid_unique username_format
  function has_unique_username_format($value) {
    $dup = mysql_query("SELECT username FROM users WHERE username='".$_POST['username']."'");
        if(mysql_num_rows($dup) >0){
            return false;}
        else return true;
  }

  //My custom validation phone number
  // has_valid_phonenumber_format
  //contain only 0-9, spaces, ()-
  function has_valid_phonenumber_format($value) {
    if(preg_match("/^[0-9)(-]+$/",$value)){
      return true;
    }
    else return false;
}
function has_valid_number_format($value) {
  if(preg_match("/^[0-9]+$/",$value)){
    return true;
  }
  else return false;
}

  //My custom validation for states
  function has_valid_name_format($value) {
    if(preg_match("/^[a-zA-Z]+$/",$value)){
      return true;
    }
    else return false;
  }

  function has_valid_code_format($value) {
    if(preg_match("/^[A-Z]+$/",$value)){
      return true;
    }
    else return false;
  }

  function has_valid_country_id_format($value) {
    if(preg_match("/^[0-9]+$/",$value)){
      return true;
    }
    else return false;
  }




?>
