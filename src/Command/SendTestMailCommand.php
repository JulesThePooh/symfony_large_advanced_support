<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;

#[AsCommand(
    name: 'app:send-test-mail',
    description: 'Add a short description for your command',
)]
class SendTestMailCommand extends Command
{


    public function __construct(
        private HttpClientInterface $httpClient,
        private Environment         $environment,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        try {
            $template = $this->environment->render('mail/test-mail.html.twig', [
                'myVar' => 'ceci est myVar'
            ]);

            $response = $this->httpClient->request('POST', "https://api.brevo.com/v3/smtp/email", [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => "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",
                    'content-type' => 'application/json'
                ],
                'json' => [
                    "sender" => [
                        'name' => "Jules Pauly",
                        'email' => "jules@drosalys.fr"
                    ],
                    "to" => [
                        [
                            'email' => "paulyjules@gmail.com",
                            'name' => "Jules bebs"
                        ]
                    ],
                    "subject" => "Hello world",
                    "htmlContent" => $template
                ]
            ]);
        } catch (Exception $e) {

        }

        return Command::SUCCESS;
    }
}
