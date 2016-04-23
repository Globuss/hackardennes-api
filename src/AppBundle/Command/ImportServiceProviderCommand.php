<?php

namespace AppBundle\Command;

use AppBundle\Entity\ServiceProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportServiceProviderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:ImportServiceProviderCommand')
            ->setDescription('Import all service provider');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting ImportServicesProviderCommand...');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $output->writeln('Adding Hebergement et restauration - Campings.csv');
        $file = fopen('csv/Hebergement et restauration - Campings.csv','r');
        fgetcsv($file);

        while($fields = fgetcsv($file)) {
            $provider = new ServiceProvider($fields[2]);
            
            $provider->setName($fields[1]);
            $provider->setDescription($fields[37] ?: null);
            $provider->setLatitude($fields[29]);
            $provider->setLongitude($fields[30]);

            $em->persist($provider);
        }

        fclose($file);


        $output->writeln('Adding Hebergement et restauration - Restaurants.csv');
        $file = fopen('csv/Hebergement et restauration - Restaurants.csv','r');
        fgetcsv($file);

        while($fields = fgetcsv($file)) {
            $provider = new ServiceProvider($fields[2]);

            $provider->setName($fields[1]);
            $provider->setDescription($fields[36] ?: null);
            $provider->setLatitude($fields[28]);
            $provider->setLongitude($fields[29]);

            $em->persist($provider);
        }

        fclose($file);

        $output->writeln('Adding Hebergement et restauration - Hotels.csv');
        $file = fopen('csv/Hebergement et restauration - Hotels.csv','r');
        fgetcsv($file);

        while($fields = fgetcsv($file)) {
            $provider = new ServiceProvider($fields[2]);

            $provider->setName($fields[1]);
            $provider->setDescription($fields[35] ?: null);
            $provider->setLatitude($fields[27]);
            $provider->setLongitude($fields[28]);

            $em->persist($provider);
        }

        fclose($file);



        $em->flush();
        $output->writeln('Finish');

    }
}