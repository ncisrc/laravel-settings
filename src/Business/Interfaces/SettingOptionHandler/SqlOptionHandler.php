<?php

namespace Nci\Settings\Business\Interfaces\SettingOptionHandler;

use Exception;
use Illuminate\Support\Facades\DB;

class SqlOptionHandler implements OptionHandler
{
    public function process(string $data): array
    {
        if (empty($data)) {
            return [];
        }

        try {
            $sqlObj = json_decode($data);

            $sql = 'SELECT ' . $sqlObj->select . ' FROM ' . $sqlObj->from;
            $sql .= (empty($sqlObj->where)) ? '' : ' WHERE ' . $sqlObj->where;

            return DB::select($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 404);
        }
    }

    public function canCheckOptions(): bool
    {
        return false;
    }
}