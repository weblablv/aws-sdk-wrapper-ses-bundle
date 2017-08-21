<?php

namespace WebLabLv\Bundle\AmazonSdkSesWrapperBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use WebLabLv\AmazonSdkSesWrapper\DataTransfer\SesEmailDataTransfer;

use WebLabLv\AmazonSdkSesWrapper\ValueObject\Attachment;
use WebLabLv\AmazonSdkSesWrapper\ValueObject\Email;

final class SendTestEmailCommand extends ContainerAwareCommand
{
	/**
	 * @var string $defaultService
	 */
	private static $defaultService = 'weblablv.amazon_sdk_ses_wrapper.ses_client_email_sender';

	protected function configure()
	{
		$this->setName('weblablv:amazon-sdk-ses-wrapper:send-test-email');
		$this->setDescription('Sends test email using amazon sdk ses wrapper client');

		$this->addArgument(
			'sender',
			InputArgument::REQUIRED,
			'Specify email sender ( it must be verified in amazon sds ses )'
		);

		$this->addArgument(
			'recipient',
			InputArgument::REQUIRED | InputArgument::IS_ARRAY,
			'Specify test email recipient (separate multiple emails with a space)'
		);

		$this->addOption(
			'service',
			's',
			InputOption::VALUE_OPTIONAL,
			sprintf('Specify service name used to send test email (%s will be used by default)', self::$defaultService),
			self::$defaultService
		);
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return void
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$data = SesEmailDataTransfer::create(Email::create($input->getArgument('sender')));
		$data->setHtmlText('<h3>Hello!</h3><p>This is <b>html</b> text!');
		$data->setText('Hello! This is text');
		$data->setSubject('Amazon sdk ses wrapper bundle test email');
		$data->addAttachment(Attachment::file(__DIR__ . '/../Resources/files/test.txt'));

		foreach($input->getArgument('recipient') as $recipient) {
			$data->addRecipient(Email::create($recipient));
		}

		$this->getContainer()->get($input->getOption('service'))->send($data);
		$output->writeln(
			sprintf('Test email successfully sent to "%s"', implode(' and ', $input->getArgument('recipient')))
		);
	}
}
