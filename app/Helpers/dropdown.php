<?php
function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
{
    $defaults = array();

    if (is_array($data)) {
        if (isset($data['selected'])) {
            $selected = $data['selected'];
            unset($data['selected']); // select tags don't have a selected attribute
        }

        if (isset($data['options'])) {
            $options = $data['options'];
            unset($data['options']); // select tags don't use an options attribute
        }
    } else {
        $defaults = array('name' => $data);
    }

    is_array($selected) or $selected = array($selected);
    is_array($options) or $options = array($options);

    // If no selected state was submitted we will attempt to set it automatically
    if (empty($selected)) {
        if (is_array($data)) {
            if (isset($data['name'], $_POST[$data['name']])) {
                $selected = array($_POST[$data['name']]);
            }
        } elseif (isset($_POST[$data])) {
            $selected = array($_POST[$data]);
        }
    }

    $extra = _attributes_to_string($extra);

    $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

    $form = '<select ' . rtrim(_parse_form_attributes($data, $defaults)) . $extra . $multiple . ">\n";

    foreach ($options as $key => $val) {
        $key = (string) $key;

        if (is_array($val)) {
            if (empty($val)) {
                continue;
            }

            $form .= '<optgroup label="' . $key . "\">\n";

            foreach ($val as $optgroup_key => $optgroup_val) {
                $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                $form .= '<option value="' . html_escape($optgroup_key) . '"' . $sel . '>'
                    . (string) $optgroup_val . "</option>\n";
            }

            $form .= "</optgroup>\n";
        } else {
            $form .= '<option value="' . html_escape($key) . '"'
                . (in_array($key, $selected) ? ' selected="selected"' : '') . '>'
                . (string) $val . "</option>\n";
        }
    }

    return $form . "</select>\n";
}

if (!function_exists('_parse_form_attributes')) {
    /**
     * Parse the form attributes
     *
     * Helper function used by some of the form helpers
     *
     * @param	array	$attributes	List of attributes
     * @param	array	$default	Default values
     * @return	string
     */
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes)) {
            foreach ($default as $key => $val) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if (count($attributes) > 0) {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';

        foreach ($default as $key => $val) {
            if ($key === 'value') {
                $val = html_escape($val);
            } elseif ($key === 'name' && !strlen($default['name'])) {
                continue;
            }

            $att .= $key . '="' . $val . '" ';
        }

        return $att;
    }
}

if (!function_exists('_attributes_to_string')) {
    /**
     * Attributes To String
     *
     * Helper function used by some of the form helpers
     *
     * @param	mixed
     * @return	string
     */
    function _attributes_to_string($attributes)
    {
        if (empty($attributes)) {
            return '';
        }

        if (is_object($attributes)) {
            $attributes = (array) $attributes;
        }

        if (is_array($attributes)) {
            $atts = '';

            foreach ($attributes as $key => $val) {
                $atts .= ' ' . $key . '="' . $val . '"';
            }

            return $atts;
        }

        if (is_string($attributes)) {
            return ' ' . $attributes;
        }

        return FALSE;
    }
}

if (!function_exists('html_escape')) {
    /**
     * Returns HTML escaped variable.
     *
     * @param	mixed	$var		The input string or array of strings to be escaped.
     * @param	bool	$double_encode	$double_encode set to FALSE prevents escaping twice.
     * @return	mixed			The escaped string or array of strings as a result.
     */
    function html_escape($var, $double_encode = TRUE)
    {
        if (empty($var)) {
            return $var;
        }

        if (is_array($var)) {
            foreach (array_keys($var) as $key) {
                $var[$key] = html_escape($var[$key], $double_encode);
            }

            return $var;
        }

        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', $double_encode);
    }
}
