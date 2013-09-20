<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function byu_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  
  
  //Sets the Parent Organization Name
  $form['byu_template'] = array(
	  '#type' => 'fieldset', 
	  '#title' => t('BYU Template'),
	  '#description' => t('Configure settings specific to the BYU template.'),
	);
  
  $form['byu_template']['primary_secondary'] = array(
	  '#type'          => 'radios',
	  '#title'         => t('Primary or Secondary'),
	  '#default_value' => theme_get_setting('primary_secondary'),
	  '#options'	   => drupal_map_assoc(array(t('Primary'), t('Secondary'))),
	  '#description'   => t("A primary organization is usually a college level. A secondary organization is a department under a college."),	  
  );
  
  //Sets the Parent Organization
  $form['byu_template']['secondary']['parent_org'] = array( 
    '#type'          => 'textfield',
    '#title'         => t('Parent Organization'),
    '#default_value' => theme_get_setting('parent_org'),
    '#description'   => t("Enter the name of your parent organization to be displayed in the header. Leave blank to use the full Brigham Young University logo."),
	'#states' => array(
		'visible' => array(
        ':input[name="primary_secondary"]' => array('value' => 'Secondary'),
      ),
    ),
  );
  
  //Sets the Parent Organization URL
  $form['byu_template']['secondary']['parent_org_link'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Parent Organization Website'),
    '#default_value' => theme_get_setting('parent_org_link'),
    '#description'   => t("Enter the URL of your parent organization. (Example: http://college.byu.edu)"),
	'#states' => array(
	  'visible' => array(
	  ':input[name="primary_secondary"]' => array('value' => 'Secondary'),
	  ),
	),
  );
}