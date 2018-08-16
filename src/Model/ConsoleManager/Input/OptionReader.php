<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:22
 */

namespace Model\ConsoleManager\Input;


class OptionReader
{
    protected $mandatoryValueOptions;
    protected $nonMandatoryValueOptions;
    protected $optionValues;

    /**
     * OptionReader constructor.
     * @param $mandatoryValueOptions
     * @param $nonMandatoryValueOptions
     */
    public function __construct($mandatoryValueOptions, $nonMandatoryValueOptions)
    {
        $this->mandatoryValueOptions    = $mandatoryValueOptions;
        $this->nonMandatoryValueOptions = $nonMandatoryValueOptions;
        $this->populateOptionValues();
    }

    /**
     * @param string $optionName
     * @return mixed
     */
    public function getOption(string $optionName)
    {
        return $this->optionValues[$optionName];
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->optionValues;
    }

    /**
     * @return array
     */
    private function createOptionArray(): array
    {
        $options = [];
        foreach ($this->mandatoryValueOptions as $mandatoryOption) {
            $options[] = $mandatoryOption . ':';
        }
        foreach ($this->nonMandatoryValueOptions as $nonMandatoryOption) {
            $options[] = $nonMandatoryOption . ':';
        }
        return $options;
    }

    /**
     *
     */
    private function populateOptionValues(): void
    {
        $this->optionValues = getopt('', $this->createOptionArray());
    }
}