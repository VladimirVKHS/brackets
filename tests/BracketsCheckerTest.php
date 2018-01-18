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
            return (new BracketsChecker($str))->check();
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }

    public function testValid()
    {
        $str = "(()(\n)\t\r())";
        $this->assertTrue($this->myRunTest($str));
    }

    public function testInvalid()
    {
        $str = "((()(\n)\t\r())";
        $this->assertFalse($this->myRunTest($str));
    }

    public function testValidMultiline()
    {
        $str = "(()(\n)\t\r())()
        
        ()
        (
        ()
        )
        
        ";
        $this->assertTrue($this->myRunTest($str));
    }

    public function testInvalidMultiline()
    {
        $str = "(()(\n)\t\r())
        
        (*)
        
        ";
        $this->assertFalse($this->myRunTest($str));
    }

}