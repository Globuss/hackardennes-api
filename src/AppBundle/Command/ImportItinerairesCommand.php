<?php

namespace AppBundle\Command;

use AppBundle\Entity\Path;
use AppBundle\Entity\Point;
use Doctrine\Common\Collections\ArrayCollection;
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
            $allThePoints = new ArrayCollection();

            $point ->setLatitude($fields[24]);
            $point ->setLongitude($fields[25]);
            $point -> setRank(0);
            $point ->setName($fields[29]);
            $point ->setDescription($fields[32]);
            $point ->setCity($fields[15]);
            $point ->setImage($fields[50]);
            $em->persist($point);
            $allThePoints->add($point);

            // Creer des points aléatoires associés au path
            if(strtoupper($input->getArgument('guessPoint')) == 'Y'){

                $nbPoints = rand(1,4); // Nombre de points a generer
                for($i = 0; $i < $nbPoints; $i++){
                    $guessedPoint = new Point($path);
                    $guessedPoint ->setLatitude($fields[24] + $i *(mt_rand() / mt_getrandmax())/1000);
                    $guessedPoint ->setLongitude($fields[25] + $i *(mt_rand() / mt_getrandmax())/1000);
                    $guessedPoint -> setRank($i+1);
                    $guessedPoint ->setName($fields[29].'_'.($i+1));
                    $guessedPoint ->setCity($fields[15]);
                    $guessedPoint ->setDescription($fields[32]);
                    $guessedPoint ->setImage($fields[50]);

                    $allThePoints ->add($guessedPoint);
                    $em->persist($guessedPoint);
                }
            }
            $path ->setPoints($allThePoints);
            $em->persist($path);
            $output->writeln("Added path :". $path->getName());

        }
        $em->flush();
        $output->writeln("-----------------------------");
        $output->writeln("Finish");
    }
}