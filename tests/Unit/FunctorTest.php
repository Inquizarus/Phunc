<?php
namespace Inquizarus\Phunc\Test;

use \PHPUnit\Framework\TestCase;
use \Inquizarus\Phunc\Functor;

class FunctorTest extends TestCase
{

    /**
     * @test
     **/
    public function testThatItCanBeCreated()
    {
        $functor = new Functor("");
        $this->assertInstanceOf(Functor::class, $functor);
    }

    /**
     * @test
     */
    public function testThatItCanReduceStrings()
    {
        $functor = new Functor("Hello, world!");
        $result = $functor->reduce(function($a, $c){
            if ($c === "o") {
                return $a;
            }
            return $a .= $c;
        }, "");

        $this->assertEquals('Hell, wrld!', $result);
    }

    /**
     * @test
     */
    public function testThatItCanReduceArrays()
    {
        $functor = new Functor(['a', 'b', 'o']);
        $result = $functor->reduce(function($a, $c){
            if ($c === "o") {
                return $a;
            }
            return $a .= $c;
        }, "");
        $this->assertEquals($result, "ab");
    }

    /**
     * @test
     */
    public function testThatItCanFilterStrings()
    {
        $functor = new Functor("abc");
        $ff = function($i){
            if ("b" === $i) {
                return false;
            }
            return true;
        };
        $result = $functor->filter($ff);
        $this->assertEquals(new Functor("ac"), $result);
    }

    /**
     * @test
     */
    public function testThatItCanFilterArrays()
    {
        $functor = new Functor(["a", "b", "c"]);
        $ff = function($i){
            if ("b" === $i) {
                return false;
            }
            return true;
        };
        $result = $functor->filter($ff);
        $this->assertEquals(new Functor(["a", "c"]), $result);
    }

    /**
     * @test
     */
    public function testThatItCanMapStrings()
    {
        $functor = new Functor("abc");
        $ff = function($i){
            if ("b" === $i) {
                return strtoupper($i);
            }
            return $i;
        };
        $result = $functor->map($ff);
        $this->assertEquals(new Functor("aBc"), $result);
    }

    /**
     * @test
     */
    public function testThatItCanMapArrays()
    {
        $functor = new Functor(["a", "b", "c"]);
        $ff = function($i){
            if ("b" === $i) {
                return strtoupper($i);
            }
            return $i;
        };
        $result = $functor->map($ff);
        $this->assertEquals(new Functor(["a", "B", "c"]), $result);
    }

    /**
     * @test
     */
    public function testThatDataCanBeEjected()
    {
        $functor = new Functor("abc");
        $ff = function($i){
            if ("b" === $i) {
                return false;
            }
            return true;
        };
        $result = $functor->filter($ff)->eject();
        $this->assertEquals("ac", $result);
    }
}
