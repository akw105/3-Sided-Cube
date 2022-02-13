<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConvertCommand
 *
 * @package App\Command
 */
class ConvertCommand extends Command
{
    /**
     */
    protected function configure()
    {
        $this->setName('convert');
        $this->addArgument('temperature', InputArgument::REQUIRED, 'Temperature to convert, e.g. 20c or 35f');
    }


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Converting temperature');
        $temp = $this->convert($input->getArgument('temperature'));
        $output->write($temp);
        return 200;
    }

    private function convert($input)
    {
        // assuming the variable is a single string in format of [numberunit]
        // break up string into number/temp and unit/unit
        $str = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $input);
        $temp = $str[0];
        $unit = $str[1]; // needs to be either c or f
        if ($unit === 'c') {
            $new_temp = ($temp * 9 / 5) + 32;
            $response = $new_temp . ' Fahrenheit';
        } elseif ($unit === 'f') {
            $new_temp = ($temp - 32) * 5 / 9;
            $response = $new_temp . ' Celsius';
        } else {
            $response = 'incorrect unit type';
        }
        return $response;
    }
}
