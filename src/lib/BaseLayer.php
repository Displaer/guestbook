<?php
namespace lib;


/**
 * Class BaseLayer
 * 
 * @author Dilshod Sanginov (DELL) <prodilshod@gmail.com>
 * Created 1/21/14, 10:00 PM
 * Copyright dit
 */
class BaseLayer
{
    // ----------------------------------------------------------------------
    // Properties
    // ----------------------------------------------------------------------

    // ----------------------------------------------------------------------
    // Setters
    // ----------------------------------------------------------------------

    // ----------------------------------------------------------------------
    // Public Methods
    // ----------------------------------------------------------------------

    // ----------------------------------------------------------------------
    // Filter Methods
    // ----------------------------------------------------------------------

    public function senseFirsAction($get, $post)
    {
        if (isset($post['faction'])) {
            return $post['faction'];
        } else {
            if (isset($get['faction'])) {
                return $get['faction'];
            } else {
                return "show";
            }
        }
    }

    // ----------------------------------------------------------------------
    // Sense Methods
    // ----------------------------------------------------------------------

}
