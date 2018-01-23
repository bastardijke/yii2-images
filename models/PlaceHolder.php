<?php
/**
 * Created by PhpStorm.
 * User: kostanevazno
 * Date: 05.08.14
 * Time: 18:21
 *
 * TODO: check that placeholder is enable in module class
 * override methods
 */

namespace rico\yii2images\models;

/**
 * TODO: check path to save and all image method for placeholder
 */

use yii;

class PlaceHolder extends Image
{

    public $modelName = '';
    private $itemId = '';
    public $filePath = 'placeHolder.png';
    public $urlAlias = 'placeHolder';


    public function __construct( $modelName = null ){
        if ( !empty($modelName) && array_key_exists( $modelName , $this->getModule()->customPlaceHolders ) ) {
          $this->modelName = $modelName;
          $this->urlAlias .= '-' . $modelName;
          $this->filePath = Yii::getAlias($this->getModule()->customPlaceHolders[$modelName]);
        } elseif ( $this->getModule()->placeHolderPath ) {
          $this->filePath = Yii::getAlias($this->getModule()->placeHolderPath);
        } else {
          throw new \Exception('PlaceHolder image must have path setting!!!');
        }

        if ( !file_exists($this->filePath) ) {
          throw new \Exception( 'Specified placeholder file "' . $this->filePath . '" not exists!' );
        }
    }

    public function getPathToOrigin(){
        return $this->filePath;
    }

    protected function getSubDur(){
        return 'placeHolder';
    }

    public function setMain($isMain = true){
        throw new yii\base\Exception('You must not set placeHolder as main image!!!');
    }

}

