<?php
session_start();
// Kontroll
/*
echo "<pre>";
print_r($_SESSION);
echo"</pre>";
*/

// $name - kuidas ma hakkame elementi session süsteemi sees nimetama
function message($name = '', $message = '', $class= 'alert alert-success'){
    // Kui nimi ei ole tühi funktsioonis
    if(!empty($name)){
        // Kui funktsioonis sõnum ei ole tühi ning sessiooni parameeter name on tühi
        if(!empty($message) and empty($_SESSION[$name])){
            // Kui sessiooni parameeter name ei ole tühi
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name.'_class'])){
                unset($_SESSION[$name.'_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        } else if(empty($message) and !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div class="'.$class.'">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}