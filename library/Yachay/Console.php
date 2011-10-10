<?php

class Yachay_Console
{
    public $txtblk = "\033[0;30m"; // Black - Regular
    public $txtred = "\033[0;31m"; // Red
    public $txtgrn = "\033[0;32m"; // Green
    public $txtylw = "\033[0;33m"; // Yellow
    public $txtblu = "\033[0;34m"; // Blue
    public $txtpur = "\033[0;35m"; // Purple
    public $txtcyn = "\033[0;36m"; // Cyan
    public $txtwht = "\033[0;37m"; // White
    public $bldblk = "\033[1;30m"; // Black - Bold
    public $bldred = "\033[1;31m"; // Red
    public $bldgrn = "\033[1;32m"; // Green
    public $bldylw = "\033[1;33m"; // Yellow
    public $bldblu = "\033[1;34m"; // Blue
    public $bldpur = "\033[1;35m"; // Purple
    public $bldcyn = "\033[1;36m"; // Cyan
    public $bldwht = "\033[1;37m"; // White
    public $unkblk = "\033[4;30m"; // Black - Underline
    public $undred = "\033[4;31m"; // Red
    public $undgrn = "\033[4;32m"; // Green
    public $undylw = "\033[4;33m"; // Yellow
    public $undblu = "\033[4;34m"; // Blue
    public $undpur = "\033[4;35m"; // Purple
    public $undcyn = "\033[4;36m"; // Cyan
    public $undwht = "\033[4;37m"; // White
    public $bakblk = "\033[40m";   // Black - Background
    public $bakred = "\033[41m";   // Red
    public $badgrn = "\033[42m";   // Green
    public $bakylw = "\033[43m";   // Yellow
    public $bakblu = "\033[44m";   // Blue
    public $bakpur = "\033[45m";   // Purple
    public $bakcyn = "\033[46m";   // Cyan
    public $bakwht = "\033[47m";   // White
    public $txtrst = "\033[0m";    // Text Reset

    public $count = 64;
    public $separator = '.';
    public $ok = "\033[01;32m[OK]\033[0m";
    public $item = "\033[01;32m*\033[0m";
    public $fail = "\033[01;31m[fail]\033[0m";
    public $item_fail = "\033[01;31m*\033[0m";

    protected $common_options = array(
        'help|h'    => 'display this help and exit.',
        'env|e=w'   => 'set the value of the variable APPLICATION_ENV used (mode \'development\' by default).',
    );
    protected $specific_options = array();
    protected $messages = array();
    protected $getopt = null;

    public function __construct() {
        $this->ok .= PHP_EOL;
        $this->fail .= PHP_EOL;
    }

    public function __setup() {
        $this->getopt = new Zend_Console_Getopt(array_merge($this->common_options,$this->specific_options));
        return $this;
    }

    public function __run() {
        try {
            $this->getopt->parse();
        } catch (Zend_Console_Getopt_Exception $e) {
            echo $e->getUsageMessage();
            return false;
        }

        $flag_used = false;

        // Env option, this must always be present.
        $env = $this->getopt->getOption('env');
        defined('APPLICATION_ENV') || define('APPLICATION_ENV', (null === $env) ? 'development' : $env);

        // Initialize Zend_Application
        $application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        $bootstrap = $application->getBootstrap();
        $bootstrap->bootstrap();

        if ($this->getopt->getOption('h')) {
            $flag_used = true;
            echo $this->getopt->getUsageMessage();
            return true;
        }

        foreach ($this->specific_options as $option => $description) {
            $param = explode('|', $option);
            $command = $param[0];

            if ($this->getopt->getOption($command)) {
                $result = $this->{$command}($bootstrap);
                $flag_used = true;

                if ($result) {
                    echo $command . ' was completed successfully' . PHP_EOL;
                } else {
                    echo 'you must correct errors found' . PHP_EOL;
                    $this->__dump();
                }

            }
        }

        if (!$flag_used) {
            echo $this->getopt->getUsageMessage();
        }

        return true;
    }

    protected function __dump() {
        if (count($this->messages) <> 0) {
            echo $this->fail . PHP_EOL;
            echo " $this->item_fail " . implode(PHP_EOL . " $this->item ", $this->messages);
            echo PHP_EOL;
            echo PHP_EOL;
        }

        $this->messages = array();
    }
}
