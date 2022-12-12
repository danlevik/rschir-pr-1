<?php
require_once "app/models/FakeDataInstance.php";

class FakeDataModel extends Model {

    static $jsonPath = 'json/results.json';

    function getData()
    {

    }

    function generateData()
    {
        $data = array();
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
        for ($i = 0; $i < 50; $i++) {
            $data_row = new FakeDataInstance(
                $faker->name(),
                $faker->dayOfWeek(),
                $faker->monthName(),
                $faker->city(),
                $faker->bloodType()
            );
            $data[] = $data_row;
        }
        $jsonData = json_encode($data);
        file_put_contents(self::$jsonPath, $jsonData);
    }

    function getRawData(): array {
        $input = file_get_contents(self::$jsonPath);
        return json_decode($input);
    }

    function getDayCount($data): array
    {
        $day_count = array();
        foreach ($data as $row) {
            $weekday = $row->weekday;
            if(!isset($day_count[$weekday])) {
                $day_count[$weekday] = 0;
            }
            $day_count[$weekday] += 1;
        }
        return $this->getLabelsAndValues($day_count);
    }

    function getBloodTypeCount($data): array
    {
        $blood_type_count = array();
        foreach ($data as $row) {
            $bloodType = $row->bloodType;
            if(!isset($blood_type_count[$bloodType])) {
                $blood_type_count[$bloodType] = 0;
            }
            $blood_type_count[$bloodType] += 1;
        }
        return $this->getLabelsAndValues($blood_type_count);
    }

    function getMonthCount($data): array
    {
        $count = array();
        foreach ($data as $row) {
            $value = $row->month;
            if(!isset($count[$value])) {
                $count[$value] = 0;
            }
            $count[$value] += 1;
        }
        return $this->getLabelsAndValues($count);
    }

    function getLabelsAndValues($data) {
        $labels = array_keys($data);
        $values = array_values($data);
        return array("labels" => $labels, "values" => $values);
    }
}