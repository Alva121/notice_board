<!DOCTYPE html>
<html lang="en">
<head>
    <title>Slicebox - 3D Image Slider</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="refresh" content="200">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Slicebox - 3D Image Slider with Fallback" />
    <meta name="keywords" content="jquery, css3, 3d, webkit, fallback, slider, css3, 3d transforms, slices, rotate, box, automatic" />
    <meta name="author" content="Pedro Botelho for Codrops" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('include/css/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('include/css/slicebox.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('include/css/custom.css')}}" />
    <script type="text/javascript" src="{{asset('include/js/main.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('include/js/modernizr.custom.46884.js')}}"></script>

</head>
<body>
<div class="container">
    <h1 style="text-shadow: 2px 1px #000000;background-color: #17a2b8">SHREE DEVI INSTITUTE OF TECHNOLOGY</h1>

    <div class="wrapper" >

        <ul id="sb-slider" class="sb-slider">
            @foreach($events as $event)
            <li>
                <a href="http://www.flickr.com/photos/strupler/2969141180" target="_blank"><img src="{{asset('image/'.$event->image.'')}}" alt="image1" width="750px" height="420px"/></a>
                <div class="sb-description">
                    <h3>{{$event->description}}</h3>
                </div>
            </li>
            @endforeach
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2968268187" target="_blank"><img src="https://tympanus.net/Development/Slicebox/images/2.jpg" alt="image2"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Honest Entertainer</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2968114825" target="_blank"><img src="https://tympanus.net/Development/Slicebox/images/3.jpg" alt="image1"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Brave Astronaut</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2968122059" target="_blank"><img src="{{asset('image/WIN_20190511_111240.JPG')}}" alt="image1"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Affectionate Decision Maker</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2969119944" target="_blank"><img src="https://tympanus.net/Development/Slicebox/images/5.jpg" alt="image1"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Faithful Investor</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2968126177" target="_blank"><img src="https://tympanus.net/Development/Slicebox/images/6.jpg" alt="image1"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Groundbreaking Artist</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="http://www.flickr.com/photos/strupler/2968945158" target="_blank"><img src="https://tympanus.net/Development/Slicebox/images/7.jpg" alt="image1"/></a>--}}
{{--                <div class="sb-description">--}}
{{--                    <h3>Selfless Philantropist</h3>--}}
{{--                </div>--}}
{{--            </li>--}}
        </ul>

        <div id="shadow" class="shadow"></div>

{{--        <video width="700" autoplay>--}}
{{--            <source src="{{asset('video/mov_bbb.mp4')}}" type="video/mp4">--}}
{{--            Your browser does not support HTML5 video.--}}
{{--        </video>--}}
    </div><!-- /wrapper -->

</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('include/js/jquery.slicebox.js')}}"></script>
<script type="text/javascript">
    $(function() {

        var Page = (function() {

            var shadow = $( '#shadow' ).hide(),
                slicebox = $( '#sb-slider' ).slicebox( {
                    onReady : function() {

                        shadow.show();

                    },
                    orientation : 'h',
                    cuboidsCount : 10
                } ),

                init = function() {

                    initEvents();

                },
                initEvents = function() {

                };

            return { init : init };

        })();

        Page.init();

    });
</script>

</body>
</html>
