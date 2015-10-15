<?php
class RandomIntTest extends PHPUnit_Framework_TestCase
{
    public function testFuncExists()
    {
        $this->assertTrue(function_exists('random_int'));
    }
    
    public function testOutput()
    {
        $half_neg_max = (~PHP_INT_MAX / 2);
        $integers = array(
            random_int(0, 1000),
            random_int(1001,2000),
            random_int(-100, -10),
            random_int(-1000, 1000),
            random_int(~PHP_INT_MAX, PHP_INT_MAX),
            random_int("0", "1"),
            random_int(0.11111, 0.99999),
            random_int($half_neg_max, PHP_INT_MAX),
            random_int(0.0, 255.0)
        );
        
        $this->assertFalse($integers[0] === $integers[1]);
        $this->assertTrue($integers[0] >= 0 && $integers[0] <= 1000);
        $this->assertTrue($integers[1] >= 1001 && $integers[1] <= 2000);
        $this->assertTrue($integers[2] >= -100 && $integers[2] <= -10);
        $this->assertTrue($integers[3] >= -1000 && $integers[3] <= 1000);
        $this->assertTrue($integers[4] >= ~PHP_INT_MAX && $integers[4] <= PHP_INT_MAX);
        $this->assertTrue($integers[5] >= 0 && $integers[5] <= 1);
        $this->assertTrue($integers[6] === 0);
        $this->assertTrue($integers[7] >= $half_neg_max && $integers[7] <= PHP_INT_MAX);
        $this->assertTrue($integers[8] >= 0 && $integers[8] <= 255);
        
        try {
            $i = random_int("9223372036854775808","9223372036854775807");
            $this->assertFalse(is_int($i));
        } catch (Error $ex) {
            $this->assertTrue($ex instanceof Error);
        } catch (Exception $ex) {
            $this->assertTrue($ex instanceof Exception);
        }
    }
}
