<% require css("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css") %>

<% require javascript("https://code.jquery.com/jquery-3.2.1.slim.min.js") %>
<% require javascript("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js") %>
<% require javascript("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js") %>

<% if $Slides.exists %>
    <div id="CarouselSlideIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <% loop $Slides %>
                <li data-target="#CarouselSlideIndicators" data-slide-to="$Pos(-1)" class="active"></li>
            <% end_loop %>
        </ol>

        <div class="carousel-inner">
            <% loop $Slides %>
                <div class="carousel-item active">
                    <img
                        class="d-block w-100"
                        src="$SizedImage.URL"
                        alt="$SizedImage.Title"
                    >
                    <% if Title %>
                        <div class="carousel-caption d-none d-md-block slide-content">
							<% if $Link.LinkURL %>
								<p class="h2"><strong>
                                    <a href="$Link.LinkURL" $Link.TargetAttr>$Title.RAW</a>
                                </strong></p>
							<% else %>
								<p class="h2"><strong>
                                    $Title.RAW
                                </strong></p>
							<% end_if %>
                        </div>
                    <% end_if %>
                </div>
            <% end_if %>
        </div>

        <a class="carousel-control-prev" href="#CarouselSlideIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"><%t Carousel.Prev "Prev" %></span>
        </a>

        <a class="carousel-control-next" href="#CarouselSlideIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"><%t Carousel.Next "Next" %></span>
        </a>
    </div>
<% end_if %>