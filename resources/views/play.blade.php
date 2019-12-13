<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poker - Play</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <link rel="stylesheet" href="/bootstrap.min.css">
        <script src="/jquery.min.js"></script>
        <script src="/bootstrap.min.js"></script>
        <link href="/custom.css" rel="stylesheet">

        <!-- If chosen card equal drafting show popup -->
        @if(isset($draftedCard) && $chosenCard['suit'] == ($draftedCard->suit ?? null) &&
        $chosenCard['value'] == ($draftedCard->value ?? null))
            <script>
                $(document).ready(function(){
                    $('#winModal').modal('show');
                });
            </script>
        @endif

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
            <div>
                <!-- If draftin card not equal show message -->
                @if(
                    isset($draftedCard) &&
                    count($draftedCards) != 0 &&
                    (
                        $chosenCard['suit'] != $draftedCard->suit ||
                        $chosenCard['value'] != $draftedCard->value 
                    )
                )
                    <small>
                        Oops, not equal card, good luck in another draft.
                    </small>
                @endif
                <br/>

                <!-- the chosen card -->
                <div class="links" style="float:left">
                    <div>You have chosen card</div>
                <a href="#">
                    <div class="card" >
                    {{$chosenCard['suit']}} 
                    <span class="card-value">{{$chosenCard['value']}}</span>
                    </div>
                </a>
                </div>

                <!-- Remaing Cards -->
                <div class="links" style="float:right">
                <div>Remaining cards</div>
                <a href="#">
                    <div class="card sp-color ">
                        {{count($remaningCard)}} Cards
                    </div>
                </a>
                </div>
            </div>

            <div style="clear:both;"></div>
            </div>

            <!-- Drafting Button -->
            <div style="text-align:center"> 
            <div>
                @if(count($draftedCards) == 0)
                    <small>
                        Start drafting a random card from remainig cards 
                    </small>
                @else
                    <small>
                        Chance for draft chosen card is {{$chance}}%
                    </small>
                @endif
                <br />
            </div>
            <a href="{{route('play',[$chosenCard['suit'],$chosenCard['value'],'true'])}}" class="btn btn-success">Draft</a>
            </div>

            <!-- all Drafting cards -->
            @if(count($draftedCards) != 0)
            <div>
                <small>
                    Drafted Cards
                </small>
                <br/>
                <div class="links">
                    <?php $count=0 ?>
                    @foreach($draftedCards as $card)
                        <a href="#">
                            <div class="card @if($count==0) sp-color @endif">
                            {{$card->suit}} 
                            <span class="card-value">{{$card->value}}</span>
                            </div>
                        </a>
                        <?php $count++ ?>
                    @endforeach
                    </div>
            </div>
            @endif
        </div>



        <!-- Wining Modal -->
        <div class="modal fade" id="winModal" data-backdrop="static" data-keyboard="false" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Got it</h4>
                </div>
                <div class="modal-body">
                    <p>the chance was {{$chance}}%</p>
                </div>
                <div class="modal-footer">
                <a href="{{route('start')}}" type="button" class="btn btn-default" >Play again</a>
                </div>
                </div>
                
            </div>
        </div>

    </body>
</html>
