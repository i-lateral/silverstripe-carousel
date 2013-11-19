<% require css(carousel/css/carousel.css) %>

<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(framework/thirdparty/jquery-ui/jquery-ui.js) %>
<% require javascript(carousel/javascript/jquery-ui-tabs-rotate.js) %>
<% require javascript(carousel/javascript/carousel.js) %>

<% if Slides.Exists %><div class="carousel-container">
    <div class="carousel-slides">
        <% loop $Slides %>
            <div id="carousel-slide-$Pos" class="carousel-slide $FirstLast">
                $SizedImage
                <% if Title %><div class="carousel-slide-content"><h2>$Title.RAW</h2></div><% end_if %>
            </div>
        <% end_loop %>

        <div class="carousel-controls">
            <ul class="carousel-controls-list">
                <% loop $Slides %>
                    <li class="carousel-control $FirstLast"><a href="#carousel-slide-{$Pos}"><span>$Pos</span></a></li>
                <% end_loop %>
            </ul>
        </div>
    </div>
</div><% end_if %>
