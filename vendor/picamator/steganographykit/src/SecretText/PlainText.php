<?php
namespace Picamator\SteganographyKit\SecretText;

use Picamator\SteganographyKit\Iterator\SecretTextIterator;
use Picamator\SteganographyKit\ObjectManager\ObjectManager;

/**
 * Secret Text - Plain text
 */
class PlainText extends AbstractSecretText 
{
    /**
     * Cache container
     *
     * @var array
     */
    static protected $cache = [];

    /**
     * Default Options
     * 
     * @var array
     */
    protected $optionsDefault = array(
        'compressLevel' => -1,
        'text'          => ''
    );
      
    /**
     * Binary data
     * 
     * @var string 
     */
    protected $binaryData;

    /**
     * @var SecretTextIterator | null
     */
    private $iterator = null;

   /**
    * Gets Iterator
    * 
    * @return SecretTextIterator
    */ 
    public function getIterator() 
    {
        if(is_null($this->iterator)) {
            $this->iterator = ObjectManager::getInstance()->create('Picamator\SteganographyKit\Iterator\SecretTextIterator', [$this]);
        }

        return $this->iterator;
    }

    /**
     * Count elements
     *
     * @param string $mode
     *
     * @return int The custom count as an int
     */
    public function count($mode = 'COUNT_NORMAL')
    {
        return strlen($this->binaryData);
    }
    
    /**
     * {@inheritDoc}
     */
    public function setOptions(array $options, array $optionsDefault = [])
    {
        parent::setOptions($options, $optionsDefault);
        
        if (!empty($options['text'])) {
            $this->setBinaryData();
        }
    }
    
    /**
     * Gets converted data to binary format
     * 
     * @return string - binary representation of secret data
     */
    public function getBinaryData()
    {       
        return $this->binaryData;
    }
            
    /**
     * Gets secretText from binary data
     * 
     * @param string    $binaryData - raw secretText with endMark
     *
     * @return string
     */
    public function getFromBinaryData($binaryData) 
    {        
        $binaryData     = $this->removeEndMark($binaryData);       
        $binaryLength   = strlen($binaryData);
        
        $converter      = function($data) {
            return chr(bindec($data));
        };
        
        $text = '';
        for ($i = 0; $i < $binaryLength; $i = $i + self::BINARY_ITEM_LENGTH) {
            $binaryItem  = substr($binaryData, $i, self::BINARY_ITEM_LENGTH);
            $text       .= self::convertData($binaryItem, $converter);
        }
             
        // decode
        $result = $this->decode($text);
        
        return $result;
    }
    
    /**
     * Sets binary data
     * 
     * @return type
     */
    protected function setBinaryData()
    {   
        // encode
        $encode         = $this->encode($this->options['text']);
        $encodeLength   = strlen($encode);
  
        $format     = '%0' . self::BINARY_ITEM_LENGTH . 'd';
        $converter  = function($data) use ($format) {
            return sprintf($format, decbin(ord($data)));
        };
        
        $binaryData = '';
        for ($i = 0; $i < $encodeLength; $i ++) {
            $binaryData .= self::convertData($encode[$i], $converter);
        }
                       
        $this->binaryData = $this->addEndMark($binaryData);      
    }
        
    /**
     * Convert data
     * 
     * @param string $data
     * @param \Closure $converter
     *
     * @return string
     */
    static protected function convertData($data, \Closure $converter)
    {
        $result = self::getFromCache($data);
        if ($result === false) {
           $result = $converter($data);
           self::setToCache($data, $result);
        }

       return $result; 
    }
    
    /**
     * Set to cache
     * 
     * @param string $key
     * @param string $value
     */
    static protected function setToCache($key, $value) 
    {
        self::$cache[$key] = $value;
    }
    
    /**
     * Gets from cache
     * 
     * @return string|false
     */
    static protected function getFromCache($key) 
    {
        return (key_exists($key, self::$cache)) ? self::$cache[$key] : false;
    }
    
    /**
     * Encode text
     * 
     * @param string $text
     *
     * @return string - base64encoded compresses string
     */
    protected function encode($text) 
    {
        return base64_encode(gzcompress($text, $this->options['compressLevel']));
    }
    
    /**
     * Decode text
     * 
     * @param string $text
     *
     * @return string
     */
    protected function decode($text) 
    {   
        return gzuncompress(base64_decode($text));
    }
}
