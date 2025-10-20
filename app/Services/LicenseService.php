<?php

namespace App\Services;

use App\Repositories\LicenseRepository;

class LicenseService
{
    protected $repo;

    public function __construct(LicenseRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list($perPage = 15)
    {
        return $this->repo->paginateWithProject($perPage);
    }

    public function show($id)
    {
        return $this->repo->findWithRelations($id);
    }
}
