<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    protected string $model;
    protected array $keys = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $data) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->model::firstOrCreate(
                $this->getKeyData($data),
                $this->getAdditionalData($data)
            );
        }
    }

    /**
     * @return array
     */
    abstract protected function data(): array;

    /**
     * @param array $data
     * @return array
     */
    private function getKeyData(array $data): array
    {
        $array = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->keys)) {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /**
     * @param array $data
     * @return array
     */
    private function getAdditionalData(array $data): array
    {
        $array = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->keys)) {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
