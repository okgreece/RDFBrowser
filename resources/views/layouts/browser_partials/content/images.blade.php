@if(!empty($images))
<section id="images" name="images">
    <div  class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div id="carousel-example-generic" class="carousel slide">
                    <ol class="carousel-indicators">
                        @for($i = 0; $i < count($images); $i++ )
                        @if($i == 0)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active" ></li>
                        @else
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" ></li>
                        @endif

                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for($i = 0; $i < count($images); $i++ )
                        @if($i == 0)
                        <div class="item active">
                            @else
                            <div class="item">
                                @endif
                                <img class="carousel-image" src="{{ $images[$i] }}" alt="">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @if(count($images)!=1))
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            @endif
        </div>
</section>
@endif

@if(count($images)!=1))
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
@endif