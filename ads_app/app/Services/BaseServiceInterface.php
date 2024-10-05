<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface BaseServiceInterface
{
    public function createRecord(array $data): Model;
    public function updateRecord(array $data, string $id): Model;
    public function getRecordById(string $id): Model;
    public function getRecords(): Collection;
    public function deleteRecordById(string $id): Model;

}
