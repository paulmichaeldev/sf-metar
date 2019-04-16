<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetarRepository")
 */
class Metar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $station_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $observation_at;

    /**
     * @ORM\Column(type="text")
     */
    private $raw_data;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $temp_c;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $dewpoint_c;

    /**
     * @ORM\Column(type="smallint")
     */
    private $wind_dir;

    /**
     * @ORM\Column(type="smallint")
     */
    private $wind_speed;

    /**
     * @ORM\Column(type="smallint")
     */
    private $wind_gust;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $visibility_miles;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=6, nullable=true)
     */
    private $altim_hg;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $sea_level_pressure;

    /**
     * @ORM\Column(type="boolean")
     */
    private $corrected;

    /**
     * @ORM\Column(type="boolean")
     */
    private $auto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $auto_station;

    /**
     * @ORM\Column(type="boolean")
     */
    private $maintenance_indicator_on;

    /**
     * @ORM\Column(type="boolean")
     */
    private $no_signal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lightning_sensor_off;

    /**
     * @ORM\Column(type="boolean")
     */
    private $freezing_rain_sensor_off;

    /**
     * @ORM\Column(type="boolean")
     */
    private $present_weather_sensor_off;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $wx_string;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $flight_category;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $three_hr_pressure_tendency_mb;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $maxt_c;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $mint_c;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $maxt24hr_c;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $mint24hr_c;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3, nullable=true)
     */
    private $precip_in;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3, nullable=true)
     */
    private $precip3hr_in;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3, nullable=true)
     */
    private $precip6hr_in;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3, nullable=true)
     */
    private $precip24hr_in;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=3, nullable=true)
     */
    private $snow_in;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vert_vis_ft;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $metar_type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $elevation_m;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $hash;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStationId(): ?int
    {
        return $this->station_id;
    }

    public function setStationId(int $station_id): self
    {
        $this->station_id = $station_id;

        return $this;
    }

    public function getObservationAt(): ?\DateTimeInterface
    {
        return $this->observation_at;
    }

    public function setObservationAt(\DateTimeInterface $observation_at): self
    {
        $this->observation_at = $observation_at;

        return $this;
    }

    public function getRawData(): ?string
    {
        return $this->raw_data;
    }

    public function setRawData(string $raw_data): self
    {
        $this->raw_data = $raw_data;

        return $this;
    }

    public function getTempC()
    {
        return $this->temp_c;
    }

    public function setTempC($temp_c): self
    {
        $this->temp_c = $temp_c;

        return $this;
    }

    public function getDewpointC()
    {
        return $this->dewpoint_c;
    }

    public function setDewpointC($dewpoint_c): self
    {
        $this->dewpoint_c = $dewpoint_c;

        return $this;
    }

    public function getWindDir(): ?int
    {
        return $this->wind_dir;
    }

    public function setWindDir(int $wind_dir): self
    {
        $this->wind_dir = $wind_dir;

        return $this;
    }

    public function getWindSpeed(): ?int
    {
        return $this->wind_speed;
    }

    public function setWindSpeed(int $wind_speed): self
    {
        $this->wind_speed = $wind_speed;

        return $this;
    }

    public function getWindGust(): ?int
    {
        return $this->wind_gust;
    }

    public function setWindGust(int $wind_gust): self
    {
        $this->wind_gust = $wind_gust;

        return $this;
    }

    public function getVisibilityMiles()
    {
        return $this->visibility_miles;
    }

    public function setVisibilityMiles($visibility_miles): self
    {
        $this->visibility_miles = $visibility_miles;

        return $this;
    }

    public function getAltimHg()
    {
        return $this->altim_hg;
    }

    public function setAltimHg($altim_hg): self
    {
        $this->altim_hg = $altim_hg;

        return $this;
    }

    public function getSeaLevelPressure()
    {
        return $this->sea_level_pressure;
    }

    public function setSeaLevelPressure($sea_level_pressure): self
    {
        $this->sea_level_pressure = $sea_level_pressure;

        return $this;
    }

    public function getCorrected(): ?bool
    {
        return $this->corrected;
    }

    public function setCorrected(bool $corrected): self
    {
        $this->corrected = $corrected;

        return $this;
    }

    public function getAuto(): ?bool
    {
        return $this->auto;
    }

    public function setAuto(bool $auto): self
    {
        $this->auto = $auto;

        return $this;
    }

    public function getAutoStation(): ?bool
    {
        return $this->auto_station;
    }

    public function setAutoStation(bool $auto_station): self
    {
        $this->auto_station = $auto_station;

        return $this;
    }

    public function getMaintenanceIndicatorOn(): ?bool
    {
        return $this->maintenance_indicator_on;
    }

    public function setMaintenanceIndicatorOn(bool $maintenance_indicator_on): self
    {
        $this->maintenance_indicator_on = $maintenance_indicator_on;

        return $this;
    }

    public function getNoSignal(): ?bool
    {
        return $this->no_signal;
    }

    public function setNoSignal(bool $no_signal): self
    {
        $this->no_signal = $no_signal;

        return $this;
    }

    public function getLightningSensorOff(): ?bool
    {
        return $this->lightning_sensor_off;
    }

    public function setLightningSensorOff(bool $lightning_sensor_off): self
    {
        $this->lightning_sensor_off = $lightning_sensor_off;

        return $this;
    }

    public function getFreezingRainSensorOff(): ?bool
    {
        return $this->freezing_rain_sensor_off;
    }

    public function setFreezingRainSensorOff(bool $freezing_rain_sensor_off): self
    {
        $this->freezing_rain_sensor_off = $freezing_rain_sensor_off;

        return $this;
    }

    public function getPresentWeatherSensorOff(): ?bool
    {
        return $this->present_weather_sensor_off;
    }

    public function setPresentWeatherSensorOff(bool $present_weather_sensor_off): self
    {
        $this->present_weather_sensor_off = $present_weather_sensor_off;

        return $this;
    }

    public function getWxString(): ?string
    {
        return $this->wx_string;
    }

    public function setWxString(?string $wx_string): self
    {
        $this->wx_string = $wx_string;

        return $this;
    }

    public function getFlightCategory(): ?string
    {
        return $this->flight_category;
    }

    public function setFlightCategory(?string $flight_category): self
    {
        $this->flight_category = $flight_category;

        return $this;
    }

    public function getThreeHrPressureTendencyMb()
    {
        return $this->three_hr_pressure_tendency_mb;
    }

    public function setThreeHrPressureTendencyMb($three_hr_pressure_tendency_mb): self
    {
        $this->three_hr_pressure_tendency_mb = $three_hr_pressure_tendency_mb;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getMaxtC()
    {
        return $this->maxt_c;
    }

    public function setMaxtC($maxt_c): self
    {
        $this->maxt_c = $maxt_c;

        return $this;
    }

    public function getMintC()
    {
        return $this->mint_c;
    }

    public function setMintC($mint_c): self
    {
        $this->mint_c = $mint_c;

        return $this;
    }

    public function getMaxt24hrC()
    {
        return $this->maxt24hr_c;
    }

    public function setMaxt24hrC($maxt24hr_c): self
    {
        $this->maxt24hr_c = $maxt24hr_c;

        return $this;
    }

    public function getMint24hrC()
    {
        return $this->mint24hr_c;
    }

    public function setMint24hrC($mint24hr_c): self
    {
        $this->mint24hr_c = $mint24hr_c;

        return $this;
    }

    public function getPrecipIn()
    {
        return $this->precip_in;
    }

    public function setPrecipIn($precip_in): self
    {
        $this->precip_in = $precip_in;

        return $this;
    }

    public function getPrecip3hrIn()
    {
        return $this->precip3hr_in;
    }

    public function setPrecip3hrIn($precip3hr_in): self
    {
        $this->precip3hr_in = $precip3hr_in;

        return $this;
    }

    public function getPrecip6hrIn()
    {
        return $this->precip6hr_in;
    }

    public function setPrecip6hrIn($precip6hr_in): self
    {
        $this->precip6hr_in = $precip6hr_in;

        return $this;
    }

    public function getPrecip24hrIn()
    {
        return $this->precip24hr_in;
    }

    public function setPrecip24hrIn($precip24hr_in): self
    {
        $this->precip24hr_in = $precip24hr_in;

        return $this;
    }

    public function getSnowIn()
    {
        return $this->snow_in;
    }

    public function setSnowIn($snow_in): self
    {
        $this->snow_in = $snow_in;

        return $this;
    }

    public function getVertVisFt(): ?int
    {
        return $this->vert_vis_ft;
    }

    public function setVertVisFt(?int $vert_vis_ft): self
    {
        $this->vert_vis_ft = $vert_vis_ft;

        return $this;
    }

    public function getMetarType(): ?string
    {
        return $this->metar_type;
    }

    public function setMetarType(?string $metar_type): self
    {
        $this->metar_type = $metar_type;

        return $this;
    }

    public function getElevationM(): ?int
    {
        return $this->elevation_m;
    }

    public function setElevationM(?int $elevation_m): self
    {
        $this->elevation_m = $elevation_m;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }
}
