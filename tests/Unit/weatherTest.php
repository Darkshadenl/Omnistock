<?php

namespace Tests\Unit;

use App\Http\Controllers\WeatherController;
use PHPUnit\Framework\TestCase;

use Mockery;
use Mockery\MockInterface;
use App\Service;
use Illuminate\Http\Request;

class weatherTest extends TestCase
{
   
    public function test_faulty_cities()
    {
        $request = $this->createMock(Request::class);
        $c = new WeatherController();
        
        $returns = $c->showLatLong($request, "2222.0000", "34234.91");
        
        dd($returns);
        $this->assertTrue(true);
    }

    public function test_valid_cities()
    {
        $this->assertTrue(true);
        
    }

    public function test_valid_lat_long()
    {
        $this->assertTrue(true);

    }

    public function test_faulty_lat_long()
    {
        $this->assertTrue(true);
        
    }

}
