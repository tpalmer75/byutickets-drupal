<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content[''field_example']). Use
 *   hide($content[''field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $pubdate: Formatted date and time for when the node was published wrapped
 *   in a HTML5 time element.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
?>

<?php
  render($content);

/* 
  FIELDS:
  field_venue_image
  field_venue_seating
  field_venue_directions
  field_venue_parking_text
  field_venue_policies
  field_venue_guest_guides
  field_venue_concessions
*/

  $image = false;
  $seating = false;
  $directions = false;
  $parking = false;
  $policies = false;
  $guest = false;
  $concessions = false;

  if (!empty($node->field_venue_image) ) { 
    $image = render( $content['field_venue_image'] ); 
  }

  if (!empty($node->field_venue_seating) ) { 
    $seating = render( $content['field_venue_seating'] ); 
  }

  if (!empty($node->field_venue_directions) ) { 
    $directions = render( $content['field_venue_directions'] ); 
  }

  if (!empty($node->field_venue_parking_text) ) { 
    $parking = render( $content['field_venue_parking_text'] ); 
  }

  if (!empty($node->field_venue_policies) ) { 
    $policies = render( $content['field_venue_policies'] ); 
  }

  if (!empty($node->field_venue_guest_guides) ) { 
    $guest = render( $content['field_venue_guest_guides'] ); 
  }

  if (!empty($node->field_venue_concessions) ) { 
    $concessions = render( $content['field_venue_concessions'] ); 
  }

?>


<h1<?php print $title_attributes; ?>><?php print $title; ?></h1>

  <?php if($image) { print $image; } ?>

<ul class="nav nav-tabs nav-stacked venue" id="sportTab">
  <?php if($seating) { ?> <li class="active"><a href="#seating" data-toggle="tab">Seating</a></li> <?php } ?>
  <?php if($directions) { ?> <li><a href="#directions" data-toggle="tab">Directions</a></li> <?php } ?>
  <?php if($parking) { ?> <li><a href="#parking" data-toggle="tab">Parking</a></li> <?php } ?>
  <?php if($policies) { ?> <li><a href="#policies" data-toggle="tab">Policies</a></li> <?php } ?>
  <?php if($guest) { ?> <li><a href="#guest" data-toggle="tab">Guest Guides</a></li> <?php } ?>
  <?php if($concessions) { ?> <li><a href="#concessions" data-toggle="tab">Concessions</a></li> <?php } ?>
</ul>

<div class="tab-content venue">
  <div class="tab-pane" id="schedule"></div>
  
  <?php if($seating) { ?>
    <div class="tab-pane active" id="seating">
      <h2 class="sectionTitle">Seating</h2>
      <?php print $seating; ?>
    </div>
  <?php } ?>
  
  <?php if($directions) { ?>
    <div class="tab-pane" id="directions">
      <h2 class="sectionTitle">Directions</h2>
      <?php print $directions; ?>
    </div>
  <?php } ?>
  
  <?php if($parking) { ?>
    <div class="tab-pane" id="parking">
      <h2 class="sectionTitle">Parking</h2>
      <?php print $parking; ?>
    </div>
  <?php } ?>
  
  <?php if($policies) { ?>
    <div class="tab-pane" id="policies">
      <h2 class="sectionTitle">Policies</h2>
      <?php print $policies; ?>
    </div>
  <?php } ?>
  
  <?php if($guest) { ?>
    <div class="tab-pane" id="guest">
      <h2 class="sectionTitle">Guest Guides</h2>
      <?php print $guest; ?>
    </div>
  <?php } ?>
  
  <?php if($concessions) { ?>
    <div class="tab-pane" id="concessions">
      <h2 class="sectionTitle">Concessions</h2>
      <?php print $concessions; ?>
    </div>
  <?php } ?>
</div>

<!-- /.node-venue -->
