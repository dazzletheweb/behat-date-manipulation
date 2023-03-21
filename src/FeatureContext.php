<?php

namespace Dazzle\BehatDateManipulation;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext {

  /**
   * Parameters array.
   *
   * @var array
   */
  protected $parameters;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   *
   * @param array $parameters
   *   Parameters from the behat.yml.
   */
  public function __construct($parameters) {
    $this->parameters = $parameters;
  }

  /**
   * Function to execute a command that is date manipulated.
   *
   * @Given I manipulate the date with :arg1 and execute command :arg2
   */
  public function iManipulateDateAndExecuteCmd($date, $command) {
    $instruction = 'LD_PRELOAD=' . $this->parameters['install_path'] . ' FAKETIME="' . $date . '" ' . $command;
    $exec_result = shell_exec($instruction . ' 2>&1');
    if ($exec_result) {
      $result = explode(PHP_EOL, $exec_result);
      return $result[0];
    }
    return $exec_result;
  }

}
