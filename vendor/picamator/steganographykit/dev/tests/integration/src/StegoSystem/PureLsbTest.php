<?php
namespace Picamator\SteganographyKit\Tests\Integration\StegoSystem;

use Picamator\SteganographyKit\StegoSystem\PureLsb;
use Picamator\SteganographyKit\SecretText\PlainText;
use Picamator\SteganographyKit\Image\Image;

class PureLsbTest extends BaseLsbTest
{   
    /**
     * Pure LSB StegoSystem
     * 
     * @var PureLsb 
     */
    protected $pureLsb;
    
    public function setUp() 
    {
        parent::setUp();
        $this->pureLsb = new PureLsb();  
    }

    /**
     * @dataProvider providerEncode
     *
     * @param array $optionsCoverText
     * @param array $optionsSecretText
     */
    public function testEncode(array $optionsCoverText, array $optionsSecretText) 
    {                  
        $optionsCoverText['path']       = $this->getDataPath($optionsCoverText['path']);
        $optionsCoverText['savePath']   = $this->getDataPath(self::$stegoPath) . '/'
            . $optionsCoverText['savePath'];
                
        $coverText      = new Image($optionsCoverText);  
        $secretText     = new PlainText($optionsSecretText);
        
        $result = $this->pureLsb->encode($secretText, $coverText);
        
        $this->assertTrue($result);
    }
    
    /**
     * @dataProvider providerDecode
     *
     * @param array $optionsStegoText
     */
    public function testDecode(array $optionsStegoText, $expected) 
    {      
        $optionsStegoText['path'] = $this->getDataPath($optionsStegoText['path']);

        $stegoText  = new Image($optionsStegoText); 
        $result     = $this->pureLsb->decode($stegoText, new PlainText());
        
        $this->assertEquals($expected, $result);
    }
    
    /**
     * @dataProvider        providerEncodeDecode
     *
     * @param array         $optionsCoverText
     * @param array         $optionsSecretText
     * @param array         $useChannel
     */
    public function testEncodeDecode(array $optionsCoverText, 
        array $optionsSecretText, array $useChannel    
    ) {           
        $this->encodeDecode($optionsCoverText, $optionsSecretText, $useChannel, $this->pureLsb);
    }
    
    public function providerDecode() 
    {
        return [
            [
                [
                    'path' => 'lsb/pure/lorem_ipsum_li_200_200.png',
                ],
                'Lorem ipsum Li'
            ]
        ];
    }
    
    public function providerEncode() 
    {
        return [
            [
                [
                    'path'      => 'original_200_200.png',
                    'savePath'  => 'original_' . date('Y_m_d_H_i_s') . '.png'
                ],
                ['text' => 'Lorem ipsum Li'],
            ]
        ];
    }
    
    /**
     * DataProvider to generate set of encode information
     * to validate how encode-decode is working
     * 
     * before optimization it's run 1.7 Min and used 9 MB (1, 12000, array('red', 'green', 'blue')
     * 
     * @return array
     */
    public function providerEncodeDecode()
    {
       return $this->generateProvider(10, 1000, ['red', 'green', 'blue']);
    }
}
