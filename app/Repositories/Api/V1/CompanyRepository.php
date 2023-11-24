<?php 
namespace App\Repositories\Api\V1;

use App\Interfaces\Api\V1\CompanyRepositoryInterface;
use App\Http\Resources\Api\V1\CompanyResource;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Company;


class CompanyRepository implements CompanyRepositoryInterface  {

    public function getAllCompanies(){
        return CompanyResource::collection(Company::all());
    }


    public function createCompany($companyDetails){

        return Company::create($companyDetails);
    }

    public function getCompanyById($company) {
        // $company = Company::findOrFail($companyId);
        return new CompanyResource($company);
    }

    public function updateCompany($data, $company) {

        $company->fill($data);
        $company->save();
        return new CompanyResource($company);
        
    }

    public function getAllCommentsById($company){
        return CommentResource::collection($company->comments);
    }

    public function getOverallRatingById($company){
        $overallRating = $company->comments()->avg('rating');
        return $overallRating;
    }

    public function get_top_rated_companies(){
        $topCompanies = Company::withAvg('comments', 'rating') // Calculate the average rating
            ->orderByDesc('comments_avg_rating')
            ->take(10)
            ->get();

        // return CompanyResource::collection($topCompanies);
        return $topCompanies;
    }
 
}