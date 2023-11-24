<?php 

namespace App\Interfaces\Api\V1;

interface CompanyRepositoryInterface  {
    public function getAllCompanies();
    public function createCompany($companyDetails);
    public function getCompanyById($company);
    public function updateCompany($data, $company);
    public function getAllCommentsById($company);
    public function getOverallRatingById($company);
    public function get_top_rated_companies();
}