<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This function used to run the validator and return validation message if any
 * @param  {formvalidator instance}
 */
if(!function_exists('runFormValidator'))
{
    function runFormValidator($form_validation)
    {
        if ($form_validation->run() == FALSE)
        {
            $arr = explode(",", str_replace("\n", ",", strip_tags(validation_errors())));
            return [
                'status' => false,
                'message' => $arr[0]
            ];
        }
        return true;
    }
}