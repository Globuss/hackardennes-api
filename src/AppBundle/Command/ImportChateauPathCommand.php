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

class ImportChateauPathCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:ImportChateauPathCommand')
            ->setDescription('Import of the Demo Path');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $file = fopen('csv/abords-du-chateau.csv', 'r');
        fgetcsv($file);

        $path = new Path();
        $path->setName('Visite du Chateau de Sedan');
        $path->setCity('Sedan');
        $path->setTheme('Historique');

        $allPoints = new ArrayCollection();
        $rank = 0;
        while ($fields = fgetcsv($file)) {

            $point = new Point($path);

            $point->setLatitude($fields[3]);
            $point->setLongitude($fields[4]);
            $point->setMajor(intval($fields[5]) ?: null);
            $point->setMinor(intval($fields[6]) ?: null);
            $point->setRank($rank);
            $point->setName($fields[0]);
            $point->setDescription($fields[1]);
            $point->setImage($fields[2]);

            $em->persist($point);
            $allPoints->add($point);
            $rank++;
        }

        $path->setPoints($allPoints);
        $em->persist($path);

        $em->flush();
        $output->writeln("Import 'Visite du Chateau de Sedan' Finish");
        $output->writeln("------------------------------------------------");

    }
}
