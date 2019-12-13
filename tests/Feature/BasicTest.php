<?php

namespace Tests\Feature;

use App\Card;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicTest extends TestCase
{

    public function testDatabase()
    {   
        $this->assertDatabaseHas('cards',['suit'=>'Diamonds']);
    }


    public function testChance()
    {   
        $chosenCard = ['suit'=>'Diamonds' , 'value'=>9];
        $cards = Card::where([
            ['state',''],
            ['suit','!=',$chosenCard['suit']],
            ['value','!=',$chosenCard['value']],
        ])->count();
        $this->assertTrue($cards != 0);
    }

}
