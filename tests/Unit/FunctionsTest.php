<?php
namespace Inquizarus\Phunc\Test;

require __DIR__ . './../../src/functions.php';

use \PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    /**
     * @test
     */
    public function testThatFilterFunctionWorks()
    {
        $ff = function($i){
            if ("b" === $i) {
                return false;
            }
            return true;
        };
        $this->assertEquals("ac", filter("abc", $ff)->eject());
        $this->assertEquals(["a", "c"], filter(["a", "b", "c"], $ff)->eject());
    }

    /**
     * @test
     */
    public function testThatMapFunctionWorks()
    {
        $mf = function($i){
            if ("b" === $i) {
                return strtoupper($i);
            }
            return $i;
        };
        $this->assertEquals("aBc", map("abc", $mf)->eject());
        $this->assertEquals(["a", "B", "c"], map(["a", "b", "c"], $mf)->eject());
    }

    /**
     * @test
     */
    public function testThatReduceFunctionWorks()
    {
        $this->assertEquals("abc", reduce(["a", "b", "c"], "append"));
    }

    public function testThatItCanDoEach()
    {
        $base = "abc";
        // Try to modify the item
        $mf = function($item) {
            $item = "d";
        };
        $this->assertEquals($base, feach($base, $mf)->eject());
    }

    /**
     * @test
     */
    public function testThatAppendFunctionWorks()
    {
        $this->assertEquals('ab', append('a', 'b'));
    }

    /**
     * @test
     */
    public function testThatPrependFunctionWorks()
    {
        $this->assertEquals('ba', prepend('a', 'b'));
    }
}