<?php

namespace Dazzle\BehatDateManipulation;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Mink\Element\NodeElement;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\Config\Definition\Exception\Exception;

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
   * Set before each scenario the base URL, if needed override it
   *
   * @BeforeScenario
   */
  public function beforeScenario(BeforeScenarioScope $scope) {
    // Load and save the environment for each scenario.
    $this->environment = $scope->getEnvironment();
  }

  /**
   * Function to execute a command that is date manipulated.
   *
   * @Given I manipulate the date with :arg1 and execute command :arg2
   */
  public function iManipulateDateAndExecuteCmd($date, $command) {
    $instruction = 'LD_PRELOAD=' . $this->parameters['install_path'] . ' FAKETIME="' . $date . '" ' . $command;
    $result = explode(PHP_EOL, shell_exec($instruction . ' 2>&1'));
    return $result[0];
  }

}
