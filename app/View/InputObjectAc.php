<?php
/**
 * Created by PhpStorm.
 * User: AhmadReza
 * Date: 27/04/2016
 * Time: 04:02 PM
 */

namespace App\View;

/**
 * @property  ngLink
 */
class InputObjectAc extends InputObject {

  protected $textChangeEvent, $selectedItemChange, $searchTextChange, $itemDisplay;
  protected $ngOptions, $ngLink, $noLabel, $format;

  /**
   * @return mixed
   */
  public function getItemDisplay() {
    return $this->itemDisplay;
  }

  /**
   * @param mixed $itemDisplay
   */
  public function setItemDisplay($itemDisplay) {
    $this->itemDisplay = $itemDisplay;
  }

  /**
   * InputObject constructor.
   * @param $ngModel
   * @param string $ngOptions
   * @param $ngLink
   * @param string $label
   */
  public function __construct($ngModel, $ngOptions, $ngLink, $label = '') {
    parent::__construct($ngModel, $label);
    $this->ngOptions = $ngOptions;
    $this->ngLink = $ngLink;
  }

  /**
   * @return mixed
   */
  public function getTextChangeEvent() {
    if (!isset($this->textChangeEvent)) {
      return FALSE;
    }
    return $this->textChangeEvent;
  }

  /**
   * @param mixed $textChangeEvent
   */
  public function setTextChangeEvent($textChangeEvent) {
    $this->textChangeEvent = $textChangeEvent;
  }

  /**
   * @return mixed
   */
  public function getSelectedItemChange() {
    if (!isset($this->selectedItemChange)) {
      return FALSE;
    }
    return $this->selectedItemChange;
  }

  /**
   * @param mixed $selectedItemChange
   */
  public function setSelectedItemChange($selectedItemChange) {
    $this->selectedItemChange = $selectedItemChange;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSearchTextChange() {
    if (!isset($this->searchTextChange)) {
      return FALSE;
    }
    return $this->searchTextChange;
  }

  /**
   * @param mixed $searchTextChange
   */
  public function setSearchTextChange($searchTextChange) {
    $this->searchTextChange = $searchTextChange;
  }

  /**
   * @param mixed $noLabel
   */
  public function setNoLabel($noLabel) {
    $this->noLabel = $noLabel;
  }

  /**
   * @param mixed $format
   */
  public function setFormat($format) {
    $this->format = $format;
  }

}

