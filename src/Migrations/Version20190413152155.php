<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190413152155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metar ADD maxt_c NUMERIC(6, 2) DEFAULT NULL, ADD mint_c NUMERIC(6, 2) DEFAULT NULL, ADD maxt24hr_c NUMERIC(6, 2) DEFAULT NULL, ADD mint24hr_c NUMERIC(6, 2) DEFAULT NULL, ADD precip_in NUMERIC(8, 3) DEFAULT NULL, ADD precip3hr_in NUMERIC(8, 3) DEFAULT NULL, ADD precip6hr_in NUMERIC(8, 3) DEFAULT NULL, ADD precip24hr_in NUMERIC(8, 3) DEFAULT NULL, ADD snow_in NUMERIC(8, 3) DEFAULT NULL, ADD vert_vis_ft INT DEFAULT NULL, ADD metar_type VARCHAR(10) DEFAULT NULL, ADD elevation_m INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metar DROP maxt_c, DROP mint_c, DROP maxt24hr_c, DROP mint24hr_c, DROP precip_in, DROP precip3hr_in, DROP precip6hr_in, DROP precip24hr_in, DROP snow_in, DROP vert_vis_ft, DROP metar_type, DROP elevation_m');
    }
}
