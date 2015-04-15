<aside id="sidebar" role="complementary">
<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
    <!-- Sidebar -->
    <aside class="grid_3">
        <!-- Next event info-->
        <div class="next-event text-center">
            <h4>
                Next Screening
            </h4>
            <figure class="no-margin">
                <img src="images/Her%20Poster.jpg">
                <figcaption>"Her"</figcaption>
            </figure>
            <p>
                27th February<br/>
                16:00 in AUD 1
            </p>
        </div>

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

    <!--<div id="primary" class="widget-area">-->
<!--<ul class="xoxo">-->
<?php //dynamic_sidebar( 'primary-widget-area' ); ?>
<!--</ul>-->
<!--</div>-->
<?php endif; ?>
</aside>