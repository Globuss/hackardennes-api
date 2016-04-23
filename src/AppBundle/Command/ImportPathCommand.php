<?php

namespace AppBundle\Command;

use AppBundle\Entity\Path;
use AppBundle\Entity\Point;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPathCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:ImportPathCommand')
            ->setDescription('Create points associated with item data');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $file = fopen('csv/Itineraires.csv','r');
        fgetcsv($file);

        while($fields = fgetcsv($file)){

            $path = new Path();
            $path->setName($fields[1]);
            $point = new Point($path);
            $path->setPoints(array($point));
            $point ->setLatitude($fields[24]);
            $point ->setLongitude($fields[25]);


            $point -> setStart(true);

            $em->persist($path);
            $em->persist($point);
            $em->flush();


        }

    }
}