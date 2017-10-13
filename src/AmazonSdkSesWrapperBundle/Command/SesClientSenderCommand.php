<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use WebLabLv\AmazonSdkSesWrapper\Data\SesClientData;
use WebLabLv\AmazonSdkSesWrapper\ValueObject\Attachment;

final class SesClientSenderCommand extends ContainerAwareCommand
{
    /**
     * @var string $defaultService
     */
    private static $defaultService = 'weblablv.amazon_ses_client.ses_client_email_sender';

    protected function configure()
    {
        // configuration
        $this->setName('weblablv:amazon-ses-client:send-test-email');
        $this->setDescription('Command used to send test email using Weblab amazon ses client sender');

        // argument
        $this->addArgument('sender',    InputArgument::REQUIRED,                           'Specify email sender ( it must be verified in amazon sdk ses )');
        $this->addArgument('recipient', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'Specify email recipient(s) ( separate multiple emails with a space )');

        // option
        $this->addOption('service', 's', InputOption::VALUE_OPTIONAL, sprintf('Specify service name used to send test email (%s will be used by default)', self::$defaultService), self::$defaultService);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $data = SesClientData::create($input->getArgument('sender'));

        $data->setHtmlText('<h3>Hello!</h3><p>This is <b>Weblab.lv</b> amazon ses client test email</p>');
        $data->setText('Hello! This is Weblab.lv amazon ses client test email');
        $data->setSubject('Weblab.lv amazon ses client bundle test email');

        foreach($input->getArgument('recipient') as $recipient) {
            $data->addRecipient($recipient);
        }

        $this->getContainer()->get($input->getOption('service'))->send($data);
        $output->writeln(
            sprintf('Ses client test email successfully sent to "%s"', implode(' and ', $input->getArgument('recipient')))
        );
    }
}
