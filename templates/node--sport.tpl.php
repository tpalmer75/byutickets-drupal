<?php
  /* Node -- Sport */

  render($content);

  if (!empty($node->field_schedule_url)) { 
    $scheduleLink = render( $content['field_schedule_url'] );
    $scheduleLink = trim( $scheduleLink );

    $schedule = get_schedule( $scheduleLink );

    $schedule = str_replace('href="/', 'href="http://byucougars.com/', $schedule);
    $schedule = str_replace('src="/', 'src="http://byucougars.com/', $schedule);

  } else { 
    $schedule = ''; 
  }

  if (!empty($node->field_tickets_url)) { 
    $ticketsLink = render( $content['field_tickets_url'] );
  } else { 
    $ticketsLink = ''; 
  }

  if (!empty($node->field_info)) { 
    $info = render( $content['field_info'] );
  } else { 
    $info = ''; 
  }

  if (!empty($node->field_gender)) { 
    $gender = render( $content['field_gender'] ) . ' ';
    if ( $gender == ' ' ) $gender = '';
  } else {
    $gender = '';
  }
  
  if (!empty($node->field_sport_venue)) { 
    $venueTitle = render( $content['field_sport_venue'] );
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
      ->propertyCondition( 'title', trim($venueTitle) );

    $result = $query->execute();
    $nid = current( $result['node'] )->nid;
    $venueNode = node_load( $nid );
    node_build_content( $venueNode );
    $venueContent = $venueNode->content;

    $venue = render( $venueContent['field_venue_seating'] );


  } else {
    $venue = '';
  }


?>


<h1<?php print $title_attributes; ?>><?php print $gender . $title; ?></h1>

<?php print $ticketsLink; ?>


<ul class="nav nav-tabs" id="sportTab">
  <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
  <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
  <li><a href="#venue" data-toggle="tab">Seating</a></li>
</ul>

<div class="tab-content">
  <?php print $info; ?>
  <div class="tab-pane" id="schedule">
    <p class="scheduleLink"><a href="<?php print $scheduleLink; ?>">Full game information and broadcast details at byucougars.com</a></p>
    <?php print $schedule; ?>
  </div>
  <div class="tab-pane" id="venue">
    <?php print $venue; ?>
  </div>
</div>

<!-- /.node-sport -->

