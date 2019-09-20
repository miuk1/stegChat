<?php
namespace Picamator\SteganographyKit\SecretText;

use Picamator\SteganographyKit\Options\OptionsTrait;

/**
 * Abstract for Secret Text
 */
abstract class AbstractSecretText implements SecretTextInterface
{    
    use OptionsTrait;
    
    /**
     * Mark that is added to end of the text
     * it helps to identify where secret text end
     */
    const END_TEXT_MARK = '0000000000000000';
       
    /**
     * Length of secretText item in binary
     */
    const BINARY_ITEM_LENGTH = 8;
    
    /**
     * Binary Item Size
     * 
     * @var int
     */
    protected $binaryItemSize = 3;
    
    /**
     * Default Options
     * 
     * @var array
     */
    protected $optionsDefault = [];
    
    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options, $this->optionsDefault);
    }
        
    /**
     * Gets position of end mark
     * 
     * @param string $secretText
     *
     * @return int|false
     */
    public function getEndMarkPos($secretText) 
    {
        return strpos($secretText, self::END_TEXT_MARK);
    }
    
    /**
     * Sets binary item size
     * It's used for iteration process
     * 
     * @param int $size
     *
     * @return self
     */
    public function setBinaryItemSize($size) 
    {
        $this->binaryItemSize = $size;
        
        return $this;
    }
    
    /**
     * Gets binary item size
     * It's used for iteration process
     * 
     * @return int
     */
    public function getBinaryItemSize() 
    {
        return $this->binaryItemSize;
    }
    
    /**
     * Add end mark
     * 
     * @param string $secretText
     *
     * @return string
     */
    protected function addEndMark($secretText) 
    {
        return $secretText . self::END_TEXT_MARK;
    }
    
    /**
     * Remove end mark
     * 
     * @param string $secretText
     *
     * @return string
     */
    protected function removeEndMark($secretText) 
    {
        $endMarkPos  = $this->getEndMarkPos($secretText);
        $result      = substr($secretText, 0, $endMarkPos);
        
        // when last characters has last bits zeros then it could be a part of EndMark
        // therefore it's possible to remove bits from last character
        $repeat  = strlen($result) % self::BINARY_ITEM_LENGTH;
        if ($repeat !== 0) {
            $result .= str_repeat('0', self::BINARY_ITEM_LENGTH - $repeat);
        }
        
        return $result;
    }
}
