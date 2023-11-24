<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Resources\Api\V1\CommentResource;
use App\Http\Requests\Api\V1\CompanyRequest;
use App\Interfaces\Api\V1\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use App\Helpers\Helper;


class CompanyController extends Controller 
{

    private CompanyRepositoryInterface  $companyRepository;
    public function __construct(CompanyRepositoryInterface  $companyRepository)
    {

        $this->companyRepository = $companyRepository;
    }

    public function index() 
    {
        return response()->json(
            [
                'data' => $this->companyRepository->getAllCompanies()
            ],
            200
        );
    }
    public function store(CompanyRequest $request) 
    {
        $companyDetails = $request->only([
            'name',
            'description'
        ]);

        $companyDetails['logo'] = Helper::handleLogo($request->file('logo'));
        return response()->json(
            [
                'data' => $this->companyRepository->createCompany($companyDetails)
            ],
            201
        );
        
    }

    public function show(Company $company) 
    {
        return response()->json(
            [
                'data' => $this->companyRepository->getCompanyById($company)
            ],
            200
        );

    }

    public function update(CompanyRequest $request, Company $company)
    {
        try {
                $data = $request->validated();
                if($request->hasFile('logo')){

                    $data['logo'] = Helper::handleLogo($request->file('logo'));
                } 

                return response()->json(
                    [
                        'message' => 'Company updated successfully',
                        'data' => $this->companyRepository->updateCompany($data, $company)
                    ],
                    200
                );
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Company $company)
    {
        try{
            // Delete the company
            $company->delete();

            return response()->json(['message' => 'Company deleted successfully'], 200);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }

    // getComments by companyId
    public function getComments(Company $company){
        return response()->json([
            'data' => $this->companyRepository->getAllCommentsById($company)
        ], 200);
    }

    public function getOverallRating(Company $company)
    {

        return response()->json([
            'overall_rating' => $this->companyRepository->getOverallRatingById($company)
        ], 200);
    }
    public function top_rated_companies(){
        
        return response()->json(
            [
                'top_rated_companies' => $this->companyRepository->get_top_rated_companies()
            ], 200);

    }

}
