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

class ImportRimbaudCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:ImportRimbaudCommand')
            ->setDescription('Import of the Demo Path');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $file = fopen('csv/parcours-rimbaud.csv', 'r');
        fgetcsv($file);

        $path = new Path();
        $path->setName('Parcours Rimbaud');
        $path->setCity('Sedan');
        $path->setTheme('Culturel');

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
        $output->writeln("Import 'Parcours Rimbaud' Finish");
        $output->writeln("------------------------------------------------");

    }
}
