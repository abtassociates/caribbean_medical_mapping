<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateAdmin extends Command {


    const SUCCESS = "[42m"; //Green background
    const FAILURE = "[41m"; //Red background
    const WARNING = "[43m"; //Yellow background
    const NOTE = "[44m"; //Blue background

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create an admin user';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$user = new User();

		$user->first_name = $this->ask('First name?');
		$user->last_name = $this->ask('Last name?');
		$user->email = $this->ask('Email?');
		$user->password = $this->ask('Password? (at least 8 characters)');
		$user->password_confirmation = $this->ask('Confirm Password?');
		$user->confirmed = true;
		$user->save();

		if($user->errors()->count()){
			echo $this->colorize("User creation failed", "failure")."\n";
			foreach($user->errors()->all() as $error){
				echo "{$error}\n";
			}
		}else{
			$user->saveRoles([1]);
			echo $this->colorize("User created successfully", "success")."\n";
		}
	}


    protected function colorize($text, $status)
    {
        $out = "";
        switch(strtoupper($status))
        {
            case "SUCCESS":
                $out = self::SUCCESS;
                break;
            case "FAILURE":
                $out = self::FAILURE;
                break;
            case "WARNING":
                $out = self::WARNING;
                break;
            case "NOTE":
                $out = self::NOTE;
                break;
            default:
                throw new Exception("Invalid status: " . $status);
        }

        return chr(27) . "$out" . "$text" . chr(27) . "[0m";
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
