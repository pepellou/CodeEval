<?php

require_once dirname(__FILE__).'/../UglyNumbers.php';

class UglyNumbersTest extends PHPUnit_Framework_TestCase {

    /**
    * @dataProvider known_solutions
    */
	public function test_uglyNumbers(
        $input,
        $expectedOutput
	) {
		$this->assertEquals($expectedOutput, UglyNumbers::solve($input));
	}

    public static function known_solutions(
    ) {
        return array(
		    array("1", 0),
		    array("9", 1),
		    array("011", 6),
		    array("12345", 64),
		    array("123456", 199),
		    array("1234567", 541),
		    array("12345678", 1746),
		    array("123456789", 5244),
		    array("1234506789", 15714),
		    array("12345067809", 47123),
        );
    }

}
