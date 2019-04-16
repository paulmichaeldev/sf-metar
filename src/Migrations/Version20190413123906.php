<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413123906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE metar (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, observation_at DATETIME NOT NULL, raw_data LONGTEXT NOT NULL, temp_c NUMERIC(6, 2) DEFAULT NULL, dewpoint_c NUMERIC(6, 2) DEFAULT NULL, wind_dir SMALLINT NOT NULL, wind_speed SMALLINT NOT NULL, wind_gust SMALLINT NOT NULL, visibility_miles NUMERIC(6, 2) DEFAULT NULL, altim_hg NUMERIC(12, 6) DEFAULT NULL, sea_level_pressure NUMERIC(10, 2) DEFAULT NULL, corrected TINYINT(1) NOT NULL, auto TINYINT(1) NOT NULL, auto_station TINYINT(1) NOT NULL, maintenance_indicator_on TINYINT(1) NOT NULL, no_signal TINYINT(1) NOT NULL, lightning_sensor_off TINYINT(1) NOT NULL, freezing_rain_sensor_off TINYINT(1) NOT NULL, present_weather_sensor_off TINYINT(1) NOT NULL, wx_string LONGTEXT DEFAULT NULL, flight_category VARCHAR(10) DEFAULT NULL, three_hr_pressure_tendency_mb NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE metar');
    }
}
