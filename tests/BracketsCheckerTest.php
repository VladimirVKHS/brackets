<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 07.01.2018
 * Time: 23:34
 */

use PHPUnit\Framework\TestCase;
use VkBrackets\BracketsChecker;

class BracketsCheckerTest extends TestCase
{

    private function myRunTest($str)
    {
        try {
            return (new BracketsChecker($str))->result;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }

    public function test1()
    {
        $str = "(()(\n)\t\r())";
        $this->assertTrue($this->myRunTest($str));
    }

    public function test2()
    {
        $str = "((()(\n)\t\r())";
        $this->assertFalse($this->myRunTest($str));
    }

    public function test3()
    {
        $str = "(()(\n)\t\r())()
        
        ()
        (
        ()
        )
        
        ";
        $this->assertTrue($this->myRunTest($str));
    }

    public function test4()
    {
        $str = "(()(\n)\t\r())
        
        (*)
        
        ";
        $this->assertFalse($this->myRunTest($str));
    }

}