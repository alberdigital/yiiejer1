<?php


use Yii;
use app\core\Mates;
use yii\codeception\TestCase;
use Codeception\Specify;

//class MatesTest extends \PHPUnit_Framework_TestCase
class MatesTest extends TestCase
{
	// Traits: Un truco para heredar métodos en un lenguaje que no permite herencia múltiple. Ver:
	// http://php.net/manual/en/language.oop5.traits.php
	use Specify;
	
    protected function setUp()
    {
    	parent::setUp();
    }

    protected function tearDown()
    {
    	parent::tearDown();
    }

    // tests
    public function testEjemploSuma()
    {
    	$mates = new Mates();
    	
    	// La global __METHOD__ utiliza barra invertida, así que lo usamos nosotros también. Pero eso significa que hay que escaparla con otra barra invertida,
    	// para no anular la comilla de cierre o la "d" de demo.
    	Yii::error('Un mensaje de error de ejemplo ' . __METHOD__, 'aebf\\demo\\' . __METHOD__);
    	
    	$this->specify('La suma de dos números arbitrarios es correcta.', function() use ($mates) {
    		$suma = $mates->suma(5, 3);
    		Yii::trace('Un mensaje trace desde dentro de specify. La suma es: ' . $mates->suma(5, 3), 'aebf\\demo\\' . __METHOD__);
    		$this->assertEquals($suma, 8);
    	});
    	
		// $this->assertEquals(Yii::$app->basePath, 'test');
    }

}