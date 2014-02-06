<% require css(carousel/css/flexslider.css) %>
<% require css(carousel/css/carousel.css) %>

<% require javascript(framework/thirdparty/jquery/jquery.js) %>
<% require javascript(carousel/javascript/jquery.flexslider-min.js) %>
<% require javascript(carousel/javascript/carousel.js) %>

<% if Slides.Exists %>
    <div class="flexslider">
        <div class="slides">
            <% loop $Slides %>
                <div id="carousel-slide-$Pos" class="slide $FirstLast">

                    $SizedImage

                    <% if Title %>
                        <div class="slide-content">
                            <h2>$Title.RAW</h2>
                        </div>
                    <% end_if %>
                </div>
            <% end_loop %>
        </div>
    </div>
<% end_if %>
