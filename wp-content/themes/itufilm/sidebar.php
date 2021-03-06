<aside id="sidebar" role="complementary">
<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

    <!-- Sidebar -->
    <aside class="grid_3">


        <?php
        // Query args for fetching the featured screening.
        $next_event_query_args = array(
            'post_type'			=> 'Event',
//            'posts_per_page'	=> 1,
            'meta_key'			=> 'siml_event_time',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC'
        );

        // Get featured screening.
        $result = get_posts($next_event_query_args);

        $future_events = array();
        $current_time = time();
        foreach($result as $event){
            // Only get the events that are right now or in the future.
            $event_time = rwmb_meta('siml_event_time', 'type=datetime', $event -> ID );
            $event_time = strtotime($event_time);

            // Event is in the future, add it to our collection
            if($event_time > $current_time) {
                array_push($future_events, $event);
            }
        }

        // Take the first element, the first added will be the next upcoming event due to the ordering
        $event = $future_events[0];
        $event_link = get_permalink($event -> ID);

        $event_posters = rwmb_meta( 'siml_event_picture', 'type=image&size=143x212', $event -> ID );
        $event_poster = reset($event_posters); // Rewind and get the first element of the array (there should only be one)
        $event_time = rwmb_meta('siml_event_time', 'type=datetime', $event -> ID );
        $event_location = rwmb_meta('siml_event_location', 'type=text', $event -> ID );
        $event_time = strtotime($event_time);
        ?>

        <?php if(empty($future_events)) : ?>

        <!-- Next event info-->
        <div class="next-event text-center">
            <h4>
                No Screenings Planned
            </h4>
        </div>
        <?php else : ?>
        <!-- Next event info-->
        <div class="next-event text-center">
            <h4>
                Next Screening
            </h4>
            <figure class="no-margin">
                <?php
                 echo "<a href=\"$event_link\"><img src='{$event_poster['url']}' width='{$event_poster['width']}' height='{$event_poster['height']}'  alt='{$event_poster['alt']}' /></a>";
                ?>
                <figcaption><?php echo ($event -> post_title); ?></figcaption>
            </figure>
            <p>
                <!--        Transform date                    -->
                <?php echo(date("j F " , $event_time) . '<br/>' . date("H:i ", $event_time) . "in " . $event_location);  ?>
            </p>
        </div>
        <?php endif ?>

        <!-- Using a simple poll and survey service from pollcode.com to showcase poll functionality -->
        <div class="poll">
            <form method="post" action="http://poll.pollcode.com/58598945">
                <p><strong>Which movie should ITU.film screen next?</strong></p>
                <div class="blank"></div>
                <input type="radio" name="answer" value="1" id="answer585989451"/>
                <label for="answer585989451"> Kingsman: The Secret Service</label>
                <div class="blank"></div>
                <input type="radio" name="answer" value="2" id="answer585989452"/>
                <label for="answer585989452">Big Eyes</label>
                <div class="blank"></div>
                <input type="radio" name="answer" value="3" id="answer585989453"/>
                <label for="answer585989453">Fifty Shades of Grey</label>
                <div class="blank"></div>
                <input type="radio" name="answer" value="4" id="answer585989454"/>
                <label for="answer585989454">Mænd og Høns</label>
                <div class="blank"></div>
                <input type="radio" name="answer" value="5" id="answer585989455"/>
                <label for="answer585989455">Chappie</label>
                <div class="blank"></div>
                <input type="radio" name="answer" value="6" id="answer585989456"/>
                <label for="answer585989456">None of the above</label>
                <div class="blank"></div>
                <div class="buttons"><input type="submit" value=" Vote "><input type="submit" name="view" value=" View "></div>
            </form>
        </div>
    </aside>

    <div class="separator"> </div>
<?php endif; ?>
</aside>