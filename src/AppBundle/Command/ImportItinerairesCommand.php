<?php

namespace AppBundle\Command;

use AppBundle\Entity\Path;
use AppBundle\Entity\Point;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportItinerairesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:ImportItinerairesCommand')
            ->setDescription('Create points associated with item data')
            ->addArgument(
                'guessPoint',
                InputArgument::REQUIRED,
                'press Y to add guessed points in paths'
            );


    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $file = fopen('csv/Itineraires.csv','r');
        fgetcsv($file);

        while($fields = fgetcsv($file)){

            $path = new Path();
            $point = new Point($path);

            $path->setName($fields[1]);
            $path->setPoints(array($point));

            $point ->setLatitude($fields[24]);
            $point ->setLongitude($fields[25]);
            $point -> setRank(0);
            $point ->setName($fields[25]);

            // Creer des points aléatoires associés au path
            if(strtoupper($input->getArgument('guessPoint')) == 'Y'){

                $nbPoints = rand(1,4); // Nombre de points a generer
                for($i = 0; $i < $nbPoints; $i++){
                    $guessedPoint = new Point($path);
                    $guessedPoint ->setLatitude($fields[24] + $i *(mt_rand() / mt_getrandmax())/1000);
                    $guessedPoint ->setLongitude($fields[25] + $i *(mt_rand() / mt_getrandmax())/1000);
                    $guessedPoint -> setRank($i);
                    $guessedPoint ->setName($fields[25]);


                    $em->persist($guessedPoint);
                }
            }

            $em->persist($path);
            $output->writeln("Added path :". $path->getName());
            $em->persist($point);

        }
        $em->flush();
        $output->writeln("-----------------------------");
        $output->writeln("Finish");
    }
}