<?php

/* Collection of Walker classes */

    /*
    
        wp_nav_menu()
        
        <div class="menu-container">
            <ul>    // start_lvl()
                <li><a><span> // start_el()
                    </a></span>
                    
                    <ul><?
                    </li> // end_el
                    
                <li><a>Link<a/></li>
                <li><a>Link<a/></li>
                <li><a>Link<a/></li>                
            </ul> // end_lvl()
        </div>
    */
    
class Walker_Nav_Primary extends Walker_Nav_menu {
    
    function start_lvl (&$output, $depth){ 
        $indent = str_repeat("\t",$depth);
        $submenu = ($depth > 0) ' sub-menu' : '';
    }
    
    function start_el(){
        
        
    }
    
    function end_el(){
        
    }
    
    function end_lvl(){
        
    }
    
}

?>