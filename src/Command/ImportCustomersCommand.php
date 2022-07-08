<?php

namespace App\Command;

use App\Services\Api\ApiService;
use App\Services\User\CustomerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCustomersCommand extends Command
{
    protected static $defaultName = 'import:customers';

    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * @var CustomerService
     */
    private $customerService;

    public function __construct(string $name = null, ApiService $apiService, CustomerService $customerService)
    {
        parent::__construct($name);

        $this->apiService = $apiService;
        $this->customerService = $customerService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $usersCount = $input->getArgument('arg1');

        if (empty($usersCount)) {
            $usersCount = 100;
        }
        $result = $this->apiService->getUsers($usersCount);

        foreach ($result->results as $user) {
            $this->customerService->create($user, false);
        }
        $this->customerService->getEntityManager()->flush();

        return Command::SUCCESS;
    }
}
