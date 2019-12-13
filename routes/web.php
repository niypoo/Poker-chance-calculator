<?php


/**
 * show all 52 cards to show one  from them
 */

use App\Card;

Route::get('/', function () {
    
    //data of cards
    $suits = ['Diamonds', 'Hearts', 'Clubs', 'Spades'];
    $values=[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'Jack', 'Queen', 'King'];

    //cehck if database contains on all card
    //if cards less then 52 I fill cards
    //like install I run this code for first time
    $cards = Card::all();
    if(count($cards)<52){

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                Card::create([
                    'suit'=>$suit,
                    'value'=>$value,
                    'state'=>''
                ]);
            }
        }

    }
    //else I reset all data like know
    else{
        Card::query()->update([
            'state'=>''
        ]);
    }

    $cards = Card::all();
    return view('start',['cards'=>$cards]);

})->name('start');


Route::get('/play/{suit}/{value}/{draft?}', function($suit,$value,$draft=null){
    
    //set chosen Card
    $chosenCard = ['suit'=>$suit, 'value'=>$value];
    
    //draftint this is must in another page but for less reading code
    //if dratf has value I will run drating random card
    if($draft){

        //cehck if there is a cards for drate 
        //if isn't i redirect to start
        $remaningCard  = Card::where('state','')->count();
        if($remaningCard == 0){ return redirect(route('start'));}

        //draw or drating new random card & update its state as drafted
        $draftedCard = Card::where('state','')->get()->random(1)->first();
        $draftedCard->update(['state'=>'drafted']);
    }

    //get remaning cards & drafted Cards
    $remaningCard = Card::where('state','')->get();
    $draftedCards = Card::where('state','drafted')->orderBy('updated_at','DESC')->get();

    // if there isn't any remaning Cards redirect to start
    if(count($remaningCard) == 0){ return redirect(route('start'));}

    //get chance and remove decimal 
    $chance  = round(1 /count($remaningCard ?? 1) * 100,2);

    //show html and passing arguments
    return view('play',[
        'chosenCard'=>$chosenCard,
        'remaningCard'=>$remaningCard,
        'draftedCard'=>$draftedCard ?? null,
        'draftedCards'=>$draftedCards,
        'chance'=>$chance
    ]);
})->name('play');