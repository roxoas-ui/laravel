<?php

namespace App\Repositories;

use App\Models\License;

class LicenseRepository
{
    public function paginateWithProject($perPage = 15)
    {
        return License::with('project')->paginate($perPage);
    }

    public function findWithRelations($id)
    {
        return License::with(['conditionals', 'attachments'])->findOrFail($id);
    }
}
