<?php
namespace Picamator\SteganographyKit\Tests\Integration\Image;

use Picamator\SteganographyKit\Image\Image;
use Picamator\SteganographyKit\Tests\Integration\BaseTest;

class ImageTest extends BaseTest
{
    /**
     * @dataProvider providerPath
     *
     * @param array $options
     */
    public function testGetDecimalColor(array $options) 
    {
        $options['path']    = $this->getDataPath($options['path']);
        $rgb                = ['red', 'green', 'blue'];
        
        $image = new Image($options);
        foreach ($image as $item) {
            $decimalPixel = $image->getDecimalColor($item);            
            // assert rgb
            foreach($rgb as $value) {
                $this->assertTrue(isset($decimalPixel[$value]));
                $this->assertGreaterThanOrEqual(0, $decimalPixel[$value]);
                $this->assertLessThanOrEqual(255, $decimalPixel[$value]);        
            }           
        } 
    }  
    
    /**
     * @dataProvider providerPath
     *
     * @param array $options
     */
    public function testGetBinaryColor(array $options) 
    {
        $options['path']    = $this->getDataPath($options['path']);
        $rgb                = ['red', 'green', 'blue'];
        
        $image = new Image($options);
        foreach ($image as $item) {
            $binaryPixel = $image->getBinaryColor($item); 
                   
            // assert rgb
            foreach($rgb as $value) {
                $this->assertTrue(isset($binaryPixel[$value]));
                $this->assertRegExp('/[01]{8}/', $binaryPixel[$value]);  
            }           
        } 
    }  
    
    /**
     * @dataProvider providerPath
     *
     * @param array $options
     */
    public function testSetPixel(array $options) 
    {
        $options['path']    = $this->getDataPath($options['path']); 
        $image              = new Image($options);
        
        $expectedPixel = ['red' => 100, 'green' => 0, 'blue' => 10, 'alpha' => 0];
        $image->setPixel(0, 0, $expectedPixel);
        
        $dataPixel   = $image->getIterator()->current();
        $actualPixel = $image->getDecimalColor($dataPixel['color']);
        
        $this->assertEquals($expectedPixel, $actualPixel);
    }
    
    /**
     * @dataProvider providerSaveFailed
     *
     * @param array $options
     */
    public function testSaveFailed(array $options) 
    {
        $options['path']    = $this->getDataPath($options['path']); 
        $image              = new Image($options);
        
        $this->assertFalse($image->save());
    }
    
    /**
     * @dataProvider providerSaveSuccess
     *
     * @param array $options
     */
    public function testSaveSuccess(array $options) 
    {
        $options['path']        = $this->getDataPath($options['path']); 
        $options['savePath']    = $this->getDataPath($options['savePath']) . '/save_success.png';
        $image                  = new Image($options);
       
        $this->assertTrue($image->save());
    }
    
    /**
     * @dataProvider providerFailInit
     * @expectedException \Picamator\SteganographyKit\InvalidArgumentException
     *
     * @param array $options
     */
    public function testFailInit(array $options)
    {
        new Image($options);
    }

    /**
     * @dataProvider providerFailType
     * @expectedException \Picamator\SteganographyKit\InvalidArgumentException
     *
     * @param array $options
     */
    public function testFailType(array $options)
    {
        new Image($options);
    }

    public function providerPath() 
    {
        return [
            [['path' => 'original_50_50.png']],
            [['path' => 'original_50_50.jpeg']],
        ];
    }

    public function providerFailInit()
    {
        return [
            [['path' => 'non_existing_file.png']],
            [['path' => 'secret_text.txt']],
        ];
    }
    
    public function providerSaveFailed() 
    {
        return [
            [['path' => 'original_50_50.png']],
        ];
    }
    
    public function providerSaveSuccess() 
    {
        return [
            [['path' => 'original_50_50.png', 'savePath' => 'stego']],
        ];
    }

    public function providerFailType()
    {
        return [
            [['path' => 'original_50_50.gif']],
            [['path' => 'original_50_50.bmp']],
        ];
    }
}
