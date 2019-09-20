<?php
namespace Picamator\SteganographyKit\Image;

/**
 * Image
 */
interface ImageInterface extends \Countable, \IteratorAggregate
{
    /**
     * Gets image
     * 
     * @return resource
     */
    public function getImage();
    
    /**
     * Gets image size
     * 
     * @return array
     */
    public function getSize();      
            
    /**
     * Sets pixel
     * Modify image pixel
     * 
     * @param int $xIndex
     * @param int $yIndex
     * @param array $pixel
     *
     * @return self
     *
     * @throws RuntimeException
     */
    public function setPixel($xIndex, $yIndex, array $pixel);
    
    /**
     * Encode color index to rbb array with binary values
     * 
     * @param int $colorIndex result of imagecolorate
     *
     * @return array
     * <code>
            array('red' => ..., 'green' => ..., 'blue' => ..., 'alpha' => ...);
     * </code>
     */
    public function getDecimalColor($colorIndex);
    
    /**
     * Encode decimalPixel to binary
     * 
     * @param int $colorIndex result of imagecolorate
     *
     * @return array
     * <code>
            array('red' => ..., 'green' => ..., 'blue' => ..., 'alpha' => ...);
     * </code>
     */
    public function getBinaryColor($colorIndex);
    
    /**
     * Save image
     * 
     * @return bool true if ok or false otherwise
     */
    public function save();
    
}
