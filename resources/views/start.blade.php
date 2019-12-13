<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poker - Start</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/custom.css" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Poker Assessment
                </div>
            <div>
                <small>Plaese choose one of {{count($cards)}} cards from below for play.</small>
                <br/>
            </div>

                <div class="links">
                @foreach($cards as $card)
                    <a href="{{route('play',[$card->suit,$card->value])}}">
                        <div class="card" style="background-color: #{{$card->color}}">
                        {{$card->suit}} 
                        <span class="card-value">{{$card->value}}</span>
                        </div>
                    </a>
                @endforeach
                </div>
                
                <div style="clear:both;"></div>
            </div>
        </div>

        
        <div style="text-align: center">
            "Poker chance calculator" script is an assessment for AWStreams.
            <br /><small>Coding by Mahmoud Nabhan</small>
        </div>
    </body>
</html>
