<?php
namespace App\Command;

# https://stackoverflow.com/questions/561066/fatal-error-allowed-memory-size-of-134217728-bytes-exhausted-codeigniter-xml
ini_set('memory_limit', '-1');

use App\Entity\Shop\ProductEntity;
use App\Entity\Shop\VendorEntity;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

# php bin/console app:load_data
class DataLoaderCommand extends Command
{
    protected static $defaultName = 'app:load_data';

    private ObjectManager $om;

    public function __construct(ManagerRegistry $manager)
    {
        $this->om = $manager->getManager();
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('');
        $this->addArgument('count', InputArgument::OPTIONAL, 'Количество товаров (product), которое нужно добавить. По-умолчанию 150`000');
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $vendorEntities = VendorEntity::fromPhoneVendors();
        $progressBar = $io->createProgressBar(10000000);


        $io->section("Начинаем загрузку данных");
        $i = 1000000;
        foreach ($vendorEntities as $key => $vendor) {
            $this->om
                ->getRepository(ProductEntity::class)
                ->saveMany(
                    ProductEntity::fromRandProducts(\Faker\Factory::create(), $vendor, $i),
                    true
                );
            $this->clear();
            $progressBar->setProgress($i);
            $i += $i;
        }

        return Command::SUCCESS;
    }

    private function clear():void
    {
        opcache_reset();



        $cache = new PhpFilesAdapter('doctrine_queries');
        $cache->clear();

        //$config = new \Doctrine\ORM\Configuration();
       // $this->om->c
       // $this->om->clear();
       // clearstatcache();
    }
}