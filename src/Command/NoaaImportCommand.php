<?php

namespace App\Command;

use App\Entity\Metar;
use App\Entity\Station;
use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class NoaaImportCommand extends Command
{
    protected static $defaultName = 'noaa:import';
    protected $entityManager, $metarService;

    public function __construct(string $name = null, EntityManagerInterface $entityManager, \App\Service\Metar $metarService)
    {
        $this->entityManager = $entityManager;
        $this->metarService = $metarService;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Get latest data from NOAA')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $io = new SymfonyStyle($input, $output);

        $files = [
            [
                'url' => 'https://aviationweather.gov/adds/dataserver_current/current/metars.cache.csv.gz',
                'filename' => 'metars.cache.csv.gz',
                'ucfilename' => 'metars.cache.csv'
            ],
//            [
//                'url' => 'https://aviationweather.gov/adds/dataserver_current/current/tafs.cache.csv.gz',
//                'filename' => 'tafs.cache.csv.gz',
//                'ucfilename' => 'tafs.cache.csv'
//            ]
        ];

        $filesystem = new Filesystem();

        $filepath = sys_get_temp_dir() . '/' . random_int(0, 1000) . '/';

        try {
            $filesystem->mkdir($filepath);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }

        foreach ($files as $file) {
            copy($file['url'], $filepath . $file['filename']);

            $gz = gzopen($filepath . $file['filename'], 'rb');

            if (!$gz) {
                throw new \Exception(
                    'Could not open gzip file'
                );
            }

            $dest = fopen($filepath . $file['ucfilename'], 'wb');

            if (!$dest) {
                gzclose($gz);
                throw new \Exception(
                    'Could not open destination file'
                );
            }

            while (!gzeof($gz)) {
                fwrite($dest, gzread($gz, 4096));
            }

            gzclose($gz);
            fclose($dest);

            $fh = fopen($filepath . $file['ucfilename'], 'r');

            $rows = 0;

            $this->entityManager->getConnection()->getConfiguration()->setSQLLogger(null);

            $stationRepository = $this->entityManager->getRepository(Station::class);
            $metarRepository = $this->entityManager->getRepository(Metar::class);

            switch ($file['ucfilename']) {
                case 'metars.cache.csv':
                    while ($csvLine = fgetcsv($fh)) {
                        $io->note('Memory: ' . memory_get_usage() / 1024 / 1024);

                        $rows++;

                        $io->note('Row ' . $rows);

                        if ($rows < 7) {
                            continue;
                        }

                        // Does the station exist in the database?
                        $station = $stationRepository->findOneBy(['station_code' => $csvLine[1]]);

                        if ($station !== null) {
                            // Station found
                            $io->note('Found station ' . $station->getStationCode());
                        } else {
                            // Station not found, create
                            $io->note('Creating station ' . $csvLine[1]);

                            $station = new Station();
                            $station->setStationCode($csvLine[1]);
                            $station->setLat($csvLine[3]);
                            $station->setLng($csvLine[4]);

                            $this->entityManager->persist($station);
                            $this->entityManager->flush();
                        }

                        // Let's take the METAR, generate a hash and see if it exists
                        $metarHash = sha1(serialize($csvLine));

                        $metarCheck = $metarRepository->findOneBy(['hash' => $metarHash]);

                        if ($metarCheck !== null) {
                            // METAR exists, skip
                            continue;
                        }

                        // Create new METAR record
                        $metar = new Metar();

                        $observationAt = Carbon::parse($csvLine[2]);

                        $metar->setStationId($station->getId());
                        $metar->setObservationAt($observationAt);
                        $metar->setRawData($csvLine[0]);
                        $metar->setTempC(!empty($csvLine[5]) ? $csvLine[5] : null);
                        $metar->setDewpointC(!empty($csvLine[6]) ? $csvLine[6] : null);
                        $metar->setWindDir((int) $csvLine[7]);
                        $metar->setWindSpeed((int) $csvLine[8]);
                        $metar->setWindGust((int) $csvLine[9]);
                        $metar->setVisibilityMiles(!empty($csvLine[10]) ? $csvLine[10] : null);
                        $metar->setAltimHg(!empty($csvLine[11]) ? $csvLine[11] : null);
                        $metar->setSeaLevelPressure(!empty($csvLine[12]) ? $csvLine[12] : null);
                        $metar->setCorrected($csvLine[13] == 'TRUE' ? true : false);
                        $metar->setAuto($csvLine[14] == 'TRUE' ? true : false);
                        $metar->setAutoStation($csvLine[15] == 'TRUE' ? true : false);
                        $metar->setMaintenanceIndicatorOn($csvLine[16] == 'TRUE' ? true : false);
                        $metar->setNoSignal($csvLine[17] == 'TRUE' ? true : false);
                        $metar->setLightningSensorOff($csvLine[18] == 'TRUE' ? true : false);
                        $metar->setFreezingRainSensorOff($csvLine[19] == 'TRUE' ? true : false);
                        $metar->setPresentWeatherSensorOff($csvLine[20] == 'TRUE' ? true : false);
                        $metar->setWxString($csvLine[21]);
                        $metar->setFlightCategory($csvLine[30]);
                        $metar->setThreeHrPressureTendencyMb(!empty($csvLine[31]) ? $csvLine[31] : null);
                        $metar->setMaxtC(!empty($csvLine[32]) ? $csvLine[32] : null);
                        $metar->setMintC(!empty($csvLine[33]) ? $csvLine[33] : null);
                        $metar->setMaxt24hrC(!empty($csvLine[34]) ? $csvLine[34] : null);
                        $metar->setMint24hrC(!empty($csvLine[35]) ? $csvLine[35] : null);
                        $metar->setPrecipIn(!empty($csvLine[36]) ? $csvLine[36] : null);
                        $metar->setPrecip3hrIn(!empty($csvLine[37]) ? $csvLine[37] : null);
                        $metar->setPrecip6hrIn(!empty($csvLine[38]) ? $csvLine[38] : null);
                        $metar->setPrecip24hrIn(!empty($csvLine[39]) ? $csvLine[39] : null);
                        $metar->setSnowIn(!empty($csvLine[40]) ? $csvLine[40] : null);
                        $metar->setVertVisFt((int) $csvLine[41]);
                        $metar->setMetarType($csvLine[42]);
                        $metar->setElevationM((int) $csvLine[43]);
                        $metar->setHash($metarHash);
                        $metar->setCreatedAt(Carbon::now());

                        $this->entityManager->persist($metar);
                        $this->entityManager->flush();

                        // Check for cloud layers and add if found
                        $this->metarService->addCloudLayer($metar, $csvLine[22], $csvLine[23]);
                        $this->metarService->addCloudLayer($metar, $csvLine[24], $csvLine[25]);
                        $this->metarService->addCloudLayer($metar, $csvLine[26], $csvLine[27]);
                        $this->metarService->addCloudLayer($metar, $csvLine[28], $csvLine[29]);
                    }
                    break;
            }

            fclose($fh);
        }
    }
}
