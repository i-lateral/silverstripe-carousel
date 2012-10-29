<% if Slides %><div class="carousel-container">
    <div class="carousel-slides">
        <% control Slides %>
            <div id="carousel-slide-$Pos" class="carousel-slide $FirstLast">
                $Image.CroppedImage(650,450)
                <% if Title %><h3 class="carousel-slide-header">$Title</h3><% end_if %>
                <% if Content %><p class="carousel-slide-content">$Content.RAW</p><% end_if %>
            </div>
        <% end_control %>
        
        <div class="carousel-controls">
            <ul class="carousel-controls-list">
                <% control Slides %>
                    <li class="carousel-control $FirstLast"><a href="#carousel-slide-{$Pos}"><span>$Pos</span></a></li>
                <% end_control %>
            </ul>
        </div>
    </div>
</div><% end_if %>
